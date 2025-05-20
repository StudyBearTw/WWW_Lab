// js/ui.js
export class UI {
    constructor(player, playlist) {
        this.player = player;
        this.playlist = playlist;

        // DOM元素
        this.playButton = document.getElementById('play');
        this.stopButton = document.getElementById('stop');
        this.rewindButton = document.getElementById('rewind');
        this.forwardButton = document.getElementById('fastforward');
        this.shuffleButton = document.getElementById('shuffle');
        this.repeatButton = document.getElementById('repeat');
        this.muteButton = document.getElementById('mute');
        this.volumeSlider = document.getElementById('pace');
        this.progressBar = document.getElementById('progress');
        this.currentTimeDisplay = document.querySelector('.timer.left');
        this.totalTimeDisplay = document.getElementById('total-time');
        this.playlistElement = document.getElementById('playlist');
        this.coverElement = document.querySelector('.cover');
        this.titleElement = document.querySelector('.tag strong');
        this.artistElement = document.querySelector('.tag .artist');
        this.albumElement = document.querySelector('.tag .album');

        // 拖曳狀態
        this.isDraggingProgress = false;
    }

    init() {
        this.renderPlaylist();
        this.bindEvents();
        this.bindPlayerEvents();
    }

    renderPlaylist() {
        this.playlistElement.innerHTML = '';

        this.playlist.forEach((track, index) => {
            const li = document.createElement('li');
            li.textContent = `${track.artist} - ${track.track}`;
            li.dataset.index = index;

            if (index === this.player.currentTrack) {
                li.classList.add('playing');
            }

            this.playlistElement.appendChild(li);
        });
    }

    bindEvents() {
        // 播放控制
        this.playButton.addEventListener('click', () => this.player.togglePlay());
        this.stopButton.addEventListener('click', () => this.player.stop());
        this.rewindButton.addEventListener('click', () => this.player.prevTrack());
        this.forwardButton.addEventListener('click', () => this.player.nextTrack());

        // 播放模式
        this.shuffleButton.addEventListener('click', () => this.player.toggleShuffle());
        this.repeatButton.addEventListener('click', () => this.player.toggleRepeat());

        // 音量控制
        this.volumeSlider.addEventListener('input', (e) => {
            this.player.setVolume(parseFloat(e.target.value));
        });
        this.muteButton.addEventListener('click', () => this.player.toggleMute());

        // 播放進度控制
        this.progressBar.addEventListener('mousedown', () => {
            this.isDraggingProgress = true;
        });

        this.progressBar.addEventListener('input', (e) => {
            const percent = parseFloat(e.target.value) / 100;
            this.currentTimeDisplay.textContent = this.player.formatTime(percent * this.player.audio.duration);
        });

        this.progressBar.addEventListener('change', (e) => {
            const percent = parseFloat(e.target.value) / 100;
            this.player.seek(percent);
            this.isDraggingProgress = false;
        });

        document.addEventListener('mouseup', () => {
            if (this.isDraggingProgress) {
                this.isDraggingProgress = false;
            }
        });

        // 播放清單
        this.playlistElement.addEventListener('click', (e) => {
            const li = e.target.closest('li');
            if (li) {
                const index = parseInt(li.dataset.index);
                this.player.loadTrack(index);
                this.player.play();
            }
        });
    }

    bindPlayerEvents() {
        // 播放狀態更新
        this.player.on('play', () => {
            this.playButton.classList.add('playing');
        });

        this.player.on('pause', () => {
            this.playButton.classList.remove('playing');
        });

        this.player.on('stop', () => {
            this.playButton.classList.remove('playing');
            this.progressBar.value = 0;
        });

        // 音軌更新
        this.player.on('trackChange', (data) => {
            const track = data.track;

            // 更新音軌信息
            this.titleElement.textContent = track.track;
            this.artistElement.textContent = track.artist;
            this.albumElement.textContent = track.album;

            // 更新封面
            this.coverElement.innerHTML = `<img src="${track.cover}" alt="${track.album}">`;

            // 更新播放清單高亮
            const items = this.playlistElement.querySelectorAll('li');
            items.forEach(item => item.classList.remove('playing'));
            items[data.index].classList.add('playing');
        });

        // 時間更新
        this.player.on('timeUpdate', (data) => {
            if (!this.isDraggingProgress) {
                this.progressBar.value = data.percent * 100;
                this.currentTimeDisplay.textContent = data.formattedCurrentTime;
            }
        });

        // 音量更新
        this.player.on('volumeChange', (data) => {
            this.volumeSlider.value = data.volume;
            this.muteButton.classList.toggle('enable', data.muted);
        });

        this.player.on('mute', (data) => {
            this.muteButton.classList.toggle('enable', data.muted);
        });

        // 播放模式更新
        this.player.on('shuffle', (enabled) => {
            this.shuffleButton.classList.toggle('active', enabled);
        });

        this.player.on('repeat', (enabled) => {
            this.repeatButton.classList.toggle('active', enabled);
        });

        // 初始時間顯示
        this.player.on('timeUpdate', (data) => {
            this.totalTimeDisplay.textContent = data.formattedDuration;
        });
    }
}