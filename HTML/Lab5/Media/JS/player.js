// js/player.js
export class Player {
    constructor(audio, playlist) {
        this.audio = audio;
        this.playlist = playlist;
        this.currentTrack = 0;
        this.playing = false;
        this.seeking = false;
        this.isShuffle = false;
        this.isRepeat = false;
        this.currentVolume = localStorage.getItem('volume') ? parseFloat(localStorage.getItem('volume')) : 0.7;
        this.isMuted = false;

        // 事件監聽器
        this.eventListeners = {
            play: [],
            pause: [],
            stop: [],
            trackChange: [],
            volumeChange: [],
            mute: [],
            timeUpdate: [],
            progressChange: [],
            shuffle: [],
            repeat: []
        };
    }

    init() {
        this.audio.volume = this.currentVolume;
        this.loadTrack(this.currentTrack);

        // 設置音頻事件
        this.audio.addEventListener('ended', () => this.handleTrackEnd());
        this.audio.addEventListener('timeupdate', () => this.handleTimeUpdate());
        this.audio.addEventListener('loadedmetadata', () => this.handleMetadataLoaded());
    }

    // 事件監聽器方法
    on(event, callback) {
        if (this.eventListeners[event]) {
            this.eventListeners[event].push(callback);
        }
    }

    trigger(event, data) {
        if (this.eventListeners[event]) {
            this.eventListeners[event].forEach(callback => callback(data));
        }
    }

    // 播放控制方法
    play() {
        this.audio.play();
        this.playing = true;
        this.trigger('play');
    }

    pause() {
        this.audio.pause();
        this.playing = false;
        this.trigger('pause');
    }

    stop() {
        this.audio.pause();
        this.audio.currentTime = 0;
        this.playing = false;
        this.trigger('stop');
    }

    togglePlay() {
        if (this.playing) {
            this.pause();
        } else {
            this.play();
        }
    }

    // 音軌控制
    loadTrack(index) {
        this.currentTrack = index;
        const track = this.playlist[this.currentTrack];
        this.audio.src = track.mp3;

        if (this.playing) {
            this.play();
        }

        this.trigger('trackChange', {
            index: this.currentTrack,
            track: track
        });
    }

    prevTrack() {
        let index;
        if (this.isShuffle) {
            index = this.getRandomTrackIndex();
        } else {
            index = (this.currentTrack - 1 + this.playlist.length) % this.playlist.length;
        }
        this.loadTrack(index);
        this.play();
    }

    nextTrack() {
        let index;
        if (this.isShuffle) {
            index = this.getRandomTrackIndex();
        } else {
            index = (this.currentTrack + 1) % this.playlist.length;
        }
        this.loadTrack(index);
        this.play();
    }

    getRandomTrackIndex() {
        if (this.playlist.length <= 1) return 0;

        let index;
        do {
            index = Math.floor(Math.random() * this.playlist.length);
        } while (index === this.currentTrack);

        return index;
    }

    // 時間控制
    seek(percent) {
        if (this.audio.duration) {
            this.audio.currentTime = this.audio.duration * percent;
            this.trigger('progressChange', {
                currentTime: this.audio.currentTime,
                duration: this.audio.duration,
                percent: percent
            });
        }
    }

    // 音量控制
    setVolume(value) {
        this.currentVolume = value;
        this.audio.volume = value;
        localStorage.setItem('volume', value);

        if (value > 0 && this.isMuted) {
            this.isMuted = false;
        } else if (value === 0 && !this.isMuted) {
            this.isMuted = true;
        }

        this.trigger('volumeChange', {
            volume: value,
            muted: this.isMuted
        });
    }

    toggleMute() {
        if (this.isMuted) {
            this.isMuted = false;
            this.audio.volume = this.currentVolume;
        } else {
            this.isMuted = true;
            this.audio.volume = 0;
        }

        this.trigger('mute', {
            muted: this.isMuted,
            volume: this.audio.volume
        });
    }

    // 模式控制
    toggleShuffle() {
        this.isShuffle = !this.isShuffle;
        this.trigger('shuffle', this.isShuffle);
    }

    toggleRepeat() {
        this.isRepeat = !this.isRepeat;
        this.trigger('repeat', this.isRepeat);
    }

    // 事件處理
    handleTrackEnd() {
        if (this.isRepeat) {
            this.audio.currentTime = 0;
            this.play();
        } else {
            this.nextTrack();
        }
    }

    handleTimeUpdate() {
        if (!this.seeking) {
            const currentTime = this.audio.currentTime;
            const duration = this.audio.duration || 0;
            const percent = duration ? currentTime / duration : 0;

            this.trigger('timeUpdate', {
                currentTime: currentTime,
                duration: duration,
                percent: percent,
                formattedCurrentTime: this.formatTime(currentTime),
                formattedDuration: this.formatTime(duration)
            });
        }
    }

    handleMetadataLoaded() {
        this.trigger('timeUpdate', {
            currentTime: 0,
            duration: this.audio.duration,
            percent: 0,
            formattedCurrentTime: '0:00',
            formattedDuration: this.formatTime(this.audio.duration)
        });
    }

    // 工具方法
    formatTime(seconds) {
        seconds = Math.floor(seconds);
        const minutes = Math.floor(seconds / 60);
        seconds = seconds % 60;
        return `${minutes}:${seconds.toString().padStart(2, '0')}`;
    }
}