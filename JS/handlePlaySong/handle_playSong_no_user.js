let currentPlayingAudioNoSong = null;
let currentPlayingPlayNoSong = null;
let currentPlayingPauseNoSong = null;
let currentPlayingEllipsisNoSong = null;
let currentPlayingLikeNoSong = null;
let currentPlayingBlurNoSong = null;
let currentPlayingBlockIconNoSong = null;
let currentPlayingAudioSearchNoSong = null;

function stopCurrentPlayingNoUser() {
    if (
        currentPlayingAudioNoSong !== null &&
        currentPlayingPlayNoSong !== null &&
        currentPlayingPauseNoSong !== null &&
        !currentPlayingAudioNoSong.paused
    ) {
        currentPlayingAudioNoSong.pause();
        currentPlayingPlayNoSong.classList.add("icon--active");
        currentPlayingPauseNoSong.classList.remove("icon--active");

        currentPlayingEllipsisNoSong.parentElement.style = "";
        currentPlayingPlayNoSong.parentElement.style = "";

        if (currentPlayingLikeNoSong) {
            currentPlayingLikeNoSong.parentElement.style = "";
        }

        currentPlayingBlurNoSong.style = "";
        currentPlayingBlockIconNoSong.style = "";

        // Dừng bài hát ở search hiện tại
        if(currentPlayingAudioSearchNoSong)
        {
            currentPlayingAudioSearchNoSong.click();
        }
    }
}

function playSongNoUser(idSong) {
    // Lấy id của phần tử
    var getIdAudioScreenNoUser = "#audio" + idSong;
    var getIdPlayScreenNoUser = "#play" + idSong;
    var getIdPauseScreenNoUser = "#pause" + idSong;
    var getIdBlurScreenNoUser = "#blurSong" + idSong;
    var getIdBlockIconScreenNoUser = "#blockIcon" + idSong;
    var getIdLikedScreenNoUser = "#liked" + idSong;
    // var getIdDislikedScreenNoUser = "#disliked" + idSong;
    var getIdEllipsisScreenNoUser = "#ellipsis" + idSong;

    // Lấy các element
    var elementAudioScreenNoUser = document.querySelector(getIdAudioScreenNoUser);
    var elementPlayScreenNoUser = document.querySelector(getIdPlayScreenNoUser);
    var elementPauseScreenNoUser = document.querySelector(getIdPauseScreenNoUser);
    var elementBlurScreenNoUser = document.querySelector(getIdBlurScreenNoUser);
    var elementBlockIconScreenNoUser = document.querySelector(getIdBlockIconScreenNoUser);
    var elementLikedScreenNoUser = document.querySelector(getIdLikedScreenNoUser);
    // var elementDislikedScreenNoUser = document.querySelector(getIdDislikedScreenNoUser);
    var elementEllipsisScreenNoUser = document.querySelector(getIdEllipsisScreenNoUser);

    // Mỗi khi click vào thì sẽ luôn hát từ đầu
    elementAudioScreenNoUser.currentTime = 0;

    // Dừng bài hát đang phát nếu có
    stopCurrentPlayingNoUser();

    // Bắt đầu phát bài hát mới
    elementAudioScreenNoUser.play();
    currentPlayingAudioNoSong = elementAudioScreenNoUser;
    currentPlayingPlayNoSong = elementPlayScreenNoUser;
    currentPlayingPauseNoSong = elementPauseScreenNoUser;
    currentPlayingBlurNoSong = elementBlurScreenNoUser;
    currentPlayingBlockIconNoSong = elementBlockIconScreenNoUser;
    currentPlayingLikeNoSong = elementLikedScreenNoUser;
    currentPlayingEllipsisNoSong = elementEllipsisScreenNoUser;

    if (elementLikedScreenNoUser) {
        currentPlayingLikeNoSong = elementLikedScreenNoUser;
    }

    currentPlayingBlurNoSong = elementBlurScreenNoUser;
    currentPlayingBlockIconNoSong = elementBlockIconScreenNoUser;

    // Chuyển nút play thành pause
    elementPlayScreenNoUser.classList.remove("icon--active");
    elementPauseScreenNoUser.classList.add("icon--active");

    // Hiển thị lớp blur và các icon khi bài hát đang phát
    elementBlurScreenNoUser.style.top = 0;

    elementBlockIconScreenNoUser.style.opacity = 1;
    elementBlockIconScreenNoUser.style.visibility = "visible";

    if (elementLikedScreenNoUser) {
        elementLikedScreenNoUser.parentElement.style.left = 0;
        elementLikedScreenNoUser.parentElement.style.opacity = 1;
        elementLikedScreenNoUser.parentElement.style.visibility = "visible";
    }

    elementPlayScreenNoUser.parentElement.style.top = 0;
    elementPlayScreenNoUser.parentElement.style.opacity = 1;
    elementPlayScreenNoUser.parentElement.style.visibility = "visible";

    elementEllipsisScreenNoUser.parentElement.style.right = 0;
    elementEllipsisScreenNoUser.parentElement.style.opacity = 1;
    elementEllipsisScreenNoUser.parentElement.style.visibility = "visible";

    // Ẩn header chạy lên trên
    var elementHeader = document.querySelector(".header");

    elementHeader.style.top = -70 + "px";

    // Ẩn luôn kết quả tìm kiếm trên header
    document.querySelector(".header__container-items-result").style.display = "none";

    // Khi bài hát bên ngoài giao diện kết thúc
    elementAudioScreenNoUser.onended = function () {
        this.currentTime = 0;
    };
}

