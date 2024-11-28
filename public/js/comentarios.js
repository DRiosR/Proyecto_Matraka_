// Función para mostrar y ocultar los comentarios de cada publicacion
function toggleComentarios(publicacionId) {
    const contenedorComentarios = document.getElementById("comentariosContenedor_" + publicacionId);
    const btnMostrarComentarios = document.getElementById("mostrarComentariosBtn_" + publicacionId);

    if (contenedorComentarios.style.display === "none") {
        // Mostrar comentarios
        contenedorComentarios.style.display = "block";
        btnMostrarComentarios.textContent = "No mostrar comentarios";
    } else {
        // Ocultar comentarios
        contenedorComentarios.style.display = "none";
        btnMostrarComentarios.textContent = "Mostrar comentarios";
    }
}

// Función para mostrar más comentarios (cuando hay mas de 3)
function mostrarMasComentarios(publicacionId) {
    const contenedorComentariosAdicionales = document.getElementById("comentariosAdicionales_" + publicacionId);
    const verMasBtn = document.getElementById("verMasBtn_" + publicacionId);
    const mostrarMenosBtn = document.getElementById("mostrarMenosBtn_" + publicacionId);

    // Mostrar todos los comentarios adicionales
    contenedorComentariosAdicionales.style.display = "block";

    // Mostrar el botón "Mostrar menos comentarios"
    mostrarMenosBtn.style.display = 'inline';

    // Ocultar el botón "Mostrar más comentarios"
    verMasBtn.style.display = 'none';
}

// Función para mostrar menos comentarios
function mostrarMenosComentarios(publicacionId) {
    const contenedorComentariosAdicionales = document.getElementById("comentariosAdicionales_" + publicacionId);
    const mostrarMenosBtn = document.getElementById("mostrarMenosBtn_" + publicacionId);
    const verMasBtn = document.getElementById("verMasBtn_" + publicacionId);

    // Ocultar los comentarios adicionales
    contenedorComentariosAdicionales.style.display = "none";

    // Ocultar el botón "Mostrar menos comentarios"
    mostrarMenosBtn.style.display = 'none';

    // Mostrar el botón "Mostrar más comentarios"
    verMasBtn.style.display = 'inline';
}
