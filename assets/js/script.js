
let currentPlaylist = [];
let shufflePlaylist = [];
let tempPlaylist = [];
let audioElement;
let mouseDown = false;
let currentIndex = 0;
let repeat = false;
let shuffle = false;

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

function updateVolumeProgressBar(audio) {
    let volume = audio.volume * 100;
    document.querySelector('.volume-bar .progress').style.width = `${volume}%`;
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

    setTime(seconds) {
        this.audio.currentTime = seconds;
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

        this.audio.addEventListener('volumechange', function(e) {
            updateVolumeProgressBar(this);
        });

        this.audio.addEventListener('ended', function(e) {
            nextSong();
        })
    }
}

$(document).ready(function() {
    audioElement = new Audio();
    setTrack(newPlaylist[0], newPlaylist, false);
    audioElement.audio.volume = 0.5;
    document.querySelector('.volume-bar .progress').style.width = `50%`;

    ['mousedown', 'touchstart', 'mousemove', 'touchmove'].forEach( evt => 
        document.querySelector('#now-playing-container').addEventListener(evt, function(e) {
            e.preventDefault();
        })
    );

    // playback bar events
    document.querySelector('.playback-bar .progress-bar').addEventListener('mousedown', function(e) {
        mouseDown = true;
    });

    document.querySelector('.playback-bar .progress-bar').addEventListener('mousemove', function(e) {
        if (mouseDown) {
            timeFromOffset(e, this);
        }
    });

    document.querySelector('.playback-bar .progress-bar').addEventListener('mouseup', function(e) {
        timeFromOffset(e, this);
        mouseDown = false;
    });

    // volume bar events
    document.querySelector('.volume-bar .progress-bar').addEventListener('mousedown', function(e) {
        mouseDown = true;
    });

    document.querySelector('.volume-bar .progress-bar').addEventListener('mousemove', function(e) {
        if (mouseDown) {
            let percent = e.offsetX / this.offsetWidth;
            if (percent >= 0 && percent <= 1) {
                audioElement.audio.volume = percent;
            }
        }
    });

    document.querySelector('.volume-bar .progress-bar').addEventListener('mouseup', function(e) {
        let percent = e.offsetX / this.offsetWidth;
        if (percent >= 0 && percent <= 1) {
            audioElement.audio.volume = percent;
        }
        mouseDown = false;
    });
});

function timeFromOffset(mouse, progressBar) {
    let percent = mouse.offsetX / progressBar.offsetWidth * 100;
    let seconds = audioElement.audio.duration * (percent / 100);
    audioElement.setTime(seconds);
}

function nextSong() {
    if (repeat) {
        audioElement.setTime(0);
        playSong();
        return;
    }

    if (currentIndex == currentPlaylist.length-1) {
        currentIndex = 0;
    } else {
        currentIndex += 1;
    }

    let trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
    setTrack(trackToPlay, currentPlaylist, true);
}

function setRepeat() {
    repeat = !repeat;
    let imageName = repeat ? 'repeat-active.png' : 'repeat.png';
    document.querySelector('.control-button.repeat img').src = `assets/images/icons/${imageName}`;
}

function setMute() {
    audioElement.audio.muted = !audioElement.audio.muted;
    let imageName = audioElement.audio.muted ? 'volume-mute.png' : 'volume.png';
    document.querySelector('.control-button.volume img').src = `assets/images/icons/${imageName}`;
}

function setShuffle() {
    shuffle = !shuffle;
    let imageName = shuffle ? 'shuffle-active.png' : 'shuffle.png';
    document.querySelector('.control-button.shuffle img').src = `assets/images/icons/${imageName}`;

    if (shuffle) {
        shuffleArr(shufflePlaylist);
        currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
    } else {
        currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
    }
}

function shuffleArr(a) {
    let j, x, i;
    for (i = a.length;i;i--) {
        j = Math.floor(Math.random() * i);
        x = a[i-1];
        a[i-1] = a[j];
        a[j] = x;
    }
}

function previousSong() {
    if (audioElement.audio.currentTime >= 3 || currentIndex == 0) {
        audioElement.setTime(0);
    } else {
        currentIndex -= 1;
    }

    let trackToPlay = currentPlaylist[currentIndex];
    setTrack(trackToPlay, currentPlaylist, true);
}

function setTrack(trackId, newPlaylist, play) {
    if (newPlaylist != currentPlaylist) {
        currentPlaylist = newPlaylist;
        shufflePlaylist = currentPlaylist.slice();
        shuffleArr(shufflePlaylist);
    }

    if (shuffle) {
        currentIndex = shufflePlaylist.indexOf(trackId);
    } else {
        currentIndex = currentPlaylist.indexOf(trackId)
    }

    $.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data) {
        let track = JSON.parse(data);

        document.querySelector('#now-playing-bar .track-name').textContent = track.title;

        $.post("includes/handlers/ajax/getArtistJson.php", { artistId: track.artist }, function(data) {
            let artist = JSON.parse(data);
            document.querySelector('#now-playing-bar .artist-name').textContent = artist.name;
        });

        $.post("includes/handlers/ajax/getAlbumJson.php", { albumId: track.album }, function(data) {
            let album = JSON.parse(data);
            document.querySelector('#now-playing-bar .album-artwork').src = album.artworkPath;
        });

        audioElement.setTrack(track);

        if (play) {
            playSong();
        }
    });

}

function playSong() {
    if (audioElement.audio.currentTime == 0) {
        $.post("includes/handlers/ajax/updatePlays.php", { songId: audioElement.currentlyPlaying.id });
    }

    document.querySelector('.control-button.play').classList.add('hide');
    document.querySelector('.control-button.pause').classList.remove('hide');
    audioElement.play();
}

function pauseSong() {
    document.querySelector('.control-button.play').classList.remove('hide');
    document.querySelector('.control-button.pause').classList.add('hide');
    audioElement.pause();
}