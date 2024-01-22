    <?php if(!empty($user)) {?>
        <div class="play-music">
            <div class="play-music__dashboard">
                <!-- Phần văn bản bên trên -->
                <div class="play-music__dashboard-title">
                    <h5 class="play-music__dashboard-title-h5">
                        Đang phát:
                    </h5>
                    <span class="play-music__dashboard-title-name-song">
                        Không có bài hát nào
                    </span>
                </div>
                <!-- Phần chứa đĩa -->
                <div class="play-music__dashboard-cd">
                    <div style="background-image: url(../Image/no-img-playlist.png);" class="play-music__dashboard-cd-img"></div>
                </div>
                <!-- Phần chứa controls -->
                <div class="play-music__dashboard-controls">
                    <div class="play-music__dashboard-controls-list">
                        <div id="random" class="play-music__dashboard-controls-items">
                            <i class="icon ic-shuffle"></i>
                        </div>
                        <div class="play-music__dashboard-controls-items">
                            <i id="prev" class="icon ic-pre"></i>
                        </div>
                        <div class="play-music__dashboard-controls-items play-music__dashboard-controls-items--large">
                            <i id="play" class="icon ic-play-circle-outline icon--active"></i>
                            <i id="pause" class="icon ic-pause-circle-outline"></i>
                        </div>
                        <div class="play-music__dashboard-controls-items">
                            <i id="next" class="icon ic-next"></i>
                        </div>
                        <div id="repeat" class="play-music__dashboard-controls-items">
                            <i class="icon ic-repeat"></i>
                        </div>
                    </div>
                </div>
                <!-- Phần chứa range -->
                <input class="play-music__dashboard-range" type="range" value="0" step="1" min="0"/>
                <audio id="audio" src=""></audio>
            </div>
            <div class="play-music__playlist">
                <ul class="play-music__playlist-list">
                    <!-- Phần render bằng javascript -->
                </ul>
            </div>
            <!-- Phần icon để bở danh sách phát -->
            <div class="play-music-icon">
                <i class="icon ic-list-music"></i>
            </div>
        </div>
    <?php }?>