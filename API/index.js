const puppeteer = require("puppeteer");
const axios = require("axios");
const fs = require("fs");
const path = require("path");

(async () => {
    // Khởi tạo trình duyệt
    const browser = await puppeteer.launch({ headless: false, protocolTimeout: 700000 });
    const pageChill = await browser.newPage();

    // Đặt kích thước màn hình hiển thị (viewport)
    await pageChill.setViewport({ width: 1105, height: 600 });

    // Truy cập trang web tìm kiếm
    await pageChill.goto("https://zingmp3.vn/");

    // Đăng nhập vào zing
    await pageChill.waitForSelector(".user-setting");
    const userBtn = await pageChill.$(".user-setting");
    await userBtn.click();

    // nhấn vào nút đăng nhập
    await pageChill.waitForSelector(".zm-btn.login-button.button");
    const loginBtn = await pageChill.$(".zm-btn.login-button.button");
    await loginBtn.click();

    await pageChill.waitForTimeout(15000);
    /*----------------------------------------------------------------------------------- Lấy nhạc chill -----------------------------------------------------------*/

    // Chờ nút thư viện load xong
    await pageChill.waitForSelector(".zm-navbar-menu .zm-navbar-item:last-child");

    // Sau khi load xong thì click vào
    const libraryChill = await pageChill.$(".zm-navbar-menu .zm-navbar-item:last-child");

    await libraryChill.click();

    // Sau khi click xong ta chờ đợi cho thư viện được load xong
    await pageChill.waitForSelector(
        'a[href="/album/Nhac-Hoa-Loi-Viet-Nhe-Nhang-Duong-Edward-Bao-Anh-Vicky-Nhung-Juky-San/6BC7Z8EC.html"]'
    );

    const linkSongChill = await pageChill.$(
        'a[href="/album/Nhac-Hoa-Loi-Viet-Nhe-Nhang-Duong-Edward-Bao-Anh-Vicky-Nhung-Juky-San/6BC7Z8EC.html"]'
    );

    await linkSongChill.click();

    // Sau khi click chờ list bài hát được load xong
    await pageChill.waitForSelector(".list.mar-b-10.song-list-select");

    // Chúng ta sẽ bắt đầu lăn để load hết những bài hát
    for (var i = 0; i < 10; i++) {
        await pageChill.keyboard.press("PageDown");
        await pageChill.waitForTimeout(1000);
    }

    // Chắc chắn rằng tất cả các bài hát đều đã load xong
    await pageChill.waitForSelector(".select-item");

    // Lấy ra những bài hát chill
    const songsChill = await pageChill.$$(".select-item");

    const listSongChill = [];
    var listLinkStream = [];
    var cid = 0;
    for (const song of songsChill) {
        const titleSong = await song.$eval(".item-title.title span span span", function (element) {
            return element.innerText;
        });
        const avatarSong = await song.$eval(".song-thumb figure img", function (element) {
            return element.src;
        });
        const nameArtists = await song.$$eval(".is-one-line.is-truncate.subtitle .is-ghost", function (elements) {
            return elements.map(function (element) {
                return element.innerText;
            });
        });

        // Xử lý lấy ra nguồn của bài hát
        // Lấy ra nút phát nhạc
        const playBtn = await song.$(".zm-btn.action-play.button");
        await playBtn.click();

        // Thời lượng phát là 5 giây
        await pageChill.waitForTimeout(5000);

        pageChill.on("request", (request) => {
            if (request.url().includes("https://zingmp3.vn/api/v2/song/get/streaming?id=")) {
                // console.log(request.url());
                listLinkStream.push(request.url());
            }
        });

        // Khi bài hát tới bài hát cuối thì chúng ta sẽ quay ngược lên click vào bài hát đầu tiên để phát nhạc và lấy API
        if (song === songsChill[songsChill.length - 1]) {
            const playBtn = await songsChill[0].$(".zm-btn.action-play.button");
            await playBtn.click();

            // Thời lượng phát là 3 giây
            await pageChill.waitForTimeout(5000);

            pageChill.on("request", (request) => {
                if (request.url().includes("https://zingmp3.vn/api/v2/song/get/streaming?id=")) {
                    listLinkStream.push(request.url());
                }
            });

            await pageChill.close();
        }

        listSongChill.push({ id: cid, avatarSong: avatarSong, titleSong: titleSong, nameArtists: nameArtists });
        cid++;
    }

    // console.log(listSongChill);

    listLinkStream = [...new Set(listLinkStream)];
    var lastStream = listLinkStream.pop();

    listLinkStream.unshift(lastStream);

    // console.log(listLinkStream);

    // console.log(listLinkStream.length);

    const listAudioChill = [];
    var cid = 0;
    for (var i = 0; i < listLinkStream.length; i++) {
        const pageAPI = await browser.newPage();
        // Chuyển sang trang có link stream
        await pageAPI.goto(listLinkStream[i]);

        // Thời lượng phát là 5 giây
        await pageAPI.waitForTimeout(5000);

        var API = await pageAPI.$eval("pre", function (element) {
            return element.innerText;
        });

        listAudioChill.push({ id: cid, linkAudio: JSON.parse(API)["data"] });
        cid++;

        // Đóng tab
        await pageAPI.close();
    }

    // console.log(listAudioChill);
    // console.log(listAudioChill.length);

    const APIChill = listSongChill.map((elementSong) => {
        const matchingItem = listAudioChill.find((elementAudio) => elementAudio.id === elementSong.id);
        return matchingItem ? { ...elementSong, ...matchingItem } : elementSong;
    });

    // console.log(APIChill);

    // Lặp qua mảng để thay ảnh thành ảnh lớn và nét hơn
    const listAvatarLargeChill = [];
    var cid = 0;
    for (var APIChild of APIChill) {
        const titleSong = APIChild["titleSong"];
        const nameArtists = APIChild["nameArtists"][0];

        const pageSearchChill = await browser.newPage();

        // Đặt kích thước màn hình hiển thị (viewport)
        await pageSearchChill.setViewport({ width: 1105, height: 600 });
        // Truy cập trang web tìm kiếm
        await pageSearchChill.goto("https://zingmp3.vn/");

        // Chờ đợi thanh search load ra
        await pageSearchChill.waitForSelector(".form-control.z-input-placeholder");

        await pageSearchChill.type(".form-control.z-input-placeholder", titleSong + " " + nameArtists);

        // Nhấn phím Enter để thực hiện tìm kiếm
        await pageSearchChill.keyboard.press("Enter");

        await pageSearchChill.waitForSelector(
            ".zm-carousel-item.is-fullhd-4.is-widescreen-4.is-desktop-4.is-touch-4.is-tablet-4"
        );

        const avatarNew = await pageSearchChill.$$(
            ".zm-carousel-item.is-fullhd-4.is-widescreen-4.is-desktop-4.is-touch-4.is-tablet-4"
        );

        const avatarSong = await avatarNew[0].$eval(".song-thumb figure img", function (element) {
            return element.src;
        });

        listAvatarLargeChill.push({ id: cid, kindMusic: "chill", avatarSongNew: avatarSong });
        cid++;

        // Sau khi lưu được hết bài hát thì đóng trang pageSearchChill
        await pageSearchChill.close();
    }

    // console.log(listAvatarLargeChill.length);
    // console.log(listAvatarLargeChill);

    // Lấy ra API có gộp cả ảnh lớn
    const APIChillNew = APIChill.map((elementApiChill) => {
        const matchingItem = listAvatarLargeChill.find(
            (elementAvatarNew) => elementAvatarNew.id === elementApiChill.id
        );
        return matchingItem ? { ...elementApiChill, ...matchingItem } : elementApiChill;
    });

    // console.log(APIChillNew);

    // Tải và lưu các file âm thanh
    // List âm thanh tải về
    const listMp3Chill = [];
    var cid = 0;
    for (const elementChillNew of APIChillNew) {
        // Chuỗi ban đầu
        const originalString = elementChillNew['titleSong'];

        // Bước 1: Chuẩn hóa chuỗi
        const trimmedString = originalString.split(' (')[0];

        const normalizedString = trimmedString.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

        // Bước 2: Thay thế khoảng trắng bằng gạch dưới
        const underscoredString = normalizedString.replace(/\s+/g, "_");

        // Bước 3: Thêm phần mở rộng file .mp3
        const finalString = underscoredString +".mp3";

        const filePath128 = path.join("../music/Nhac_chill/128",finalString);
        const filePath320 = path.join("../music/Nhac_chill/320",finalString);

        try {
            const response128 = await axios.get(elementChillNew["linkAudio"]["128"], { responseType: "arraybuffer" });
            const response320 = await axios.get(elementChillNew["linkAudio"]["320"], { responseType: "arraybuffer" });
            fs.writeFileSync(filePath128, Buffer.from(response128.data));
            fs.writeFileSync(filePath320, Buffer.from(response320.data));
            console.log(`Audio saved to ${filePath128}`);
            console.log(`Audio saved to ${filePath320}`);

            listMp3Chill.push({id: cid, mp3Link128: '../music/Nhac_chill/128/' + finalString, mp3Link320: '../music/Nhac_chill/320/' + finalString});
            cid++;
        } catch (error) {
            console.error(`Error downloading audio from ${elementChillNew["linkAudio"]["128"]}: ${error.message}`);
            console.error(`Error downloading audio from ${elementChillNew["linkAudio"]["320"]}: ${error.message}`);
        }
    }

    // console.log(listMp3Chill);

    // Lấy API có gộp cả link nhạc được tải về thư mục
    const APIChillNewMost = APIChillNew.map((elementApiChill) => {
        const matchingItem = listMp3Chill.find(
            (elementMp3Chill) => elementMp3Chill.id === elementApiChill.id
        );
        return matchingItem ? { ...elementApiChill, ...matchingItem } : elementApiChill;
    });

    console.log(APIChillNewMost);

    var jsonAPIChill = { APIChillNewMost };

    // // Chuyển đối JSON thành chuỗi
    var jsonString = JSON.stringify(jsonAPIChill);

    // // Ghi chuỗi JSON vào tệp
    fs.writeFileSync("APIChill.json", jsonString);

    // Sau khi lấy xong chill thì lại mở lại trang zing mp3

    const pageSad = await browser.newPage();

    // Đặt kích thước màn hình hiển thị (viewport)
    await pageSad.setViewport({ width: 1105, height: 600 });

    // Truy cập trang web tìm kiếm
    await pageSad.goto("https://zingmp3.vn/");

    /*----------------------------------------------------------------------------------- Lấy nhạc sad -----------------------------------------------------------*/

    // Chờ nút thư viện load xong
    await pageSad.waitForSelector(".zm-navbar-menu .zm-navbar-item:last-child");

    // Sau khi load xong thì click vào
    const librarySad = await pageSad.$(".zm-navbar-menu .zm-navbar-item:last-child");

    await librarySad.click();

    // Sau khi click xong ta chờ đợi cho thư viện được load xong
    await pageSad.waitForSelector(
        'a[href="/album/tinh-dau-co-phai-tinh-dau-Andiez-T-R-I-Kai-Dinh-SOOBIN/ZOBIW6UZ.html"]'
    );

    const linkSongSad = await pageSad.$(
        'a[href="/album/tinh-dau-co-phai-tinh-dau-Andiez-T-R-I-Kai-Dinh-SOOBIN/ZOBIW6UZ.html"]'
    );

    await linkSongSad.click();

    // Sau khi click chờ list bài hát được load xong
    await pageSad.waitForSelector(".list.mar-b-10.song-list-select");

    // Chúng ta sẽ bắt đầu lăn để load hết những bài hát
    for (var i = 0; i < 10; i++) {
        await pageSad.keyboard.press("PageDown");
        await pageSad.waitForTimeout(1000);
    }

    // Chắc chắn rằng tất cả các bài hát đều đã load xong
    await pageSad.waitForSelector(".select-item");

    // Lấy ra những bài hát Sad
    const songsSad = await pageSad.$$(".select-item");

    const listSongSad = [];
    var listLinkStream = [];
    var sid = APIChillNew.length;
    for (const song of songsSad) {
        const titleSong = await song.$eval(".item-title.title span span span", function (element) {
            return element.innerText;
        });
        const avatarSong = await song.$eval(".song-thumb figure img", function (element) {
            return element.src;
        });
        const nameArtists = await song.$$eval(".is-one-line.is-truncate.subtitle .is-ghost", function (elements) {
            return elements.map(function (element) {
                return element.innerText;
            });
        });

        // Xử lý lấy ra nguồn của bài hát
        // Lấy ra nút phát nhạc
        const playBtn = await song.$(".zm-btn.action-play.button");
        await playBtn.click();

        // Thời lượng phát là 5 giây
        await pageSad.waitForTimeout(5000);

        pageSad.on("request", (request) => {
            if (request.url().includes("https://zingmp3.vn/api/v2/song/get/streaming?id=")) {
                // console.log(request.url());
                listLinkStream.push(request.url());
            }
        });

        // Khi bài hát tới bài hát cuối thì chúng ta sẽ quay ngược lên click vào bài hát đầu tiên để phát nhạc và lấy API
        if (song === songsSad[songsSad.length - 1]) {
            const playBtn = await songsSad[0].$(".zm-btn.action-play.button");
            await playBtn.click();

            // Thời lượng phát là 3 giây
            await pageSad.waitForTimeout(5000);

            pageSad.on("request", (request) => {
                if (request.url().includes("https://zingmp3.vn/api/v2/song/get/streaming?id=")) {
                    listLinkStream.push(request.url());
                }
            });

            await pageSad.close();
        }

        listSongSad.push({ id: sid, avatarSong: avatarSong, titleSong: titleSong, nameArtists: nameArtists });
        sid++;
    }

    // console.log(listSongSad);

    listLinkStream = [...new Set(listLinkStream)];
    var lastStream = listLinkStream.pop();

    listLinkStream.unshift(lastStream);

    // console.log(listLinkStream);

    // console.log(listLinkStream.length);

    const listAudioSad = [];
    var sid = APIChillNew.length;
    for (var i = 0; i < listLinkStream.length; i++) {
        const pageSadAPI = await browser.newPage();
        // Chuyển sang trang có link stream
        await pageSadAPI.goto(listLinkStream[i]);

        // Thời lượng phát là 5 giây
        await pageSadAPI.waitForTimeout(5000);

        var API = await pageSadAPI.$eval("pre", function (element) {
            return element.innerText;
        });

        listAudioSad.push({ id: sid, linkAudio: JSON.parse(API)["data"] });
        sid++;

        // Đóng tab
        await pageSadAPI.close();
    }

    // console.log(listAudioSad);
    // console.log(listAudioSad.length);

    const APISad = listSongSad.map((elementSong) => {
        const matchingItem = listAudioSad.find((elementAudio) => elementAudio.id === elementSong.id);
        return matchingItem ? { ...elementSong, ...matchingItem } : elementSong;
    });

    // console.log(APISad);

    // Lặp qua mảng để thay ảnh thành ảnh lớn và nét hơn
    const listAvatarLargeSad = [];
    var sid = APIChillNew.length;
    for (var APIChild of APISad) {
        const titleSong = APIChild["titleSong"];
        const nameArtists = APIChild["nameArtists"][0];

        const pageSearchSad = await browser.newPage();

        await pageSearchSad.setViewport({ width: 1105, height: 600 });
        // Truy cập trang web tìm kiếm
        await pageSearchSad.goto("https://zingmp3.vn/");

        // Chờ đợi thanh search load ra
        await pageSearchSad.waitForSelector(".form-control.z-input-placeholder");

        await pageSearchSad.type(".form-control.z-input-placeholder", titleSong + " " + nameArtists);

        // Nhấn phím Enter để thực hiện tìm kiếm
        await pageSearchSad.keyboard.press("Enter");

        await pageSearchSad.waitForSelector(
            ".zm-carousel-item.is-fullhd-4.is-widescreen-4.is-desktop-4.is-touch-4.is-tablet-4"
        );

        const avatarNew = await pageSearchSad.$$(
            ".zm-carousel-item.is-fullhd-4.is-widescreen-4.is-desktop-4.is-touch-4.is-tablet-4"
        );

        const avatarSong = await avatarNew[0].$eval(".song-thumb figure img", function (element) {
            return element.src;
        });

        listAvatarLargeSad.push({ id: sid, kindMusic: "sad", avatarSongNew: avatarSong });
        sid++;

        // Sau khi lưu được hết bài hát thì đóng trang pageSearchSad
        await pageSearchSad.close();
    }

    // console.log(listAvatarLargeSad.length);
    // console.log(listAvatarLargeSad);

    // Lấy ra API có gộp cả ảnh lớn
    const APISadNew = APISad.map((elementApiSad) => {
        const matchingItem = listAvatarLargeSad.find((elementAvatarNew) => elementAvatarNew.id === elementApiSad.id);
        return matchingItem ? { ...elementApiSad, ...matchingItem } : elementApiSad;
    });

    // console.log(APISadNew);

    // Tải và lưu các file âm thanh
    // List âm thanh tải về
    const listMp3Sad = [];
    var sid = APIChillNew.length;
    for (const elementSadNew of APISadNew) {
        // Chuỗi ban đầu
        const originalString = elementSadNew['titleSong'];

        // Bước 1: Chuẩn hóa chuỗi
        const trimmedString = originalString.split(' (')[0];

        const normalizedString = trimmedString.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

        // Bước 2: Thay thế khoảng trắng bằng gạch dưới
        const underscoredString = normalizedString.replace(/\s+/g, "_");

        // Bước 3: Thêm phần mở rộng file .mp3
        const finalString = underscoredString +".mp3";

        const filePath128 = path.join("../music/Nhac_sad/128",finalString);
        const filePath320 = path.join("../music/Nhac_sad/320",finalString);

        try {
            const response128 = await axios.get(elementSadNew["linkAudio"]["128"], { responseType: "arraybuffer" });
            const response320 = await axios.get(elementSadNew["linkAudio"]["320"], { responseType: "arraybuffer" });
            fs.writeFileSync(filePath128, Buffer.from(response128.data));
            fs.writeFileSync(filePath320, Buffer.from(response320.data));
            console.log(`Audio saved to ${filePath128}`);
            console.log(`Audio saved to ${filePath320}`);

            listMp3Sad.push({id: sid, mp3Link128: '../music/Nhac_sad/128/' + finalString, mp3Link320: '../music/Nhac_sad/320/' + finalString});
            sid++;
        } catch (error) {
            console.error(`Error downloading audio from ${elementSadNew["linkAudio"]["128"]}: ${error.message}`);
            console.error(`Error downloading audio from ${elementSadNew["linkAudio"]["320"]}: ${error.message}`);
        }
    }

    // console.log(listMp3Sad);

    // Lấy API có gộp cả link nhạc được tải về thư mục
    const APISadNewMost = APISadNew.map((elementApiSad) => {
        const matchingItem = listMp3Sad.find(
            (elementMp3Sad) => elementMp3Sad.id === elementApiSad.id
        );
        return matchingItem ? { ...elementApiSad, ...matchingItem } : elementApiSad;
    });

    console.log(APISadNewMost);

    var jsonAPISad = { APISadNewMost };
    // Chuyển đối JSON thành chuỗi
    var jsonString = JSON.stringify(jsonAPISad);

    // Ghi chuỗi JSON vào tệp
    fs.writeFileSync("APISad.json", jsonString);

    // Sau khi lấy xong sad thì lại mở lại trang zing mp3

    const pageRemix = await browser.newPage();

    // Đặt kích thước màn hình hiển thị (viewport)
    await pageRemix.setViewport({ width: 1105, height: 600 });

    // Truy cập trang web tìm kiếm
    await pageRemix.goto("https://zingmp3.vn/");

    /*----------------------------------------------------------------------------------- Lấy nhạc remix -----------------------------------------------------------*/

    // Chờ nút thư viện load xong
    await pageRemix.waitForSelector(".zm-navbar-menu .zm-navbar-item:last-child");

    // Sau khi load xong thì click vào
    const libraryRemix = await pageRemix.$(".zm-navbar-menu .zm-navbar-item:last-child");

    await libraryRemix.click();

    // Sau khi click xong ta chờ đợi cho thư viện được load xong
    await pageRemix.waitForSelector(
        'a[href="/album/Choi-Toi-Ben-Tracy-Thao-My-Hana-Cam-Tien-Nal-Nguyen-Dinh-Vu/6BDCCI96.html"]'
    );

    const linkSongRemix = await pageRemix.$(
        'a[href="/album/Choi-Toi-Ben-Tracy-Thao-My-Hana-Cam-Tien-Nal-Nguyen-Dinh-Vu/6BDCCI96.html"]'
    );

    await linkSongRemix.click();

    // Sau khi click chờ list bài hát được load xong
    await pageRemix.waitForSelector(".list.mar-b-10.song-list-select");

    // Chúng ta sẽ bắt đầu lăn để load hết những bài hát
    for (var i = 0; i < 10; i++) {
        await pageRemix.keyboard.press("PageDown");
        await pageRemix.waitForTimeout(1000);
    }

    // Chắc chắn rằng tất cả các bài hát đều đã load xong
    await pageRemix.waitForSelector(".select-item");

    // Lấy ra những bài hát chill
    const songsRemix = await pageRemix.$$(".select-item");

    const listSongRemix = [];
    var listLinkStream = [];
    var rid = APIChillNew.length + APISadNew.length;
    for (const song of songsRemix) {
        const titleSong = await song.$eval(".item-title.title span span span", function (element) {
            return element.innerText;
        });
        const avatarSong = await song.$eval(".song-thumb figure img", function (element) {
            return element.src;
        });
        const nameArtists = await song.$$eval(".is-one-line.is-truncate.subtitle .is-ghost", function (elements) {
            return elements.map(function (element) {
                return element.innerText;
            });
        });

        // Xử lý lấy ra nguồn của bài hát
        // Lấy ra nút phát nhạc
        const playBtn = await song.$(".zm-btn.action-play.button");
        await playBtn.click();

        // Thời lượng phát là 5 giây
        await pageRemix.waitForTimeout(5000);

        pageRemix.on("request", (request) => {
            if (request.url().includes("https://zingmp3.vn/api/v2/song/get/streaming?id=")) {
                // console.log(request.url());
                listLinkStream.push(request.url());
            }
        });

        // Khi bài hát tới bài hát cuối thì chúng ta sẽ quay ngược lên click vào bài hát đầu tiên để phát nhạc và lấy API
        if (song === songsRemix[songsRemix.length - 1]) {
            const playBtn = await songsRemix[0].$(".zm-btn.action-play.button");
            await playBtn.click();

            // Thời lượng phát là 3 giây
            await pageRemix.waitForTimeout(5000);

            pageRemix.on("request", (request) => {
                if (request.url().includes("https://zingmp3.vn/api/v2/song/get/streaming?id=")) {
                    listLinkStream.push(request.url());
                }
            });

            await pageRemix.close();
        }

        listSongRemix.push({ id: rid, avatarSong: avatarSong, titleSong: titleSong, nameArtists: nameArtists });
        rid++;
    }

    // console.log(listSongRemix);

    listLinkStream = [...new Set(listLinkStream)];
    var lastStream = listLinkStream.pop();

    listLinkStream.unshift(lastStream);

    // console.log(listLinkStream);

    // console.log(listLinkStream.length);

    const listAudioRemix = [];
    var rid = APIChillNew.length + APISadNew.length;
    for (var i = 0; i < listLinkStream.length; i++) {
        const pageAPI = await browser.newPage();
        // Chuyển sang trang có link stream
        await pageAPI.goto(listLinkStream[i]);

        // Thời lượng phát là 5 giây
        await pageAPI.waitForTimeout(5000);

        var API = await pageAPI.$eval("pre", function (element) {
            return element.innerText;
        });

        listAudioRemix.push({ id: rid, linkAudio: JSON.parse(API)["data"] });
        rid++;

        // Đóng tab
        await pageAPI.close();
    }

    // console.log(listAudioRemix);
    // console.log(listAudioRemix.length);

    const APIRemix = listSongRemix.map((elementSong) => {
        const matchingItem = listAudioRemix.find((elementAudio) => elementAudio.id === elementSong.id);
        return matchingItem ? { ...elementSong, ...matchingItem } : elementSong;
    });

    // console.log(APIRemix);

    // Lặp qua mảng để thay ảnh thành ảnh lớn và nét hơn
    const listAvatarLargeRemix = [];
    var rid = APIChillNew.length + APISadNew.length;
    for (var APIChild of APIRemix) {
        const titleSong = APIChild["titleSong"];
        const nameArtists = APIChild["nameArtists"][0];

        const pageSearchRemix = await browser.newPage();

        // Đặt kích thước màn hình hiển thị (viewport)
        await pageSearchRemix.setViewport({ width: 1105, height: 600 });
        // Truy cập trang web tìm kiếm
        await pageSearchRemix.goto("https://zingmp3.vn/");

        // Chờ đợi thanh search load ra
        await pageSearchRemix.waitForSelector(".form-control.z-input-placeholder");

        await pageSearchRemix.type(".form-control.z-input-placeholder", titleSong + " " + nameArtists);

        // Nhấn phím Enter để thực hiện tìm kiếm
        await pageSearchRemix.keyboard.press("Enter");

        await pageSearchRemix.waitForSelector(
            ".zm-carousel-item.is-fullhd-4.is-widescreen-4.is-desktop-4.is-touch-4.is-tablet-4"
        );

        const avatarNew = await pageSearchRemix.$$(
            ".zm-carousel-item.is-fullhd-4.is-widescreen-4.is-desktop-4.is-touch-4.is-tablet-4"
        );

        const avatarSong = await avatarNew[0].$eval(".song-thumb figure img", function (element) {
            return element.src;
        });

        listAvatarLargeRemix.push({ id: rid, kindMusic: "Remix", avatarSongNew: avatarSong });
        rid++;

        // Sau khi lưu được hết bài hát thì đóng trang pageSearchRemix
        await pageSearchRemix.close();
    }

    // console.log(listAvatarLargeRemix.length);
    // console.log(listAvatarLargeRemix);

    // Lấy ra API có gộp cả ảnh lớn
    const APIRemixNew = APIRemix.map((elementApiRemix) => {
        const matchingItem = listAvatarLargeRemix.find(
            (elementAvatarNew) => elementAvatarNew.id === elementApiRemix.id
        );
        return matchingItem ? { ...elementApiRemix, ...matchingItem } : elementSong;
    });

    console.log(APIRemixNew);

    // Tải và lưu các file âm thanh
    // List âm thanh tải về
    var listMp3Remix = [];
    var rid = APIChillNew.length + APISadNew.length;
    for (const elementRemixNew of APIRemixNew) {
        // Chuỗi ban đầu
        const originalString = elementRemixNew['titleSong'];

        // Bước 1: Chuẩn hóa chuỗi
        const trimmedString = originalString.split(' (')[0];

        const normalizedString = trimmedString.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

        // Bước 2: Thay thế khoảng trắng bằng gạch dưới
        const underscoredString = normalizedString.replace(/\s+/g, "_");

        // Bước 3: Thêm phần mở rộng file .mp3
        const finalString = underscoredString +".mp3";

        const filePath128 = path.join("../music/Nhac_remix/128",finalString);
        const filePath320 = path.join("../music/Nhac_remix/320",finalString);

        try {
            const response128 = await axios.get(elementRemixNew["linkAudio"]["128"], { responseType: "arraybuffer" });
            const response320 = await axios.get(elementRemixNew["linkAudio"]["320"], { responseType: "arraybuffer" });
            fs.writeFileSync(filePath128, Buffer.from(response128.data));
            fs.writeFileSync(filePath320, Buffer.from(response320.data));
            console.log(`Audio saved to ${filePath128}`);
            console.log(`Audio saved to ${filePath320}`);

            listMp3Remix.push({id: rid, mp3Link128: '../music/Nhac_remix/128/' + finalString, mp3Link320: '../music/Nhac_remix/320/' + finalString});
            rid++;
        } catch (error) {
            console.error(`Error downloading audio from ${elementRemixNew["linkAudio"]["128"]}: ${error.message}`);
            console.error(`Error downloading audio from ${elementRemixNew["linkAudio"]["320"]}: ${error.message}`);
        }
    }

    // console.log(listMp3Remix);

    // Lấy API có gộp cả link nhạc được tải về thư mục
    const APIRemixNewMost = APIRemixNew.map((elementApiRemix) => {
        const matchingItem = listMp3Remix.find(
            (elementMp3Remix) => elementMp3Remix.id === elementApiRemix.id
        );
        return matchingItem ? { ...elementApiRemix, ...matchingItem } : elementApiRemix;
    });

    console.log(APIRemixNewMost);

    var jsonAPIRemix = { APIRemixNewMost };
    // Chuyển đối JSON thành chuỗi
    var jsonString = JSON.stringify(jsonAPIRemix);

    // Ghi chuỗi JSON vào tệp
    fs.writeFileSync("APIRemix.json", jsonString);

    // Sau khi lấy xong remix thì lại mở lại trang zing mp3

    const pageHot2023 = await browser.newPage();

    // Đặt kích thước màn hình hiển thị (viewport)
    await pageHot2023.setViewport({ width: 1105, height: 600 });

    // Truy cập trang web tìm kiếm
    await pageHot2023.goto("https://zingmp3.vn/");

    /*----------------------------------------------------------------------------------- Lấy nhạc hay nhất 2023 -----------------------------------------------------------*/

    // Chờ nút thư viện load xong
    await pageHot2023.waitForSelector(".zm-navbar-menu .zm-navbar-item:last-child");

    // Sau khi load xong thì click vào
    const libraryHot2023 = await pageHot2023.$(".zm-navbar-menu .zm-navbar-item:last-child");

    await libraryHot2023.click();

    // Sau khi click xong ta chờ đợi cho thư viện được load xong
    await pageHot2023.waitForSelector(
        'a[href="/album/Ballad-Viet-Noi-Bat-2023-Bao-Anh-Thanh-Dat-Van-Mai-Huong-Myra-Tran/6BEIA70A.html"]'
    );

    const linkSongHot2023 = await pageHot2023.$(
        'a[href="/album/Ballad-Viet-Noi-Bat-2023-Bao-Anh-Thanh-Dat-Van-Mai-Huong-Myra-Tran/6BEIA70A.html"]'
    );

    await linkSongHot2023.click();

    // Sau khi click chờ list bài hát được load xong
    await pageHot2023.waitForSelector(".list.mar-b-10.song-list-select");

    // Chúng ta sẽ bắt đầu lăn để load hết những bài hát
    for (var i = 0; i < 10; i++) {
        await pageHot2023.keyboard.press("PageDown");
        await pageHot2023.waitForTimeout(1000);
    }

    // Chắc chắn rằng tất cả các bài hát đều đã load xong
    await pageHot2023.waitForSelector(".select-item");

    // Lấy ra những bài hát chill
    const songsHot2023 = await pageHot2023.$$(".select-item");

    const listSongHot2023 = [];
    var listLinkStream = [];
    var hid = APIChillNew.length + APISadNew.length + APIRemixNew.length;
    for (const song of songsHot2023) {
        const titleSong = await song.$eval(".item-title.title span span span", function (element) {
            return element.innerText;
        });
        const avatarSong = await song.$eval(".song-thumb figure img", function (element) {
            return element.src;
        });
        const nameArtists = await song.$$eval(".is-one-line.is-truncate.subtitle .is-ghost", function (elements) {
            return elements.map(function (element) {
                return element.innerText;
            });
        });

        // Xử lý lấy ra nguồn của bài hát
        // Lấy ra nút phát nhạc
        const playBtn = await song.$(".zm-btn.action-play.button");
        await playBtn.click();

        // Thời lượng phát là 5 giây
        await pageHot2023.waitForTimeout(5000);

        pageHot2023.on("request", (request) => {
            if (request.url().includes("https://zingmp3.vn/api/v2/song/get/streaming?id=")) {
                // console.log(request.url());
                listLinkStream.push(request.url());
            }
        });

        // Khi bài hát tới bài hát cuối thì chúng ta sẽ quay ngược lên click vào bài hát đầu tiên để phát nhạc và lấy API
        if (song === songsHot2023[songsHot2023.length - 1]) {
            const playBtn = await songsHot2023[0].$(".zm-btn.action-play.button");
            await playBtn.click();

            // Thời lượng phát là 3 giây
            await pageHot2023.waitForTimeout(5000);

            pageHot2023.on("request", (request) => {
                if (request.url().includes("https://zingmp3.vn/api/v2/song/get/streaming?id=")) {
                    listLinkStream.push(request.url());
                }
            });

            await pageHot2023.close();
        }

        listSongHot2023.push({ id: hid, avatarSong: avatarSong, titleSong: titleSong, nameArtists: nameArtists });
        hid++;
    }

    // console.log(listSongHot2023);

    listLinkStream = [...new Set(listLinkStream)];
    var lastStream = listLinkStream.pop();

    listLinkStream.unshift(lastStream);

    // console.log(listLinkStream);

    // console.log(listLinkStream.length);

    const listAudioHot2023 = [];
    var hid = APIChillNew.length + APISadNew.length + APIRemixNew.length;
    for (var i = 0; i < listLinkStream.length; i++) {
        const pageAPI = await browser.newPage();
        // Chuyển sang trang có link stream
        await pageAPI.goto(listLinkStream[i]);

        // Thời lượng phát là 6 giây
        await pageAPI.waitForTimeout(6000);

        var API = await pageAPI.$eval("pre", function (element) {
            return element.innerText;
        });

        listAudioHot2023.push({ id: hid, linkAudio: JSON.parse(API)["data"] });
        hid++;

        // Đóng tab
        await pageAPI.close();
    }

    // console.log(listAudioHot2023);
    // console.log(listAudioHot2023.length);

    const APIHot2023 = listSongHot2023.map((elementSong) => {
        const matchingItem = listAudioHot2023.find((elementAudio) => elementAudio.id === elementSong.id);
        return matchingItem ? { ...elementSong, ...matchingItem } : elementSong;
    });

    // console.log(APIHot2023);

    // Lặp qua mảng để thay ảnh thành ảnh lớn và nét hơn
    const listAvatarLargeHot2023 = [];
    var hid = APIChillNew.length + APISadNew.length + APIRemixNew.length;
    for (var APIChild of APIHot2023) {
        const titleSong = APIChild["titleSong"];
        const nameArtists = APIChild["nameArtists"][0];

        const pageSearchHot2023 = await browser.newPage();

        // Đặt kích thước màn hình hiển thị (viewport)
        await pageSearchHot2023.setViewport({ width: 1105, height: 600 });
        // Truy cập trang web tìm kiếm
        await pageSearchHot2023.goto("https://zingmp3.vn/");

        // Chờ đợi thanh search load ra
        await pageSearchHot2023.waitForSelector(".form-control.z-input-placeholder");

        await pageSearchHot2023.type(".form-control.z-input-placeholder", titleSong + " " + nameArtists);

        // Nhấn phím Enter để thực hiện tìm kiếm
        await pageSearchHot2023.keyboard.press("Enter");

        await pageSearchHot2023.waitForSelector(
            ".zm-carousel-item.is-fullhd-4.is-widescreen-4.is-desktop-4.is-touch-4.is-tablet-4"
        );

        const avatarNew = await pageSearchHot2023.$$(
            ".zm-carousel-item.is-fullhd-4.is-widescreen-4.is-desktop-4.is-touch-4.is-tablet-4"
        );

        const avatarSong = await avatarNew[0].$eval(".song-thumb figure img", function (element) {
            return element.src;
        });

        listAvatarLargeHot2023.push({ id: hid, kindMusic: "Hot2023", avatarSongNew: avatarSong });
        hid++;

        // Sau khi lưu được hết bài hát thì đóng trang pageSearchHot2023
        await pageSearchHot2023.close();
    }

    // console.log(listAvatarLargeHot2023.length);
    // console.log(listAvatarLargeHot2023);

    // Lấy ra API có gộp cả ảnh lớn
    const APIHot2023New = APIHot2023.map((elementApiHot2023) => {
        const matchingItem = listAvatarLargeHot2023.find(
            (elementAvatarNew) => elementAvatarNew.id === elementApiHot2023.id
        );
        return matchingItem ? { ...elementApiHot2023, ...matchingItem } : elementApiHot2023;
    });

    // console.log(APIHot2023New);

    // Tải và lưu các file âm thanh
    // List âm thanh tải về
    const listMp3Hot2023 = [];
    var hid = APIChillNew.length + APISadNew.length + APIRemixNew.length;
    for (const elementHot2023New of APIHot2023New) {
        // Chuỗi ban đầu
        const originalString = elementHot2023New['titleSong'];

        // Bước 1: Chuẩn hóa chuỗi
        const trimmedString = originalString.split(' (')[0];

        const normalizedString = trimmedString.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

        // Bước 2: Thay thế khoảng trắng bằng gạch dưới
        const underscoredString = normalizedString.replace(/\s+/g, "_");

        // Bước 3: Thêm phần mở rộng file .mp3
        const finalString = underscoredString +".mp3";

        const filePath128 = path.join("../music/Nhac_hot2023/128",finalString);
        const filePath320 = path.join("../music/Nhac_hot2023/320",finalString);

        try {
            const response128 = await axios.get(elementHot2023New["linkAudio"]["128"], { responseType: "arraybuffer" });
            const response320 = await axios.get(elementHot2023New["linkAudio"]["320"], { responseType: "arraybuffer" });
            fs.writeFileSync(filePath128, Buffer.from(response128.data));
            fs.writeFileSync(filePath320, Buffer.from(response320.data));
            console.log(`Audio saved to ${filePath128}`);
            console.log(`Audio saved to ${filePath320}`);

            listMp3Hot2023.push({id: hid, mp3Link128: '../music/Nhac_hot2023/128/' + finalString, mp3Link320: '../music/Nhac_hot2023/320/' + finalString});
            hid++;
        } catch (error) {
            console.error(`Error downloading audio from ${elementHot2023New["linkAudio"]["128"]}: ${error.message}`);
            console.error(`Error downloading audio from ${elementHot2023New["linkAudio"]["320"]}: ${error.message}`);
        }
    }

    // console.log(listMp3Hot2023);

    // Lấy API có gộp cả link nhạc được tải về thư mục
    const APIHot2023NewMost = APIHot2023New.map((elementApiHot2023) => {
        const matchingItem = listMp3Hot2023.find(
            (elementMp3Hot2023) => elementMp3Hot2023.id === elementApiHot2023.id
        );
        return matchingItem ? { ...elementApiHot2023, ...matchingItem } : elementApiHot2023;
    });

    console.log(APIHot2023NewMost);

    var jsonAPIHot2023 = { APIHot2023NewMost };
    // Chuyển đối JSON thành chuỗi
    var jsonString = JSON.stringify(jsonAPIHot2023);

    // Ghi chuỗi JSON vào tệp
    fs.writeFileSync("APIHot2023.json", jsonString);

    /*-------------------------------------------------API Full----------------------------------------------------------------------*/
    var jsonAPIFull = { ...jsonAPIChill, ...jsonAPISad, ...jsonAPIRemix, ...jsonAPIHot2023 };

    // Chuyển đối JSON thành chuỗi
    var jsonString = JSON.stringify(jsonAPIFull);

    // Ghi chuỗi JSON vào tệp
    fs.writeFileSync("APIFull.json", jsonString);

    await browser.close();
})();
