var link128Current = null;
var link320Current = null;
var isCheckQuality = null;

var elementBlur = document.querySelector('.blur-app');
var elementQuality = document.querySelector('.quality');
var elementInputRadio = document.querySelectorAll('.quality__block-group input');
var btnDownload = document.querySelector('.quality__block-button');

function handleDownloadSong(Link128,Link320){

    elementBlur.classList.add('item--active');
    elementQuality.classList.add('item--active');

    link128Current = Link128;
    link320Current = Link320;
}

function handleCloseDownLoad(){

    elementBlur.classList.remove('item--active');
    elementQuality.classList.remove('item--active');
}

elementInputRadio.forEach(function(radioQuality){
    if(radioQuality.classList.contains("item--active"))
    {
        isCheckQuality = radioQuality.value;
    }
    radioQuality.onclick = function(){
        for(var i = 0; i < elementInputRadio.length; i++)
        {
            elementInputRadio[i].classList.remove('item--active');
        }

        this.classList.add('item--active');

        if(this.value === '128')
        {
            isCheckQuality = this.value;
        }

        if(this.value === '320')
        {
            isCheckQuality = this.value;
        }
    }
});

// Khi nút tải về được click
btnDownload.onclick = function(){
    if(isCheckQuality === '128')
    {
        // Nếu thành công, thực hiện tải về hoặc hiển thị thông báo
        if (link128Current) {
            downloadFile(link128Current,'_128');
            alert('Đã tải bài hát với chất lượng 128 kbps');
        } else {
            alert("Lỗi: Đường dẫn tệp không hợp lệ.");
        }
    }

    if(isCheckQuality === '320')
    {
        // Nếu thành công, thực hiện tải về hoặc hiển thị thông báo
        if (link320Current) {
            downloadFile(link320Current,'_320');
            alert('Đã tải bài hát với chất lượng 320 kbps');
        } else {
            alert("Lỗi: Đường dẫn tệp không hợp lệ.");
        }
    }
}

// Hàm để tải về tệp từ đường dẫn đã cho
function downloadFile(filePath,textQuality) {
    var link = document.createElement('a');
    link.href = filePath;
    link.download = filePath.substr(filePath.lastIndexOf('/') + 1);
    link.download = link.download.substring(0,link.download.length - 4) + textQuality + '.mp3';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

