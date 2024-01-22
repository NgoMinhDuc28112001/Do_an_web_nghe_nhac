
// Hàm xử lý nhấn vào show ra và nhấn close hoặc blur sẽ tắt đi

function handleClickShow(myObject)
{
    var elementClick = document.querySelector(myObject['elementClick']);
    var elementShow = document.querySelector(myObject['elementShow']);
    var elementClose = document.querySelector(myObject['elementClose']);
    var elementBlur = document.querySelector('.blur-app');

    // Nếu giá trị tồn tại thì sẽ thực hiện click vào nó
    if(elementClick !== null)
    {
        elementClick.onclick = function()
        {
            elementShow.classList.add('item--active');
            elementBlur.classList.add('item--active');
        }
    }

    // Nếu giá trị tồn tại thì sẽ thực hiện click vào nó
    if(elementClose !== null){
        elementClose.onclick = function()
        {
            elementShow.classList.remove('item--active');
            elementBlur.classList.remove('item--active');
        }
    }

}

function handleToggleShow(myObject)
{
    var elementClick = document.querySelector(myObject['elementClick']);
    var elementShow = document.querySelector(myObject['elementShow']);
    var elementBlur = document.querySelector('.blur-app');
    // Nếu giá trị tồn tại thì sẽ thực hiện click vào nó
    if(elementClick !== null){
        elementClick.onclick = function()
        {
            this.classList.toggle('item--color');
            elementShow.classList.toggle('item--active');
            elementBlur.classList.toggle('item--active');
        }
    }
}

// Click cho upload ảnh đại diện
handleClickShow({
    elementClick: '.header__container-items-user',
    elementShow: '.upload-img',
    elementClose: '.upload-img__close'
});

// Click cho thay đôi màu nền giao diện
handleClickShow({
    elementClick: '#change-color',
    elementShow: '.Change-color',
    elementClose: '.Change-color__title-items--icon'
});

// Click cho tạo playlist
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

