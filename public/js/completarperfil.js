// Elementos del DOM
const submitButton = document.getElementById('submit-button');
const acceptCheckbox = document.getElementById('accept-checkbox');
const fileInput = document.getElementById('imagen');
const fileLabel = document.querySelector('.custom-file-label');
const previewImage = document.getElementById('preview-image');

// Actualizar la vista previa de la imagen
fileInput.addEventListener('change', function () {
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block'; // Mostrar la imagen
        };
        reader.readAsDataURL(fileInput.files[0]); // Leer archivo como Data URL
    } else {
        previewImage.style.display = 'none'; // Ocultar la vista previa
    }
    toggleSubmitButton();
});

// Mostrar el nombre del archivo seleccionado
fileInput.addEventListener('change', function () {
    if (fileInput.files.length > 0) {
        fileLabel.textContent = fileInput.files[0].name;
    } else {
        fileLabel.textContent = "Seleccionar una foto";
    }
});

// Habilitar botón solo si se selecciona una foto y se marca el checkbox
function toggleSubmitButton() {
    submitButton.disabled = !(acceptCheckbox.checked && fileInput.files.length > 0);
}

// Detectar cambios en el checkbox
acceptCheckbox.addEventListener('change', toggleSubmitButton);

