

// Lấy ra các item khi click vào để chuyển trang
function handlePageUI(object)
{
    var elementNavItems = document.querySelectorAll(object['elements']);
    var elementNavItemsChild = document.querySelectorAll(object['elementsChild']);

    elementNavItems.forEach(function(element,index){
        element.onclick = function(){
            elementNavItems.forEach(function(element,index){
                element.classList.remove('item--active');
                elementNavItemsChild[index].classList.remove('item--active');
            });

            this.classList.add('item--active');
            elementNavItemsChild[index].classList.add('item--active');
        }
    });
}

handlePageUI({
    elements: '.content__nav-items',
    elementsChild: '.content__block-tab-items'
});

handlePageUI({
    elements: '.content__block-tab-nav-items',
    elementsChild: '.content__block-tab-content'
});