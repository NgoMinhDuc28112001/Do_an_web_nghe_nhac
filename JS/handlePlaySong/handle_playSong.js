let currentPlayingAudio = null;
let currentPlayingPlay = null;
let currentPlayingPause = null;
let currentPlayingBlur = null;
let currentPlayingBlockIcon = null;
let currentPlayingLike = null;
let currentPlayingDislike = null;
let currentPlayingEllipsis = null;
let currentPlayingIdSong = null;

function stopCurrentPlaying() {
    if (currentPlayingAudio !== null && currentPlayingPlay !== null && currentPlayingPause !== null) {

        currentPlayingAudio.pause();
        currentPlayingPlay.classList.add("icon--active");
        currentPlayingPause.classList.remove("icon--active");

        currentPlayingEllipsis.parentElement.style = "";
        currentPlayingPlay.parentElement.style = "";

        if (currentPlayingLike) {
            currentPlayingLike.parentElement.style = "";
        }

        if (currentPlayingDislike) {
            currentPlayingDislike.parentElement.style = "";
        }

        currentPlayingBlur.style = "";
        currentPlayingBlockIcon.style = "";

        // Cũng sẽ dừng bài hát trong media và dừng luôn bài hát trên ô search
        if (document.querySelector("#pause") !== null || document.querySelector("#pause") !== undefined) {
            document.querySelector("#pause").click();
        }

        if (document.querySelector("#pause-search-" + currentPlayingIdSong) !== null && document.querySelector("#pause-search-" + currentPlayingIdSong) !== undefined) {
            document.querySelector("#pause-search-" + currentPlayingIdSong).click();
        }

    }
}

function playSong(idSong) {
    // Lấy id của phần tử
    var getIdAudioScreen = "#audio" + idSong;
    var getIdPlayScreen = "#play" + idSong;
    var getIdPauseScreen = "#pause" + idSong;
    var getIdBlurScreen = "#blurSong" + idSong;
    var getIdBlockIconScreen = "#blockIcon" + idSong;
    var getIdLikedScreen = "#liked" + idSong;
    var getIdDislikedScreen = "#disliked" + idSong;
    var getIdEllipsisScreen = "#ellipsis" + idSong;

    // Lấy các element
    var elementAudioScreen = document.querySelector(getIdAudioScreen);
    var elementPlayScreen = document.querySelector(getIdPlayScreen);
    var elementPauseScreen = document.querySelector(getIdPauseScreen);
    var elementBlurScreen = document.querySelector(getIdBlurScreen);
    var elementBlockIconScreen = document.querySelector(getIdBlockIconScreen);
    var elementLikedScreen = document.querySelector(getIdLikedScreen);
    var elementDislikedScreen = document.querySelector(getIdDislikedScreen);
    var elementEllipsisScreen = document.querySelector(getIdEllipsisScreen);

    // Dừng bài hát đang phát nếu có
    stopCurrentPlaying();

    // Bắt đầu phát bài hát mới
    elementAudioScreen.play();
    currentPlayingAudio = elementAudioScreen;
    currentPlayingPlay = elementPlayScreen;
    currentPlayingPause = elementPauseScreen;
    currentPlayingBlur = elementBlurScreen;
    currentPlayingBlockIcon = elementBlockIconScreen;
    currentPlayingLike = elementLikedScreen;
    currentPlayingDislike = elementDislikedScreen;
    currentPlayingEllipsis = elementEllipsisScreen;
    currentPlayingIdSong = idSong;

    // Chuyển nút play thành pause
    elementPlayScreen.classList.remove("icon--active");
    elementPauseScreen.classList.add("icon--active");

    // Hiển thị lớp blur và các icon khi bài hát đang phát
    elementBlurScreen.style.top = 0;

    elementBlockIconScreen.style.opacity = 1;
    elementBlockIconScreen.style.visibility = "visible";

    if (elementLikedScreen) {
        elementLikedScreen.parentElement.style.left = 0;
        elementLikedScreen.parentElement.style.opacity = 1;
        elementLikedScreen.parentElement.style.visibility = "visible";
    }

    if (elementDislikedScreen) {
        elementDislikedScreen.parentElement.style.left = 0;
        elementDislikedScreen.parentElement.style.opacity = 1;
        elementDislikedScreen.parentElement.style.visibility = "visible";
    }

    elementPlayScreen.parentElement.style.top = 0;
    elementPlayScreen.parentElement.style.opacity = 1;
    elementPlayScreen.parentElement.style.visibility = "visible";

    elementEllipsisScreen.parentElement.style.right = 0;
    elementEllipsisScreen.parentElement.style.opacity = 1;
    elementEllipsisScreen.parentElement.style.visibility = "visible";

    // Xử lý để lưu số lần bài hát đó được người dùng nghe

    var songID = elementPlayScreen.dataset.id;

    // Tạo đối tượng XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Thiết lập yêu cầu HTTP POST đến file PHP xử lý
    xhr.open("POST", "./ajax/handle_save_listening_ajax.php", true);

    // Thiết lập tiêu đề của yêu cầu
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Định dạng dữ liệu để gửi (ở đây là chuỗi query parameter)
    var data = "songID=" + encodeURIComponent(songID);

    // Đặt callback để xử lý khi yêu cầu được hoàn thành
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            // Xử lý kết quả từ PHP (nếu cần)
            // console.log(this.responseText);
        } else {
            // Xử lý lỗi
            console.error("Error:", xhr.status, xhr.statusText);
        }
    };

    // Gửi yêu cầu với dữ liệu
    xhr.send(data);

    // Ẩn media player
    var elementMediaPlayer = document.querySelector(".play-music");

    elementMediaPlayer.style.right = -500 + "px";

    // Ẩn header chạy lên trên
    var elementHeader = document.querySelector(".header");

    elementHeader.style.top = -70 + "px";

    // Ẩn luôn kết quả tìm kiếm trên header
    document.querySelector(".header__container-items-result").style.display = "none";

    // Khi bài hát bên ngoài giao diện kết thúc
    elementAudioScreen.onended = function () {
        this.currentTime = 0;
    };
}

