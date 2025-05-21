document.getElementById("imageInput").addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById("preview");
            preview.src = e.target.result;
            preview.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
});

function uploadImage() {
    const fileInput = document.getElementById("imageInput");
    if (fileInput.files.length > 0) {
        alert("Imagen subida exitosamente (falta conectar con el backend).");
    } else {
        alert("Por favor selecciona una imagen primero.");
    }
}