    let isCheckPlay = null;
    let isCheckPause = null;
    let isCheckAudio = null;
    let isCheckBlur = null;
    let isCheckBlockIcon = null;
    let isCheckBlockIconLarge = null;
    let isCheckPauseScreen = null;

    function stopAllAudio(){
        if(
            isCheckPlay !== null 
            && isCheckPause !== null 
            && isCheckBlur !== null 
            && isCheckBlockIcon !== null 
            && isCheckBlockIconLarge !== null 
            && !isCheckAudio.paused
        ){
            isCheckAudio.pause();
            // Chuyển nút pause thành play
            isCheckPause.classList.remove('icon--active');
            isCheckPlay.classList.add('icon--active');

            // Biến mất lớp blur
            isCheckBlur.style = "";

            // Ẩn đi icon play hoặc pause
            isCheckBlockIcon.style = "";

            isCheckBlockIconLarge.style = "";

            // Xử lý chuyển bài ở màn hình
            if(isCheckPauseScreen)
            {
                isCheckPauseScreen.click();
            }
        }
    }

    function playSongSearch(idSong){
        var getIdAudio = "#audio-search-" + idSong;
        var getIdPlay = "#play-search-" + idSong;
        var getIdPause = "#pause-search-" + idSong;
        var getIdBlur= "#blur-search-" + idSong;
        var getIdBlockIcon= "#block-icon-" + idSong;
        var getIdBlockIconLarge= "#block-icon-large-" + idSong;
        
        var elementAudio = document.querySelector(getIdAudio);
        var elementPlay = document.querySelector(getIdPlay);
        var elementPause = document.querySelector(getIdPause);
        var elementBlur = document.querySelector(getIdBlur);
        var elementBlockIcon = document.querySelector(getIdBlockIcon);
        var elementBlockIconLarge = document.querySelector(getIdBlockIconLarge);

        // Lấy ra nút pause của những bài hát trong giao diện
        var elementPauseScreen = document.querySelector('#pause'+idSong);

        // Dừng những bài hát đang phát nếu có
        stopAllAudio();

        elementAudio.play();

        isCheckPlay = elementPlay;
        isCheckPause = elementPause;
        isCheckAudio = elementAudio;
        isCheckBlur = elementBlur;
        isCheckBlockIcon = elementBlockIcon;
        isCheckBlockIconLarge = elementBlockIconLarge;
        isCheckPauseScreen = elementPauseScreen;

        // Chuyển nút play thành pause
        elementPlay.classList.remove('icon--active');
        elementPause.classList.add('icon--active');

        // Có lớp blur
        elementBlur.style.top = 0;

        // Hiện icon play hoặc pause
        elementBlockIcon.style.opacity = 1;
        elementBlockIcon.style.visibility = "visible";

        elementBlockIconLarge.style.opacity = 1;
        elementBlockIconLarge.style.visibility = "visible";

        // Lấy ra nút play và audio của bài hát hiện tại đang phát trong giao diện 
        var elementPlayScreen = document.querySelector('#play'+idSong);
        var elementAudioScreen = document.querySelector('#audio'+idSong);

        // Khi bài hát trong search play 
        elementAudio.onplay = function(){
            // Giống như là ta đang click vào nút play trên giao diện
            elementPlayScreen.click();

            // Cho bài hát ứng với search không phát nhạc
            elementAudioScreen.pause();

            // Cập nhật tiến độ bài hát trong search cũng phải bằng bên ngoài giao diện
            this.currentTime = elementAudioScreen.currentTime;

            // Hiện lại header bằng cách cho containers và cũng cho header quay về vị trí ban đầu
            var elementContainers = document.querySelector(".containers");

            elementContainers.style = "";

            var elementHeader = document.querySelector(".header");

            elementHeader.style = "";

            // Hiện lại kết quả tìm kiếm trên header với điều kiện là trong list kết quả phải có giá trị và trên ô search cũng có giá trị
            if (
                document.querySelector(".header__container-items-result-list").childElementCount > 0 &&
                document.querySelector(".header__container-items-input").value.trim() !== ""
            ) {
                document.querySelector(".header__container-items-result").style.display = "block";
            }
            
        }

        // Khi thời gian bài hát trong search được cập nhật
        elementAudio.ontimeupdate = function(){
            // Cập nhật thời gian bài hát bên ngoài giao diện trùng với hời gian hiện tại trong search
            elementAudioScreen.currentTime = this.currentTime;
        }

        // Khi bài hát trong search kết thúc 
        elementAudio.onended = function(){
            this.currentTime = 0;
        }
    }

    function pauseSongSearch(idSong){
        var getIdAudio = "#audio-search-" + idSong;
        var getIdPlay = "#play-search-" + idSong;
        var getIdPause = "#pause-search-" + idSong;
        var getIdBlur= "#blur-search-" + idSong;
        var getIdBlockIcon= "#block-icon-" + idSong;
        var getIdBlockIconLarge= "#block-icon-large-" + idSong;
        
        var elementAudio = document.querySelector(getIdAudio);
        var elementPlay = document.querySelector(getIdPlay);
        var elementPause = document.querySelector(getIdPause);
        var elementBlur = document.querySelector(getIdBlur);
        var elementBlockIcon = document.querySelector(getIdBlockIcon);
        var elementBlockIconLarge = document.querySelector(getIdBlockIconLarge);

        // Lấy ra nút pause của những bài hát trong giao diện
        var elementPauseScreen = document.querySelector('#pause'+idSong);
        // Giống như là ta đang click vào nút pause trên giao diện
        elementPauseScreen.click();

        elementAudio.pause();

        isCheckPlay = null;
        isCheckPause = null;
        isCheckAudio = null;
        isCheckBlur = null;
        isCheckBlockIcon = null;
        isCheckBlockIconLarge = null;
        isCheckPauseScreen = null;

        // Chuyển nút pause thành play
        elementPause.classList.remove('icon--active');
        elementPlay.classList.add('icon--active');

        // Ẩn lớp blur
        elementBlur.style = "";

        // Ẩn đi icon play hoặc pause
        elementBlockIcon.style = "";

        elementBlockIconLarge.style = "";
    }