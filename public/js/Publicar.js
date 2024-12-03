// Habilitar/deshabilitar el botón de publicar dependiendo de si se ha marcado la casilla
document.getElementById('accept-checkbox').addEventListener('change', function() {
    const submitButton = document.getElementById('submit-button');
    submitButton.disabled = !this.checked;
});

// Mostrar el modal de términos y condiciones
document.getElementById('terms-link').addEventListener('click', function() {
    document.getElementById('terms-modal').style.display = 'block';
});

// Cerrar el modal
function closeTermsModal() {
    document.getElementById('terms-modal').style.display = 'none';
}
