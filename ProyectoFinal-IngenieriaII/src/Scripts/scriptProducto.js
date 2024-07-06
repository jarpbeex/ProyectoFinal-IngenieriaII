// Elementos relevantes
const dropzoneArea = document.getElementById("dropzone-area");
const inputElement = document.getElementById("upload-file");
const imageUrlInput = document.getElementById("image-url");

// Función para manejar la selección de archivos
function handleFileSelect(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        dropzoneArea.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
        imageUrlInput.value = e.target.result; // Actualizar el campo oculto
    };

    if (file) {
        reader.readAsDataURL(file);
    }
}

// Añadir el evento al campo de archivo
inputElement.addEventListener("change", handleFileSelect);

// Manejar el evento de arrastre
dropzoneArea.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropzoneArea.classList.add("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropzoneArea.addEventListener(type, (e) => {
        dropzoneArea.classList.remove("dropzone--over");
    });
});

dropzoneArea.addEventListener("drop", (e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement.files = e.dataTransfer.files; // Asignar los archivos arrastrados
        const file = e.dataTransfer.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            dropzoneArea.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    dropzoneArea.classList.remove("dropzone--over");
});

