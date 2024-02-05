<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moshaf</title>
    <!-- Normalize CSS File -->
    <link rel='stylesheet' href='css/normalize.css'>
    <!-- Fontawesome CSS Link -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css'>
    <!-- Custom CSS File -->
    <link rel='stylesheet' href='css/style.css'>
    <!-- Custom JS File -->
    <style>
        .header {
            background-color: #267cb5;
            padding: 10px;
            color: white;
            text-align: center;
        }

        .footer {
            background-color: #267cb5;
            padding: 10px;
            color: white;
            text-align: center;
        }

        hr {
            width: 80%;
            margin: 20px auto;
            border: 1px solid #267cb5;
            margin-top: 20px;
            margin-bottom: 20px;
            -webkit-appearance: none;
        }

        .toast-message {
            display: none;
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #267cb5;
            color: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 999;
        }

        .controlsetting {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            width: 100%;
            height: 35vh;
            padding: 10px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 999;
        }

        .headerr {
            background-color: #92924c;
            padding: 10px;
            color: white;
            text-align: center;
        }

        .close-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
            cursor: pointer;
        }

        .switch-container {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .switch-label {
            margin-right: 10px;
        }

        /* تحديد نمط الزر */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* تحديد نمط المقبض */
        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* تصميم المسار الخلفي */
        .toggle-switch .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 34px;
        }

        /* تصميم المقبض */
        .toggle-switch .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 50%;
        }

        /* تحديد المظهر عند تحديد الزر */
        .toggle-switch input:checked+.slider {
            background-color: #2196F3;
        }

        .toggle-switch input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        .toggle-icon {
            font-size: 24px;
            /* ��� �������� */
            cursor: pointer;
        }

        .toggled .fa-repeat:before {
            content: "\f01e";
            /* ��� ������ ����� ��� �� FontAwesome */
            /* ����� ����� ����� ��� �������� ���� ������ �� FontAwesome */
        }

        .custom-icon {
            font-size: 24px;
            /* Set the font size to 24px */
            color: #006400;
            /* Set the color to dark green */
            transition: all 0.5s ease-in-out;
        }

        .fa-book-reader {
            direction: rtl;
            /* transform: scaleX(-1); */
        }

        .cell {
            flex: 1;
            margin-right: 10px;
            position: relative;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td {
            padding: 10px;
            /* ����� ����� ������ */
            width: 50%;
        }

        /* ����� ������� ��� �������� */
        td+td {
            border-left: none;
            /* ����� ������ ��� �������� */
        }

        .span-container {
            display: flex;
            justify-content: flex-start;
            /* ����� ������� ��� ������ */
            align-items: center;
            position: relative;
            /* ����� ������� ������� */
        }

        .right-aligned-text {
            font-size: 28px
        }

        /* ����� ��� ���� */
        .fa-solid.fa-book {
            font-size: 28px;
            color: blue;
        }

        .span-container {
            display: flex;
            align-items: center;
        }

        .span-container span {
            margin-right: 10px;
            /* ���� ������� ���� ���� ���� */
        }
    </style>
</head>

<body>
    <?php
    include_once("db_connect.php");
    mysqli_set_charset($conn, "utf8");

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $sqlQuery = "SELECT  * FROM Quran WHERE pages=$page";
    $result = mysqli_query($conn, $sqlQuery);

    $sqlQueryOfsora = "SELECT  * FROM Quran WHERE pages=$page ORDER BY sora , juz LIMIT 1";
    $resultOfSora = mysqli_query($conn, $sqlQueryOfsora);

    function getLanguage($table, $page, $conn)
    {
        $langQuery = "SELECT * FROM $table";
        return mysqli_query($conn, $langQuery);
    }

    if (isset($_COOKIE['language'])) {
        $lang = getLanguage($_COOKIE['language'], $page, $conn);
    }
    ?>
    <!-- Start Preloader -->
    <?php
    if (!isset($_COOKIE["language"])) {

        echo "<div id='preloader' class='preloader'></div>";
    }
    ?>

    <!-- start languages-filter -->
    <div id="languages-filter" class="languages-filter">
        <div id="close-lang" class="close"><i class="fa-solid fa-xmark"></i></div>
        <div class="flags">
            <?php
            $languages_length = 13;
            $languages = ["lende", "lenen", "lenes", "lenfr", "lenin", "lenit", "lentr", "lenru", "lenur", "lenur", "lenur", "lenbn", "lenzh", "lenja"];
            for ($language = 0; $language <= $languages_length; $language++) {
                echo "  <button class='language' name='language' type='submit' value='{$languages[$language]}'>
                                <img src='images/Flag/{$language}.png'>
                            </button>";
            }
            ?>
        </div>
        <div class="help">
            <button>
                <img src="images/icons/Help_icon-icons.com_73700.png" alt="Help">
            </button>
        </div>
    </div>
    <div class="header"></div>
    <!-- Start Main Content  -->
    <section class="main">
        <div id="moshaf-pages" class="moshaf-pages">
            <!-- Start Filter Bar Buttons for Part and Sura -->
            <div class="filter">
                <div id="hezb" class="hezb">
                    <!-- #region -->
                    <?php
                    foreach ($resultOfSora as $soraName) {
                        echo $soraName['juz'];
                    }
                    ?>
                </div>
                <div id="suar" class="suar">
                    <?php
                    $curruntSora = [];
                    if (isset($_COOKIE["language"])) {

                        foreach ($lang as $soraName) {
                            if ($soraName["pages"] <= $page) {

                                array_push($curruntSora, $soraName['indd']);
                                if (count($curruntSora) > 1) {
                                    array_shift($curruntSora);
                                }
                            }
                        }
                        echo $curruntSora[0];
                    } else {
                        foreach ($resultOfSora as $soraName) {
                            echo $soraName['sora'];
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- End Filter Bar -->

            <!-- Loading suar svg -->
            <?php
            if (!isset($_GET['page'])) {
                $_GET['page'] = 1;
                readfile("images/{$_GET['page']}.svg");
            } else {
                readfile("images/{$_GET['page']}.svg");
            }
            ?>
            <!-- Page Number -->
            <div id="page-num" class="page-num">
                <?php echo $page ?>
            </div>
        </div>
        <!-- Start Control Section of Buttons and Audio -->
        <section class="control">
            <a id="prev" class="page-link" href="?page=<?php
            if (isset($_GET['page']) && $_GET['page'] > 1) {
                echo $_GET['page'] - 1;
            } else {
                echo $_GET['page'] = 1;
            }
            ?>">
                <i class="fa-solid fa-circle-chevron-right"></i>
            </a>

            <audio id="audio" controls autoplay>
                <source src="" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>

            <a id="next" class="page-link" href="?page=<?php echo $_GET['page'] + 1 ?>">
                <i class="fa-solid fa-circle-chevron-left"></i>
            </a>
        </section>

        <div id="settings" class="setting">


            <button id="showLanguage">
                <img src="images/icons/1891027_circle_global_globe_international_language_icon.png" alt="Settings">
            </button>
            <button id="showsettings" onclick="showControl()">
                <img src="images/icons/iconfinder-settings-4341324_120534.png" alt="Settings">
            </button>
            <button>
                <img src="images/icons/Help_icon-icons.com_73700.png" alt="Help">
            </button>
        </div>


        <div class="controlsetting" id="controlSetting">
            <!-- ������� <i> ����� �� <span> -->
            <i class="fas fa-times close-icon" onclick="hideControl()"></i>
            <div class="headerr"></div>
            <br>
            <div id="window">
                <table>
                    <tr>
                        <td>
                            <i class="fas fa-book-reader custom-icon" id="custom_icon"></i>
                            <div class="book-icons">
                                <img src="images/icons/book reader.png" width="50px" id="opened-reader"
                                    alt="book reader">
                                <img src="images/icons/closed book reader.png" id="closed-reader" width="20px"
                                    alt="closed book reader">
                            </div>
                            <select id="readerSelect" onchange="handleReaderSelection()">
                                <option value="reader1">Reader 1</option>
                                <option value="reader2">Reader 2</option>
                                <option value="reader3">Reader 3</option>
                            </select>
                        </td>
                        <td>
                            <div class="span-container right-aligned-text">
                                <div class="span-container">
                                    <input type="checkbox" id="toggleSwitch" onchange="handleCheckboxChange()">
                                    <span>
                                        <i class="fa-solid fa-book" id="bookIcon"></i>
                                        <i class="fa-solid fa-book-open" id="openBook"></i>
                                    </span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="switch-container">
                    <label class="toggle-switch">
                        <input type="checkbox" id="toggle_Switch">
                        <div class="slider"></div>
                    </label>
                    <label class="switch-label" for="toggle_Switch">
                        <i id="toggleIcon" class="fa fa-repeat toggle-icon"></i>
                    </label>
                </div>
            </div>
        </div>
        <!-- End Control Section -->
    </section>
    <!-- End Main Content  -->

    <!-- Start Sura Filter -->
    <div class="suar-filter">
        <div id="close-sura" class="close"><i class="fa-solid fa-xmark"></i></div>
        <div class="sura-name">الفاتحة</div>
        <div class="sura-name">البقرة</div>
        <div class="sura-name">آل عمران</div>
        <div class="sura-name">المائدة</div>
        <div class="sura-name">الأنعام</div>
        <div class="sura-name">الأعراف</div>
        <div class="sura-name">الأنفال</div>
        <div class="sura-name">التوبة</div>
        <div class="sura-name">يونس</div>
        <div class="sura-name">هود</div>
        <div class="sura-name">يوسف</div>
        <div class="sura-name">الرعد</div>
        <div class="sura-name">إبراهيم</div>
        <div class="sura-name">الحجر</div>
        <div class="sura-name">النحل</div>
        <div class="sura-name">الإسراء</div>
        <div class="sura-name">الكهف</div>
        <div class="sura-name">مريم</div>
        <div class="sura-name">طه</div>
        <div class="sura-name">الأنبياء</div>
        <div class="sura-name">الحج</div>
        <div class="sura-name">المؤمنون</div>
        <div class="sura-name">النور</div>
        <div class="sura-name">الفرقان</div>
        <div class="sura-name">الشعراء</div>
        <div class="sura-name">النمل</div>
        <div class="sura-name">القصص</div>
        <div class="sura-name">العنكبوت</div>
        <div class="sura-name">الروم</div>
        <div class="sura-name">لقمان</div>
        <div class="sura-name">السجدة</div>
        <div class="sura-name">الأحزاب</div>
        <div class="sura-name">سبأ</div>
        <div class="sura-name">فاطر</div>
        <div class="sura-name">يس</div>
        <div class="sura-name">الصافات</div>
        <div class="sura-name">ص</div>
        <div class="sura-name">الزمر</div>
        <div class="sura-name">غافر</div>
        <div class="sura-name">فصلت</div>
        <div class="sura-name">الشوري</div>
        <div class="sura-name">الزخرف</div>
        <div class="sura-name">الدخان</div>
        <div class="sura-name">الجاثية</div>
        <div class="sura-name">الأحقاف</div>
        <div class="sura-name">محمد</div>
        <div class="sura-name">الفتح</div>
        <div class="sura-name">الحجرات</div>
        <div class="sura-name">ق</div>
        <div class="sura-name">الذاريات</div>
        <div class="sura-name">الطور</div>
        <div class="sura-name">النجم</div>
        <div class="sura-name">القمر</div>
        <div class="sura-name">الرحمن</div>
        <div class="sura-name">الواقعة</div>
        <div class="sura-name">الحديد</div>
        <div class="sura-name">المجادلة</div>
        <div class="sura-name">الحشر</div>
        <div class="sura-name">الممتحنة</div>
        <div class="sura-name">الصف</div>
        <div class="sura-name">الجمعة</div>
        <div class="sura-name">المنافقون</div>
        <div class="sura-name">التغابن</div>
        <div class="sura-name">الطلاق</div>
        <div class="sura-name">التحريم</div>
        <div class="sura-name">الملك</div>
        <div class="sura-name">القلم</div>
        <div class="sura-name">الحاقة</div>
        <div class="sura-name">المعارج</div>
        <div class="sura-name">نوح</div>
        <div class="sura-name">الجن</div>
        <div class="sura-name">المزمل</div>
        <div class="sura-name">المدثر</div>
        <div class="sura-name">القيامة</div>
        <div class="sura-name">الإنسان</div>
        <div class="sura-name">المرسلات</div>
        <div class="sura-name">النبأ</div>
        <div class="sura-name">النازعات</div>
        <div class="sura-name">عبس</div>
        <div class="sura-name">التكوير</div>
        <div class="sura-name">الإنفطار</div>
        <div class="sura-name">المطففين</div>
        <div class="sura-name">الانشقاق</div>
        <div class="sura-name">البروج</div>
        <div class="sura-name">الطارق</div>
        <div class="sura-name">الأعلى</div>
        <div class="sura-name">الغاشية</div>
        <div class="sura-name">الفجر</div>
        <div class="sura-name">البلد</div>
        <div class="sura-name">الشمس</div>
        <div class="sura-name">الليل</div>
        <div class="sura-name">الضحى</div>
        <div class="sura-name">الشرح</div>
        <div class="sura-name">التين</div>
        <div class="sura-name">العلق</div>
        <div class="sura-name">القدر</div>
        <div class="sura-name">البينة</div>
        <div class="sura-name">الزلزلة</div>
        <div class="sura-name">العاديات</div>
        <div class="sura-name">القارعة</div>
        <div class="sura-name">التكاثر</div>
        <div class="sura-name">العصر</div>
        <div class="sura-name">الهمزة</div>
        <div class="sura-name">الفيل</div>
        <div class="sura-name">قريش</div>
        <div class="sura-name">الماعون</div>
        <div class="sura-name">الكوثر</div>
        <div class="sura-name">الكافرون</div>
        <div class="sura-name">النصر</div>
        <div class="sura-name">المسد</div>
        <div class="sura-name">الإخلاص</div>
        <div class="sura-name">الفلق</div>
        <div class="sura-name">الناس</div>
    </div>
    <!-- End Sura Filter -->

    <!-- Start part Filter -->
    <div class="hezb-filter">
        <div id="close-hezb" class="close"><i class="fa-solid fa-xmark"></i></div>
        <div class="hezb-name">الجزء الأول</div>
        <div class="hezb-name">الجزء الثاني</div>
        <div class="hezb-name">الجزء الثالث</div>
        <div class="hezb-name">الجزء الرابع</div>
        <div class="hezb-name">الجزء الخامس</div>
        <div class="hezb-name">الجزء السادس</div>
        <div class="hezb-name">الجزء السابع</div>
        <div class="hezb-name">الجزء الثامن</div>
        <div class="hezb-name">الجزء التاسع</div>
        <div class="hezb-name">الجزء العاشر</div>
        <div class="hezb-name">الجزء الحادي عشر</div>
        <div class="hezb-name">الجزء الثاني عشر</div>
        <div class="hezb-name">الجزء الثالث عشر</div>
        <div class="hezb-name">الجزء الرابع عشر</div>
        <div class="hezb-name">الجزء الخامس عشر</div>
        <div class="hezb-name">الجزء السادس عشر</div>
        <div class="hezb-name">الجزء السابع عشر</div>
        <div class="hezb-name">الجزء الثامن عشر</div>
        <div class="hezb-name">الجزء التاسع عشر</div>
        <div class="hezb-name">الجزء العشرون</div>
        <div class="hezb-name">الجزء الحادي والعشرون</div>
        <div class="hezb-name">الجزء الثاني والعشرون</div>
        <div class="hezb-name">الجزء الثالت والعشرون</div>
        <div class="hezb-name">الجزء الرابع والعشرون</div>
        <div class="hezb-name">الجزء الخامس والعشرون</div>
        <div class="hezb-name">الجزء السادس والعشرون</div>
        <div class="hezb-name">الجزء السابع والعشرون</div>
        <div class="hezb-name">الجزء الثامن والعشرون</div>
        <div class="hezb-name">الجزء التاسع والعشرون</div>
        <div class="hezb-name">الجزء الثلاثون</div>
    </div>
    <!-- End Sura Filter -->

    <!-- Start Page Filter -->
    <div class="page-filter">
        <div id="close-page" class="close"><i class="fa-solid fa-xmark"></i></div>
        <?php
        for ($i = 1; $i < 605; $i++) {
            echo "<div class='page-num'>{$i}</div>";
        }
        ?>
    </div>
    <!-- End Page Filter -->

    <div class="footer">
        <p>
        <h2></h2>
        </p>
    </div>
    <script>
        function showControl() {
            var control = document.getElementById('controlSetting');

            // Transition when open the window
            let window = document.getElementById("window");
            window.classList.add("slide-left-animation");

            control.style.display = 'block';
        }

        function hideControl() {
            var control = document.getElementById('controlSetting');
            control.style.display = 'none';
        }
    </script>
    <script>
        function handleReaderSelection() {
            var readerSelect = document.getElementById('readerSelect');
            var selectedIndex = readerSelect.selectedIndex;

            // reader icons (Green book)
            let opened_reader = document.getElementById("opened-reader");
            let closed_reader = document.getElementById("closed-reader");
            let custom_icon = document.getElementById("custom_icon");
            // animaion of the green book
            opened_reader.classList.add("opened-reader");
            closed_reader.classList.add("closed-reader");

            // Rotated green book icon
            custom_icon.classList.add("book-rotate");

            setTimeout(function () {
                opened_reader.classList.remove("opened-reader");
                closed_reader.classList.remove("closed-reader");

                custom_icon.classList.remove("book-rotate");

            }, 1000);
            // ����� ���� ������ ������ �� sessionStorage
            sessionStorage.setItem('selectedReaderIndex', selectedIndex);

            var audioElement = document.getElementById('audio');

            // ���� ��� ���� ����� ������ ������
            var currentAudioSrc = audioElement.src;

            if (currentAudioSrc) {
                var audioFileName = currentAudioSrc.substring(currentAudioSrc.lastIndexOf('/') + 1);
                var lastSlashIndex = currentAudioSrc.lastIndexOf('/');
                var folderPath = currentAudioSrc.substring(0, lastSlashIndex);
                var lastSlashIndexx = folderPath.lastIndexOf('/');
                var lastValueBeforeSlash = folderPath.substring(lastSlashIndexx + 1);

                console.log(lastValueBeforeSlash);

                loadNewAudio(`audio/${selectedIndex}/${lastValueBeforeSlash}/${audioFileName}`);

                return audioFileName;
            } else {

                return "";
            }
        }

        function loadNewAudio(audioPath) {
            var audioElement = document.getElementById('audio');

            if (!audioElement.paused) {
                audioElement.pause();
            }

            audioElement.src = audioPath;

            audioElement.load();

            // ��� ����� ����� ��� ���� ����� autoplay �����
            audioElement.play();
        }
    </script>
    <script>
        // repeat ayah icon
        let toggleIcon = document.getElementById("toggleIcon")
        document.getElementById('toggle_Switch').addEventListener('change', function () {
            // Animate on change
            toggleIcon.classList.toggle("toggle-icon-animation");

            if (this.checked) {
                audio.loop = true;
                audio.play();
            } else {
                audio.loop = false;
                audio.play();
            }
        });
    </script>
    <script>
        // ����� ����� ������� �� ����� ���� �������
        function handleCheckboxChange() {
            // Animation of blue book
            let bookIcon = document.getElementById("bookIcon");
            let openBook = document.getElementById("openBook");
            bookIcon.classList.toggle("book-icon-animation");
            openBook.classList.toggle("closed-book-icon-animation");
        }
    </script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/lang.js"></script>
</body>

</html>