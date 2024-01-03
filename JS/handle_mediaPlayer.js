// Sử dụng AJAX để gửi yêu cầu đến file PHP và nhận dữ liệu JSON
var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        // Xử lý dữ liệu JSON
        var songs = JSON.parse(this.responseText);
        
        // Xử lý các thao tác trên playMusic
        const songName = document.querySelector('.play-music__dashboard-title-name-song');
        const songImage = document.querySelector('.play-music__dashboard-cd-img');
        const audio = document.querySelector('#audio');
        const playBtn = document.querySelector('#play');
        const pauseBtn = document.querySelector('#pause');
        const range = document.querySelector('.play-music__dashboard-range');
        const cd = document.querySelector('.play-music__dashboard-cd');
        const nextBtn = document.querySelector('#next');
        const prevBtn = document.querySelector('#prev');
        const randomBtn = document.querySelector('#random');
        const loopBtn = document.querySelector('#loop');


        const app = {
            currentIndex: 0,
            isRandom: false,
            defineProperties: function(){
                Object.defineProperty(this,'currentSong',{
                    get: function(){
                        return songs[this.currentIndex];
                    }
                })
            },
            render: function(){
                const htmls = songs.map(function(song){
                    return `
                        <li class="play-music__playlist-items">
                            <div class="play-music__playlist-items-left">
                                <div style="background-image: url(${song['songImage']});" class="play-music__playlist-items-left-img">

                                </div>
                                <div class="play-music__playlist-items-left-text">
                                    <h5 class="play-music__playlist-items-left-text-h5">${song['songName']}</h5>
                                    <ul class="play-music__playlist-items-left-text-list">
                                        <li class="play-music__playlist-items-left-text-items">
                                            ${song['artistName']}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="play-music__playlist-items-right">
                                <div class="play-music__playlist-items-right-block">
                                    <i class="fa-solid fa-ellipsis"></i>
                                    <div class="play-music__playlist-items-right-block-child">
                                        <i id="close" data-id="${song['id']}" class="icon ic-close"></i>
                                        <i id="download" data-id="${song['id']}" class="icon ic-download"></i>
                                    </div>
                                </div>
                            </div>
                        </li>`;
                });

                document.querySelector('.play-music__playlist-list').innerHTML = htmls.join('');
            },
            handleEvents: function(){
                // Xử lý đĩa CD quay
                var cdAnimate = cd.animate([
                    {transform: 'rotate(360deg)'}
                ],{
                    duration: 10000,
                    iterations: Infinity,
                });
                cdAnimate.pause();

                // Xử lý khi click vào play
                playBtn.onclick = function(){
                    audio.play();
                    cdAnimate.play();
                }

                // Xử lý khi click vào pause
                pauseBtn.onclick = function(){
                    audio.pause();
                    cdAnimate.pause();
                }

                // Khi bài hát được play
                audio.onplay = function(){
                    playBtn.classList.remove('icon--active');
                    pauseBtn.classList.add('icon--active');
                }

                // Khi bài hát bị pause
                audio.onpause = function(){
                    pauseBtn.classList.remove('icon--active');
                    playBtn.classList.add('icon--active');
                }

                // Xử lý khi tiến độ bài hát thay đổi
                audio.ontimeupdate = function(){
                    range.max = audio.duration;
                    range.value = audio.currentTime
                }

                // Xử lý khi tua bài hát
                range.onchange = function(){
                    audio.currentTime = range.value;
                    // console.log(audio.currentTime);
                    audio.play();
                    cdAnimate.play();
                }

                // Xử lý khi next bài hát
                nextBtn.onclick = function(){
                    if(app.isRandom){
                        app.randomSong();
                    }
                    else{
                        app.nextSong();
                    }
                    audio.play();
                    cdAnimate.play();
                }

                // Xử lý khi prev bài hát
                prevBtn.onclick = function(){
                    if(app.isRandom){
                        app.randomSong();
                    }
                    else{
                        app.prevSong();
                    }
                    audio.play();
                    cdAnimate.play();
                }

                // Xử lý khi random bài hát
                randomBtn.onclick = function(){
                    app.isRandom = !(app.isRandom);
                    this.classList.toggle('item--active',app.isRandom);
                }
                
            },
            nextSong: function(){
                this.currentIndex++;
                if(this.currentIndex >= songs.length)
                {
                    this.currentIndex = 0;
                };
                this.loadCurrentSong();
            },
            prevSong: function(){
                this.currentIndex--;
                if(this.currentIndex < 0)
                {
                    this.currentIndex = songs.length - 1;
                };
                this.loadCurrentSong();
            },
            randomSong: function(){
                var newIndex;
                do{
                    newIndex = Math.floor(Math.random()*songs.length);
                }while(newIndex === this.currentIndex);

                this.currentIndex = newIndex;
                this.loadCurrentSong();
            },
            loadCurrentSong: function(){
                songName.textContent = this.currentSong['songName'];
                songImage.style.backgroundImage = `url(${this.currentSong['songImage']})`;
                audio.src = this.currentSong['Link320'];
            },
            start: function(){
                // Định nghĩ các thuộc tính cho app
                this.defineProperties();
                // xử lý các sự kiện
                this.handleEvents();
                // Tải thông tin bài hát đầu tiên
                this.loadCurrentSong();
                // render ra những bài hát có trong playmusic
                this.render();
            }
        };

        // console.log(app);

        app.start();
    }
};

xhr.open("GET", "../PHP/ajax/handle_render_mediaPlayer_ajax.php", true);
xhr.send();


