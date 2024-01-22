        <div class="playlist">
            <div class="playlist__title">
                Tạo playlist mới
            </div>
            <form class="playlist__form" action="" method="post" enctype="multipart/form-data">
                <label class="playlist__form-label" for="namePlaylist">Thêm tên cho playlist</label>
                <input name="namePlaylist" id="namePlaylist" class="playlist__form-input" type="text" placeholder="Nhập tên playlist" autocomplete="off">
                <label class="playlist__form-label" for="imgPlaylist">Thêm ảnh cho playlist</label>
                <input name="imgPlaylist" id="imgPlaylist" class="playlist__form-input playlist__form-input--file" type="file" placeholder="Thêm ảnh cho playlist" >
                <button title="Vui lòng nhập tên cho playlist" onclick="alert('Bạn đã tạo playlist thành công')"; class="playlist__form-button icon--disable" disabled>
                    Tạo mới
                </button>
            </form>
            <div class="playlist__close">
                <i class="icon ic-close"></i>
            </div>
        </div>