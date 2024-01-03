let currentPlayingAudioNoSong = null;
let currentPlayingPlayNoSong = null;
let currentPlayingPauseNoSong = null;
let currentPlayingEllipsisNoSong = null;
let currentPlayingLikeNoSong = null;
let currentPlayingBlurNoSong = null;
let currentPlayingBlockIconNoSong = null;

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
    }
}

function playSongNoUser(
    audioId,
    iconIdPlay,
    iconIdPause,
    iconIdBlur,
    iconIdBlock,
    iconIdLiked,
    iconIdEllipsis
) {
    const audioElement = document.getElementById(audioId);
    const playElement = document.getElementById(iconIdPlay);
    const pauseElement = document.getElementById(iconIdPause);
    const blurElement = document.getElementById(iconIdBlur);
    const blockIconElement = document.getElementById(iconIdBlock);
    const likedElement = document.getElementById(iconIdLiked);
    const ellipsisElement = document.getElementById(iconIdEllipsis);

    // Mỗi khi click vào thì sẽ luôn hát từ đầu
    audioElement.currentTime = 0;

    // Dừng bài hát đang phát nếu có
    stopCurrentPlayingNoUser();

    // Bắt đầu phát bài hát mới
    audioElement.play();
    currentPlayingAudioNoSong = audioElement;
    currentPlayingPlayNoSong = playElement;
    currentPlayingPauseNoSong = pauseElement;
    currentPlayingEllipsisNoSong = ellipsisElement;

    if (likedElement) {
        currentPlayingLikeNoSong = likedElement;
    }

    currentPlayingBlurNoSong = blurElement;
    currentPlayingBlockIconNoSong = blockIconElement;

    // Chuyển nút play thành pause
    playElement.classList.remove("icon--active");
    pauseElement.classList.add("icon--active");

    // Hiển thị lớp blur và các icon khi bài hát đang phát
    blurElement.style.top = 0;

    blockIconElement.style.opacity = 1;
    blockIconElement.style.visibility = "visible";

    if (likedElement) {
        likedElement.parentElement.style.left = 0;
        likedElement.parentElement.style.opacity = 1;
        likedElement.parentElement.style.visibility = "visible";
    }

    playElement.parentElement.style.top = 0;
    playElement.parentElement.style.opacity = 1;
    playElement.parentElement.style.visibility = "visible";

    ellipsisElement.parentElement.style.right = 0;
    ellipsisElement.parentElement.style.opacity = 1;
    ellipsisElement.parentElement.style.visibility = "visible";
    
}

function pauseSongNoUser(
    audioId,
    iconIdPlay,
    iconIdPause,
    iconIdBlur,
    iconIdBlock,
    iconIdLiked,
    iconIdEllipsis
) {
    const audioElement = document.getElementById(audioId);
    const playElement = document.getElementById(iconIdPlay);
    const pauseElement = document.getElementById(iconIdPause);
    const blurElement = document.getElementById(iconIdBlur);
    const blockIconElement = document.getElementById(iconIdBlock);
    const likedElement = document.getElementById(iconIdLiked);
    const ellipsisElement = document.getElementById(iconIdEllipsis);

    // Bắt đầu phát bài hát mới
    audioElement.pause();
    currentPlayingAudioNoSong = null;

    // Chuyển nút pause thành play
    playElement.classList.add("icon--active");
    pauseElement.classList.remove("icon--active");

    // ẩn lớp blur và các icon khi bài hát đang phát
    blurElement.style = "";

    blockIconElement.style = "";

    if (likedElement) {
        likedElement.parentElement.style = "";
    }

    playElement.parentElement.style = "";

    ellipsisElement.parentElement.style = "";
}
