
// Hàm xử lý nhấn vào show ra và nhấn close hoặc blur sẽ tắt đi

function handleClickShow(myObject)
{
    var elementClick = document.querySelector(myObject['elementClick']);
    var elementShow = document.querySelector(myObject['elementShow']);
    var elementClose = document.querySelector(myObject['elementClose']);
    var elementBlur = document.querySelector('.blur-app');

    elementClick.onclick = function()
    {
        elementShow.classList.add('item--active');
        elementBlur.classList.add('item--active');
    }

    elementClose.onclick = function()
    {
        elementShow.classList.remove('item--active');
        elementBlur.classList.remove('item--active');
    }

}

function handleToggleShow(myObject)
{
    var elementClick = document.querySelector(myObject['elementClick']);
    var elementShow = document.querySelector(myObject['elementShow']);
    var elementBlur = document.querySelector('.blur-app');
    elementClick.onclick = function()
    {
        this.classList.toggle('item--color');
        elementShow.classList.toggle('item--active');
        elementBlur.classList.toggle('item--active');
    }
}


handleClickShow({
    elementClick: '.header__container-items-user',
    elementShow: '.upload-img',
    elementClose: '.upload-img__close'
});

handleClickShow({
    elementClick: '#change-color',
    elementShow: '.Change-color',
    elementClose: '.Change-color__title-items--icon'
});

handleClickShow({
    elementClick: '.menu__playlist',
    elementShow: '.playlist',
    elementClose: '.playlist__close'
});

handleToggleShow(
    {
        elementClick: '.play-music-icon',
        elementShow: '.play-music'
    }
);

