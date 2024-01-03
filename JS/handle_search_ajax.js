var elementInputSearch = document.querySelector('.header__container-items-input');

//Bắt sự kiện khi người dùng nhấn vào bàn phím và nhấc ngón tay lên
elementInputSearch.onkeyup = function()
{
    var searchTerm = this.value;
    // Kiểm tra nếu người dùng nhấn vào mà không nhập gì vào ô input
    if(searchTerm.trim() === '')
    {
        document.querySelector('.header__container-items-result').style.display = 'none';
        return;
    }

    // Sử dụng AJAX để gửi yêu cầu tìm kiếm đến server
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Hiển thị kết quả tìm kiếm
            document.querySelector('.header__container-items-result').style.display = 'block';
            document.querySelector('.header__container-items-result').innerHTML = this.responseText;
        }
    };
    xhr.open('GET', './ajax/handle_search_ajax.php?q=' + searchTerm, true);
    xhr.send();
}