function pauseSongNoUser(idSong) {
    // Lấy id của phần tử
    var getIdAudioScreenNoUser = "#audio" + idSong;
    var getIdPlayScreenNoUser = "#play" + idSong;
    var getIdPauseScreenNoUser = "#pause" + idSong;
    var getIdBlurScreenNoUser = "#blurSong" + idSong;
    var getIdBlockIconScreenNoUser = "#blockIcon" + idSong;
    var getIdLikedScreenNoUser = "#liked" + idSong;
    // var getIdDislikedScreenNoUser = "#disliked" + idSong;
    var getIdEllipsisScreenNoUser = "#ellipsis" + idSong;

    // Lấy các element
    var elementAudioScreenNoUser = document.querySelector(getIdAudioScreenNoUser);
    var elementPlayScreenNoUser = document.querySelector(getIdPlayScreenNoUser);
    var elementPauseScreenNoUser = document.querySelector(getIdPauseScreenNoUser);
    var elementBlurScreenNoUser = document.querySelector(getIdBlurScreenNoUser);
    var elementBlockIconScreenNoUser = document.querySelector(getIdBlockIconScreenNoUser);
    var elementLikedScreenNoUser = document.querySelector(getIdLikedScreenNoUser);
    // var elementDislikedScreenNoUser = document.querySelector(getIdDislikedScreenNoUser);
    var elementEllipsisScreenNoUser = document.querySelector(getIdEllipsisScreenNoUser);

    // Bắt đầu phát bài hát mới
    elementAudioScreenNoUser.pause();
    currentPlayingAudioNoSong = null;
    currentPlayingPlayNoSong = null;
    currentPlayingPauseNoSong = null;
    currentPlayingBlurNoSong = null;
    currentPlayingBlockIconNoSong = null;
    currentPlayingLikeNoSong = null;
    currentPlayingEllipsisNoSong = null;

    // Chuyển nút pause thành play
    elementPlayScreenNoUser.classList.add("icon--active");
    elementPauseScreenNoUser.classList.remove("icon--active");

    // ẩn lớp blur và các icon khi bài hát đang phát
    elementBlurScreenNoUser.style = "";

    elementBlockIconScreenNoUser.style = "";

    if (elementLikedScreenNoUser) {
        elementLikedScreenNoUser.parentElement.style = "";
    }

    elementPlayScreenNoUser.parentElement.style = "";

    elementEllipsisScreenNoUser.parentElement.style = "";

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

    // Dừng bài hát trên search nếu nó tồn tại
    if (document.querySelector("#pause-search-" + idSong)) {
        currentPlayingAudioSearchNoSong = document.querySelector("#pause-search-" + idSong);
        document.querySelector("#pause-search-" + idSong).click();
    }
}
