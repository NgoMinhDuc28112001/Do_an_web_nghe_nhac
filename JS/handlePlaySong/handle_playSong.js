let currentPlayingAudio = null;
let currentPlayingPlay = null;
let currentPlayingPause = null;
let currentPlayingEllipsis = null;
let currentPlayingLike = null;
let currentPlayingDislike = null;
let currentPlayingBlur = null;
let currentPlayingBlockIcon = null;

function stopCurrentPlaying() {
    if (
        currentPlayingAudio !== null &&
        currentPlayingPlay !== null &&
        currentPlayingPause !== null &&
        !currentPlayingAudio.paused
    ) {
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
    }
}

function playSong(
    audioId,
    iconIdPlay,
    iconIdPause,
    iconIdBlur,
    iconIdBlock,
    iconIdLiked,
    iconIdDisliked,
    iconIdEllipsis
) {
    const audioElement = document.getElementById(audioId);
    const playElement = document.getElementById(iconIdPlay);
    const pauseElement = document.getElementById(iconIdPause);
    const blurElement = document.getElementById(iconIdBlur);
    const blockIconElement = document.getElementById(iconIdBlock);
    const likedElement = document.getElementById(iconIdLiked);
    const dislikedElement = document.getElementById(iconIdDisliked);
    const ellipsisElement = document.getElementById(iconIdEllipsis);

    // Mỗi khi click vào thì sẽ luôn hát từ đầu
    audioElement.currentTime = 0;

    // Dừng bài hát đang phát nếu có
    stopCurrentPlaying();

    // Bắt đầu phát bài hát mới
    audioElement.play();
    currentPlayingAudio = audioElement;
    currentPlayingPlay = playElement;
    currentPlayingPause = pauseElement;
    currentPlayingEllipsis = ellipsisElement;

    if (likedElement) {
        currentPlayingLike = likedElement;
    }

    if (dislikedElement) {
        currentPlayingDislike = dislikedElement;
    }

    currentPlayingBlur = blurElement;
    currentPlayingBlockIcon = blockIconElement;

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

    if (dislikedElement) {
        dislikedElement.parentElement.style.left = 0;
        dislikedElement.parentElement.style.opacity = 1;
        dislikedElement.parentElement.style.visibility = "visible";
    }

    playElement.parentElement.style.top = 0;
    playElement.parentElement.style.opacity = 1;
    playElement.parentElement.style.visibility = "visible";

    ellipsisElement.parentElement.style.right = 0;
    ellipsisElement.parentElement.style.opacity = 1;
    ellipsisElement.parentElement.style.visibility = "visible";

    // Thực hiện ajax khi người dùng nhấn vào bài hát thì sẽ gửi id của bài hát đó sang bên
    // Xử lý để lưu số lần bài hát đó được người dùng nghe

    var songID = playElement.dataset.id;

    // Tạo đối tượng XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Thiết lập yêu cầu HTTP POST đến file PHP xử lý
    xhr.open('POST', './ajax/handle_save_listening_ajax.php', true);

    // Thiết lập tiêu đề của yêu cầu
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Định dạng dữ liệu để gửi (ở đây là chuỗi query parameter)
    var data = 'songID=' + encodeURIComponent(songID);

    // Đặt callback để xử lý khi yêu cầu được hoàn thành
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            // Xử lý kết quả từ PHP (nếu cần)
            // console.log(this.responseText);
        } else {
            // Xử lý lỗi
            console.error('Error:', xhr.status, xhr.statusText);
        }
    };

    // Gửi yêu cầu với dữ liệu
    xhr.send(data);
    
}

function pauseSong(
    audioId,
    iconIdPlay,
    iconIdPause,
    iconIdBlur,
    iconIdBlock,
    iconIdLiked,
    iconIdDisliked,
    iconIdEllipsis
) {
    const audioElement = document.getElementById(audioId);
    const playElement = document.getElementById(iconIdPlay);
    const pauseElement = document.getElementById(iconIdPause);
    const blurElement = document.getElementById(iconIdBlur);
    const blockIconElement = document.getElementById(iconIdBlock);
    const likedElement = document.getElementById(iconIdLiked);
    const dislikedElement = document.getElementById(iconIdDisliked);
    const ellipsisElement = document.getElementById(iconIdEllipsis);

    // Bắt đầu phát bài hát mới
    audioElement.pause();
    currentPlayingAudio = null;

    // Chuyển nút pause thành play
    playElement.classList.add("icon--active");
    pauseElement.classList.remove("icon--active");

    // ẩn lớp blur và các icon khi bài hát đang phát
    blurElement.style = "";

    blockIconElement.style = "";

    if (likedElement) {
        likedElement.parentElement.style = "";
    }

    if (dislikedElement) {
        dislikedElement.parentElement.style = "";
    }

    playElement.parentElement.style = "";

    ellipsisElement.parentElement.style = "";
}
