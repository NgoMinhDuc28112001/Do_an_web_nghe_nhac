
// Lấy ra input của create playlist
var elementInputPlaylist = document.querySelector('#namePlaylist');

elementInputPlaylist.oninput = function()
{

    if(elementInputPlaylist.value === '')
    {
        document.querySelector('.playlist__form-button').classList.add('icon--disable');
        document.querySelector('.playlist__form-button').disabled = true;
    }
    else{
        document.querySelector('.playlist__form-button').classList.remove('icon--disable');
        document.querySelector('.playlist__form-button').disabled = false;
    }
}