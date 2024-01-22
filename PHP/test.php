<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Music</title>
    <style>
        .musicItem {
            margin-bottom: 10px;
        }

        .downloadButton {
            margin-left: 10px;
        }
    </style>
</head>
<body>

<!-- Hiển thị danh sách bài hát và nút tải về -->
<div id="musicList">
    <!-- Dùng PHP để lặp qua danh sách bài hát từ cơ sở dữ liệu -->
    <?php
    // Kết nối đến cơ sở dữ liệu PDO
    $servername = "your_servername";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_dbname";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM music");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='musicItem'>
                    <span class='songTitle'>{$row['title']}</span>
                    <label>
                        <input type='radio' name='quality_{$row['id']}' value='128'> 128 kbps
                    </label>
                    <label>
                        <input type='radio' name='quality_{$row['id']}' value='320'> 320 kbps
                    </label>
                    <button class='downloadButton' data-music-id='{$row['id']}' data-file-path='{$row['file_path']}'>Tải về</button>
                  </div>";
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    // Sử dụng jQuery để thực hiện AJAX khi nhấn nút tải về
    $(document).ready(function () {
        $(".downloadButton").click(function () {
            var musicId = $(this).data("music-id");
            var filePath = $(this).data("file-path");
            var selectedQuality = $(this).closest(".musicItem").find("input[type='radio']:checked").val();

            if (!selectedQuality) {
                alert("Vui lòng chọn chất lượng âm thanh.");
                return;
            }

            // Gửi yêu cầu AJAX đến PHP để xử lý tải về
            $.ajax({
                url: "download.php",
                method: "POST",
                data: { music_id: musicId, quality: selectedQuality },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        // Nếu thành công, thực hiện tải về hoặc hiển thị thông báo
                        if (response.file_path) {
                            downloadFile(response.file_path);
                        } else {
                            alert("Lỗi: Đường dẫn tệp không hợp lệ.");
                        }
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert("Có lỗi xảy ra khi tải về.");
                }
            });
        });

        // Hàm để tải về tệp từ đường dẫn đã cho
        function downloadFile(filePath) {
            var link = document.createElement('a');
            link.href = filePath;
            link.download = filePath.substr(filePath.lastIndexOf('/') + 1);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    });
</script>

</body>
</html>
