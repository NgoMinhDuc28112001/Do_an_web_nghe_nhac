// Xử lý ẩn hiện pass
var eyes = document.querySelectorAll('.eye');
var eyes_slash = document.querySelectorAll('.eye-slash');

eyes.forEach(function(eye){
    eye.addEventListener('click',function(){
        var parentEyeElement = this.parentElement;
        parentEyeElement.querySelector('input').type = 'text';
        this.classList.remove('eye--show');
        parentEyeElement.querySelector('.eye-slash').classList.add('eye--show');
    });
});

eyes_slash.forEach(function(eye_slash){
    eye_slash.addEventListener('click',function(){
        var parentEyeElement = this.parentElement;
        parentEyeElement.querySelector('input').type = 'password';
        this.classList.remove('eye--show');
        parentEyeElement.querySelector('.eye').classList.add('eye--show');
    });
});

