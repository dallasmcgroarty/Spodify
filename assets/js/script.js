
let currentPlaylist = [];
let audioElement;

function formatTime(seconds) {
    let time = Math.round(seconds);
    let minutes = Math.floor(time / 60);
    let seconds2 = time - (minutes * 60);

    let extraZero = (seconds2 < 10) ? '0' : '';

    return `${minutes}:${extraZero}${seconds2}`;
}

function updateTimeProgressBar(audio) {
    document.querySelector('.progress-time.current').textContent = formatTime(audio.currentTime);
    document.querySelector('.progress-time.remaining').textContent = formatTime(audio.duration - audio.currentTime);

    let progress = audio.currentTime / audio.duration * 100;

    document.querySelector('.progress-bar .progress').style.width = `${progress}%`;
}

class Audio {
    constructor () {
        this.currentlyPlaying;
        this.audio = document.createElement('audio');
        this.paused = true;

        this.setupListeners();
    }
    
    setTrack(track) {
        this.currentlyPlaying = track;
        this.audio.src = track.path;
    }

    play() {
        this.audio.play();
        this.paused = false;
    }

    pause() {
        this.audio.pause();
        this.paused = true;
    }

    setupListeners() {
        this.audio.addEventListener('canplay', function(e) {
            document.querySelector('.progress-time.remaining').textContent = formatTime(this.duration);
        });

        this.audio.addEventListener('timeupdate', function(e) {
            if (this.duration) {
                updateTimeProgressBar(this);
            }
        })
    }
}