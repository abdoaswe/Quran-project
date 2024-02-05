
    let buttons = document.querySelectorAll(".language");
    let langFilter = document.getElementById("languages-filter");
    let cookies = document.cookie;
    let name = "language";

    buttons.forEach(button => {
        button.addEventListener("click", () => {
            let value = button.value;

            document.cookie = `${name}=${value}; expires=` + new Date(Date.now() + 365 * 24 * 60 * 60 * 1000).toUTCString();
            // reload page after take value of cookies
            location.reload();
        });
        // get value of cookies
    });

    // if cookies take a value return True
    if (cookies) {
        langFilter.style.display = "none";
    } else {
        langFilter.style.display = "flex";
    }


    //expires cookies condition 
    setInterval(() => {
        // expires cookies
        if (cookies && new Date(cookies.substring(cookies.indexOf("=") + 1)) < new Date()) {
            document.getElementById("preloader").style.display = "block";
            langFilter.style.display = "flex";
        }
    }, 1000);



    