
window.addEventListener("load", function () {
    let audioName = document.getElementById('audio');
    let ayah = document.querySelectorAll(".ayahPolygon");
    let surah = ayah[0].getAttribute("surah")
    let currentHighlightedAyah;

 

    for (let index = 0; index < ayah.length; index++) {
        // Click at ayah to play audio

        ayah[index].addEventListener("click", function () {
                

            let audioId = this.getAttribute("ayah");

            let audioNum = `${(audioId).toString().padStart(2, '0').padStart(3, '0')}`;

            audioName.src = `audio/${surah}/${audioNum}.mp3`;

            if (currentHighlightedAyah) {
                currentHighlightedAyah.setAttribute("fill-opacity", 0);
            } else if (index <= ayah[index]) {
                ayah[index].setAttribute("fill-opacity", 0);
            }


            if (ayah[index] === null || ayah[index] === "undefined") {
                audioName.pause();
            }
            //   set color for element 
            ayah[index].setAttribute("fill", "#fbff00");

            // set fill-opacity for element

            ayah[index].setAttribute("fill-opacity", 0.05);
            currentHighlightedAyah = ayah[index];

            audioName.load();
            audioName.play();


            audioName.addEventListener("canplaythrough", function () {
                audioName.play();
            });

            // Play next audio of ayah
            audioName.addEventListener('ended', function () {
                audioIsPlayed = true;

                let prevAyah = index;
                audioId++;
                index++;

                //if the Last Ayah id ended please pause 
                if (index === ayah.length) {
                    audioName.pause();
                    return;
                } else {
                    audioName.pause();
                }

                // if the current ayah highlight 

                if (currentHighlightedAyah) {
                    currentHighlightedAyah.setAttribute("fill-opacity", 0);
                } else if (index <= ayah[index]) {
                    ayah[index].setAttribute("fill-opacity", 0);
                }

                if (ayah[index] === null || ayah[index] === "undefined") {
                    audioName.pause();
                }

                //   set color for element 

                ayah[index].setAttribute("fill", "#fbff00");

                // set fill-opacity for element

                ayah[index].setAttribute("fill-opacity", 0.05);
                currentHighlightedAyah = ayah[index]

                // Play audio

                audioNum = `${(audioId).toString().padStart(2, '0').padStart(3, '0')}`;

                audioName.src = `audio/${surah}/${audioNum}.mp3`

                audioName.load();


                audioName.addEventListener("canplaythrough", function () {
                    audioName.play();
                });

                ayah[prevAyah].setAttribute("fill-opacity", 0);
            });
        });
    }

    // Start Control of Filters
    let hezb = document.getElementById("hezb");
    let suar = document.getElementById("suar");
    let showSettings = document.getElementById("showSettings");
    let page_num = document.getElementById("page-num");
    let suar_filter = document.querySelector(".suar-filter");
    let hezb_filter = document.querySelector(".hezb-filter");
    let page_filter = document.querySelector(".page-filter");
    let settings_window = document.getElementById("settings-window");
    let close = document.querySelectorAll(".close")
    let showLanguageBtn = document.getElementById("showLanguage");
    let langFilter = document.getElementById("languages-filter");


    close.forEach(function (btn) {
        btn.addEventListener("click", function (e) {
            e.currentTarget.parentElement.style.display = "none";
        });
    });

    suar.addEventListener("click", function () {
        suar_filter.style.display = "flex"
    });

    hezb.addEventListener("click", function () {
        hezb_filter.style.display = "flex"
    });
    page_num.addEventListener("click", function () {
        page_filter.style.display = "flex"
    });

    showLanguageBtn.addEventListener("click", function () {

        langFilter.style.display = "flex"

    });
    showSettings.addEventListener("click", function () {
        settings_window.style.display = "flex"
    });
    // End Control of Filters



});