function pauseSong(idSong) {
    // Lấy id của phần tử
    var getIdAudioScreen = "#audio" + idSong;
    var getIdPlayScreen = "#play" + idSong;
    var getIdPauseScreen = "#pause" + idSong;
    var getIdBlurScreen = "#blurSong" + idSong;
    var getIdBlockIconScreen = "#blockIcon" + idSong;
    var getIdLikedScreen = "#liked" + idSong;
    var getIdDislikedScreen = "#disliked" + idSong;
    var getIdEllipsisScreen = "#ellipsis" + idSong;

    // Lấy các element
    var elementAudioScreen = document.querySelector(getIdAudioScreen);
    var elementPlayScreen = document.querySelector(getIdPlayScreen);
    var elementPauseScreen = document.querySelector(getIdPauseScreen);
    var elementBlurScreen = document.querySelector(getIdBlurScreen);
    var elementBlockIconScreen = document.querySelector(getIdBlockIconScreen);
    var elementLikedScreen = document.querySelector(getIdLikedScreen);
    var elementDislikedScreen = document.querySelector(getIdDislikedScreen);
    var elementEllipsisScreen = document.querySelector(getIdEllipsisScreen);

    // Dừng bài hát đang phát
    elementAudioScreen.pause();

    currentPlayingAudio = null;
    currentPlayingPlay = null;
    currentPlayingPause = null;
    currentPlayingBlur = null;
    currentPlayingBlockIcon = null;
    currentPlayingLike = null;
    currentPlayingDislike = null;
    currentPlayingEllipsis = null;

    // Chuyển nút pause thành play
    elementPlayScreen.classList.add("icon--active");
    elementPauseScreen.classList.remove("icon--active");

    // ẩn lớp blur và các icon khi bài hát đang phát
    elementBlurScreen.style = "";

    elementBlockIconScreen.style = "";

    if (elementLikedScreen) {
        elementLikedScreen.parentElement.style = "";
    }

    if (elementDislikedScreen) {
        elementDislikedScreen.parentElement.style = "";
    }

    elementPlayScreen.parentElement.style = "";

    elementEllipsisScreen.parentElement.style = "";

    // Hiện lại media player
    var elementMediaPlayer = document.querySelector(".play-music");

    elementMediaPlayer.style.right = "";

    // Cũng sẽ dừng bài hát trong media và dừng luôn bài hát trên ô search
    if (document.querySelector("#pause")) {
        document.querySelector("#pause").click();
    }

    if (document.querySelector("#pause-search-" + idSong)) {
        document.querySelector("#pause-search-" + idSong).click();
    }

    // Hiện lại header bằng cách cho header quay lại vị trí ban đầu
    var elementHeader = document.querySelector(".header");

    elementHeader.style = "";

    // Hiện lại kết quả tìm kiếm trên header với điều kiện là trong list kết quả phải có giá trị và trên ô search cũng có giá trị
    if (document.querySelector(".header__container-items-result-list")) {
        if (
            document.querySelector(".header__container-items-result-list").childElementCount > 0 &&
            document.querySelector(".header__container-items-input").value.trim() !== ""
        ) {
            document.querySelector(".header__container-items-result").style.display = "block";
        }
    }
}
