            <header class="header">
                <div class="header__container">
                    <div class="header__container-items">
                        <!-- Chứa mũi tên chuyển hướng của header -->
                        <div class="header__container-items-arrow">
                            <i class="fa fa-angle-left"></i>
                        </div>
                        <div class="header__container-items-arrow header__container-items-arrow--disable">
                            <i class="fa fa-angle-right"></i>
                        </div>
                        <!-- Chứa form trên header -->
                        <form class="header__container-items-form" action="">
                            <input name='q' type="text" class="header__container-items-input" placeholder="Tìm kiếm bài hát, nghệ sĩ, ..." autocomplete="off">
                            <!-- Phần được render kết quả tìm kiếm -->
                            <div class="header__container-items-result">
                                <!-- Những kết quả có liên quan sẽ render ở đây bằng ajax -->
                                
                            </div>
                            <div class="header__container-items-button">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </form>
                        <!-- Hiển thị khi có response -->
                        <div class="header__container-items-search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>
                    <div class="header__container-items">
                        <!-- Phần chưa setting -->
                        <div class="header__container-items-setting">
                            <i class="icon ic-settings"></i>
                            <div class="header__container-items-setting-option">
                                <ul class="header__container-items-setting-option-list">
                                    <li class="header__container-items-setting-option-items">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M2 10C2 5.58172 5.58172 2 10 2C14.4183 2 18 5.58172 18 10C18 14.4183 14.4183 18 10 18C5.58172 18 2 14.4183 2 10ZM10 1C5.02944 1 1 5.02944 1 10C1 14.9706 5.02944 19 10 19C14.9706 19 19 14.9706 19 10C19 5.02944 14.9706 1 10 1ZM8.70826 5.88759C7.9771 5.40235 7 5.92659 7 6.80412V13.1951C7 14.0727 7.9771 14.5969 8.70826 14.1117L13.5232 10.9161C14.1789 10.481 14.1789 9.51823 13.5232 9.0831L8.70826 5.88759ZM8 6.80412C8 6.72434 8.08883 6.67669 8.1553 6.7208L12.9702 9.9163C13.0298 9.95586 13.0298 10.0434 12.9702 10.0829L8.1553 13.2784C8.08883 13.3226 8 13.2749 8 13.1951V6.80412Z"
                                            ></path>
                                        </svg>
                                        <span class="header__container-items-setting-option-items-span">
                                            Trình phát nhạc
                                        </span>
                                    </li>
                                    <li id="change-color" class="header__container-items-setting-option-items">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M15 9.0001V3.68056L14.3894 3.78233C13.4241 3.94321 12.434 3.86553 11.5056 3.55606L9.68377 2.94878L8.64856 2.60371C8.43573 2.53276 8.21878 2.48031 8 2.4462V6.5001C8 6.77624 7.77614 7.0001 7.5 7.0001C7.22386 7.0001 7 6.77624 7 6.5001V2.41688C6.51535 2.46358 6.0387 2.59878 5.59479 2.82073L5 3.11813V9.0001H15ZM8 12.0001C6.69378 12.0001 5.58254 11.1653 5.17071 10.0001L14.8293 10.0001C14.4175 11.1653 13.3062 12.0001 12 12.0001H11H9H8ZM9 13.0001V16.0001C9 16.5524 9.44772 17.0001 10 17.0001C10.5523 17.0001 11 16.5524 11 16.0001V13.0001H9ZM8 13.0001L8 16.0001C8 17.1047 8.89543 18.0001 10 18.0001C11.1046 18.0001 12 17.1047 12 16.0001V13.0001C14.2091 13.0001 16 11.2092 16 9.0001V3.09033C16 2.78136 15.7226 2.54634 15.4178 2.59713L14.225 2.79593C13.4205 2.93001 12.5955 2.86527 11.8218 2.60738L10 2.0001L8.96479 1.65503C7.70676 1.23568 6.33367 1.33326 5.14758 1.92631L4 2.5001V9.0001C4 11.2092 5.79086 13.0001 8 13.0001Z"
                                            ></path>
                                        </svg>
                                        <span class="header__container-items-setting-option-items-span">
                                            Giao diện
                                        </span>
                                    </li>
                                </ul>
                                <div class="space"></div>
                                <ul class="header__container-items-setting-option-list">
                                    <li class="header__container-items-setting-option-items no--padding">
                                        <a href="" class="header__container-items-setting-option-items-link">
                                            <i class="icon ic-20-info"></i>
                                            <span class="header__container-items-setting-option-items-span relative--top">
                                                Giới thiệu
                                            </span>
                                        </a>
                                    </li>
                                    <li class="header__container-items-setting-option-items no--padding">
                                        <a href="" class="header__container-items-setting-option-items-link">
                                            <i class="icon ic-20-Dieukhoan"></i>
                                            <span class="header__container-items-setting-option-items-span relative--top">
                                                Thỏa thuận sử dụng
                                            </span>
                                        </a>
                                    </li>
                                    <li class="header__container-items-setting-option-items no--padding">
                                        <a href="" class="header__container-items-setting-option-items-link">
                                            <i class="icon ic-24-Privacy"></i>
                                            <span class="header__container-items-setting-option-items-span relative--top">
                                                Chính sách bảo mật
                                            </span>
                                        </a>
                                    </li>
                                    <li class="header__container-items-setting-option-items no--padding">
                                        <a href="" class="header__container-items-setting-option-items-link">
                                            <i class="icon ic-20-Call"></i>
                                            <span class="header__container-items-setting-option-items-span relative--top">
                                                Liên hệ
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Phần chứa user -->
                        <?php if(!empty($user)) { ?>
                            <div style="background-image: url(<?php echo (isset($user['userImage'])) ? $user['userImage'] : '../Image/user-default.png' ?>);" class="header__container-items-user">
                                <div class="header__container-items-user-inf">
                                    <div class="header__container-items-user-inf-title">
                                        <div class="header__container-items-user-inf-title-item">
                                            <div title="Thay đổi ảnh đại diện" style="background-image: url(<?php echo (isset($user['userImage'])) ? $user['userImage'] : '../Image/user-default.png' ?>);" class="header__container-items-user-inf-title-item-img">
                                                <div class="header__container-items-user-inf-title-item-img-blur"></div>
                                                <div class="header__container-items-user-inf-title-item-img-icon">
                                                    <i class="fa-solid fa-camera"></i>
                                                </div>
                                            </div>
                                            <div class="header__container-items-user-inf-title-item-text">
                                                <h5 class="header__container-items-user-inf-title-item-text-h5">
                                                    <?php echo $user['userName'] ?>
                                                </h5>
                                                <div class="header__container-items-user-inf-title-item-text-button">
                                                    <span class="header__container-items-user-inf-title-item-text-span">
                                                        Basic
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="" class="header__container-items-user-inf-title-button">
                                            <span class="header__container-items-user-inf-title-button-span">
                                                Nâng cấp tài khoản
                                            </span>
                                        </a>
                                    </div>
                                    <!-- Phần nội dung trong scroll -->
                                    <div class="header__container-items-user-inf-container">
                                        <div class="header__container-items-user-inf-container-title">
                                            <h5 class="header__container-items-user-inf-container-h5">
                                                Nâng cấp gói
                                            </h5>
                                        </div>
                                        <ul class="header__container-items-user-inf-container-list">
                                            <li class="header__container-items-user-inf-container-items plus--color">
                                                <h5 class="header__container-items-user-inf-container-items-h5">
                                                    <div class="header__container-items-user-inf-container-items-text">
                                                        Your Music
                                                    </div>
                                                    <span class="header__container-items-user-inf-container-items-rank">
                                                        <span>PLUS</span>
                                                    </span>
                                                </h5>
                                                <div class="header__container-items-user-inf-container-items-money">
                                                    Chỉ từ 11.000 đ/tháng
                                                </div>
                                                <div class="header__container-items-user-inf-container-items-content">
                                                    Trải nghiệm nghe nhạc với chất lượng cao nhất, không quảng cáo
                                                </div>
                                                <div class="header__container-items-user-inf-container-items-button">
                                                    <a href="" class="header__container-items-user-inf-container-items-button-link">
                                                        Tìm hiểu thêm
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="header__container-items-user-inf-container-items premium--color">
                                                <h5 class="header__container-items-user-inf-container-items-h5">
                                                    <div class="header__container-items-user-inf-container-items-text">
                                                        Your Music
                                                    </div>
                                                    <span class="header__container-items-user-inf-container-items-rank">
                                                        <span>PREMIUM</span>
                                                    </span>
                                                </h5>
                                                <div class="header__container-items-user-inf-container-items-money">
                                                    Chỉ từ 37.500 đ/tháng
                                                </div>
                                                <div class="header__container-items-user-inf-container-items-content">
                                                    Trải nghiệm nghe nhạc với chất lượng cao nhất, không quảng cáo
                                                </div>
                                                <div class="header__container-items-user-inf-container-items-button">
                                                    <a href="" class="header__container-items-user-inf-container-items-button-link">
                                                        Tìm hiểu thêm
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="space"></div>
                                        <div class="header__container-items-user-inf-container-title">
                                            <h5 class="header__container-items-user-inf-container-h5">
                                                Cá nhân
                                            </h5>
                                        </div>
                                        <ul class="header__container-items-user-inf-container-list">
                                            <li class="header__container-items-user-inf-container-items-inf">
                                                <a href="" class="header__container-items-user-inf-container-items-inf-link">
                                                    <i class="icon ic-20-Block"></i>
                                                    <span>Danh sách chặn</span>
                                                </a>
                                            </li>
                                            <li class="header__container-items-user-inf-container-items-inf">
                                                <a href="" class="header__container-items-user-inf-container-items-inf-link">
                                                    <i class="icon ic-upload"></i>
                                                    <span>Tải lên</span>
                                                </a>
                                            </li>
                                            <li class="header__container-items-user-inf-container-items-inf">
                                                <a href="handle/handle_logout.php" class="header__container-items-user-inf-container-items-inf-link">
                                                    <i class="icon ic-log-out"></i>
                                                    <span>Đăng xuất</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div style="background-image: url(../Image/user-default.png);" class="header__container-items-user">
                                <div class="header__container-items-user-inf">
                                    <!-- Phần chứa button đăng nhập -->
                                    <div class="header__container-items-user-inf-button">
                                        <a href="page_login.php" class="header__container-items-user-inf-button-link">
                                            <span>Đăng nhập</span>
                                        </a>
                                    </div>
                                    <!-- Phần chứa button đăng ký -->
                                    <div class="header__container-items-user-inf-button"></div>
                                    <!-- Phần nội dung trong scroll -->
                                    <div class="header__container-items-user-inf-container header__container-items-user-inf-container--default">
                                        <ul class="header__container-items-user-inf-container-list">
                                            <li class="header__container-items-user-inf-container-items plus--color">
                                                <h5 class="header__container-items-user-inf-container-items-h5">
                                                    <div class="header__container-items-user-inf-container-items-text">
                                                        Your Music
                                                    </div>
                                                    <span class="header__container-items-user-inf-container-items-rank">
                                                        <span>PLUS</span>
                                                    </span>
                                                </h5>
                                                <div class="header__container-items-user-inf-container-items-money">
                                                    Chỉ từ 11.000 đ/tháng
                                                </div>
                                                <div class="header__container-items-user-inf-container-items-content">
                                                    Trải nghiệm nghe nhạc với chất lượng cao nhất, không quảng cáo
                                                </div>
                                                <div class="header__container-items-user-inf-container-items-button">
                                                    <a href="" class="header__container-items-user-inf-container-items-button-link">
                                                        Tìm hiểu thêm
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="header__container-items-user-inf-container-items premium--color">
                                                <h5 class="header__container-items-user-inf-container-items-h5">
                                                    <div class="header__container-items-user-inf-container-items-text">
                                                        Your Music
                                                    </div>
                                                    <span class="header__container-items-user-inf-container-items-rank">
                                                        <span>PREMIUM</span>
                                                    </span>
                                                </h5>
                                                <div class="header__container-items-user-inf-container-items-money">
                                                    Chỉ từ 37.500 đ/tháng
                                                </div>
                                                <div class="header__container-items-user-inf-container-items-content">
                                                    Trải nghiệm nghe nhạc với chất lượng cao nhất, không quảng cáo
                                                </div>
                                                <div class="header__container-items-user-inf-container-items-button">
                                                    <a href="" class="header__container-items-user-inf-container-items-button-link">
                                                        Tìm hiểu thêm
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </header>