        <div class="upload-img">
            <div class="upload-img__title">
                <h5>Ảnh đại diện</h5>
            </div>
            <div class="upload-img__close">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <!-- Kiểm tra xem có data được update hay không -->
            <?php if(!empty($user)) {?>
                <div style="background-image: url(<?php echo (isset($user['userImage'])) ? $user['userImage'] : '../Image/user-default.png' ?>)" class="upload-img__img"></div>
            <?php } else {?>
                <div style="background-image: url(../Image/user-default.png)" class="upload-img__img"></div>
            <?php }?>
            <form class="upload-img__form" method="post" action="" enctype="multipart/form-data">
                <input class="upload-img__input" type="file" name="fileImage" accept="image/*">
                <button class="upload-img__button">Tải ảnh lên</button>
            </form>
        </div>