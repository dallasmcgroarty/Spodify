
</div>
                </div>

            <div id="now-playing-container">
                <div id="now-playing-bar">
                    <div id="now-playing-bar-left">
                        <div class="content">
                            <span class="album-link">
                                <img role="link" tabindex="0" src="assets/images/album-placeholder.png" alt="album artwork" class="album-artwork">
                            </span>

                            <div class="track-info">
                                <span role="link" tabindex="0" class="track-name">
                                    test
                                </span>

                                <span role="link" tabindex="0" class="artist-name">
                                    test
                                </span>
                            </div>
                        </div>
                    </div>

                    <div id="now-playing-bar-center">
                        <div class="content player-controls">
                            <div class="buttons">
                                <button type="button" class="control-button shuffle" title="Shuffle Button" onclick="setShuffle();">
                                    <img src="assets/images/icons/shuffle.png" alt="shuffle song">
                                </button>

                                <button type="button" class="control-button previous" title="Previous Button" onclick="previousSong();">
                                    <img src="assets/images/icons/previous.png" alt="previous song">
                                </button>

                                <button type="button" class="control-button play" title="Play Button" onclick="playSong();">
                                    <img src="assets/images/icons/play.png" alt="play song">
                                </button>

                                <button type="button" class="control-button pause hide" title="Pause Button" onclick="pauseSong();">
                                    <img src="assets/images/icons/pause.png" alt="pause song">
                                </button>

                                <button type="button" class="control-button next" title="Next Button" onclick="nextSong();">
                                    <img src="assets/images/icons/next.png" alt="next song">
                                </button>

                                <button type="button" class="control-button repeat" title="repeat Button" onclick="setRepeat();">
                                    <img src="assets/images/icons/repeat.png" alt="repeat song">
                                </button>
                            </div>

                            <div class="playback-bar">
                                <span class="progress-time current">0:00</span>
                                <div class="progress-bar">
                                    <div class="progress-bar-bg">
                                        <div class="progress"></div>
                                    </div>
                                </div>
                                <span class="progress-time remaining">0:00</span>
                            </div>
                        </div>
                    </div>

                    <div id="now-playing-bar-right">
                        <div class="volume-bar">
                            <button type="button" class="control-button volume" title="Volume button" onclick="setMute();">
                                <img src="assets/images/icons/volume.png" alt="Volume">
                            </button>

                            <div class="progress-bar">
                                <div class="progress-bar-bg">
                                    <div class="progress"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>