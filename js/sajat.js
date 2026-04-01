let targetURL = "https://autoberlo24.hu/php/ajax/keresfogad.php";

function kepfeltolt() {
    const fileInput = document.getElementById('kep');
    const imgPreview = document.getElementById('kepmegjelenito');
    const file = fileInput.files[0];

    if(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imgPreview.src = e.target.result; // előnézet megjelenítése
        }
        reader.readAsDataURL(file);
    }
}

document.addEventListener("DOMContentLoaded", function() {

    // --- 1. Kártya Csoport Animáció (Javítva: Hibatűrés hozzáadva) ---
    const csoportok = document.querySelectorAll(".doboz-csoport");
    
    // Csak akkor fut le, ha vannak ilyen elemek az oldalon
    if (csoportok.length > 0) {
        let index = 0;

        setInterval(function() {
            const aktualis = csoportok[index];

            if (aktualis) {
                // kifelé animáció
                aktualis.classList.add("kartya-ki");

                setTimeout(function() {
                    aktualis.classList.remove("active", "kartya-ki");

                    // következő index kiszámítása
                    index++;
                    if (index >= csoportok.length) {
                        index = 0;
                    }

                    const kovetkezo = csoportok[index];

                    if (kovetkezo) {
                        // új csoport aktiválása
                        kovetkezo.classList.add("active", "kartya-be");

                        setTimeout(function() {
                            kovetkezo.classList.remove("kartya-be");
                        }, 800);
                    }

                }, 800);
            }
        }, 6000);
    }
    /// --- 2. Javított Hamburger menü kezelése ---
        const hamburger = document.getElementById("hamburger");
        const navMenu = document.getElementById("nav-menu");
        const navLinks = document.querySelectorAll(".nav-link"); // Minden link a menüben

        if (hamburger && navMenu) {
            // Nyitás és zárás a gombra kattintva
            hamburger.addEventListener("click", () => {
                hamburger.classList.toggle("active");
                navMenu.classList.toggle("active");
            });

            // Automatikus bezárás, ha rákattintasz egy menüpontra
            navLinks.forEach(link => {
                link.addEventListener("click", () => {
                    hamburger.classList.remove("active");
                    navMenu.classList.remove("active");
                    // Itt nem blokkoljuk az alapértelmezett ugrást, 
                    // így a böngésző elvisz a #rolunk vagy #kapcsolat részhez.
                });
            });
        }
    });

function velemenyMegjelenit() {

    let doboz = document.getElementById("velemenyDoboz");

    if (doboz.style.display === "none" || doboz.style.display === "") {
        doboz.style.display = "block";
    } else {
        doboz.style.display = "none";
    }

}
function next(el) {
    if (el.value.length == el.maxLength) {
        let next = el.nextElementSibling;
        if (next) {
            next.focus();
        }
    }
}