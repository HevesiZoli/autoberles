let targetURL = "http://127.0.0.1/backend/autoberles/php/ajax/keresfogad.php";

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