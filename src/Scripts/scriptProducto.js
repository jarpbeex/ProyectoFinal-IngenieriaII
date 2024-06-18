const dropzoneArea = document.getElementById("dropzone-area");
const inputElement = document.getElementById("upload-file");
const imageUrlInput = document.getElementById("image-url");

inputElement.addEventListener("change", (event) => {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        dropzoneArea.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
        // Actualizar el valor del campo de entrada oculto con la URL de la imagen
        imageUrlInput.value = e.target.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    }
});

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
        inputElement.files = e.dataTransfer.files;
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

const dropzoneBox = document.getElementsByClassName("dropzone-box")[0];
dropzoneBox.addEventListener("reset", (e) => {
    dropzoneArea.innerHTML = `
        <div class="file-upload-icon">
            <!-- svg icon -->
        </div>
        <p>Imagen del producto</p>
        <input type="file" required id="upload-file" name="uploaded-file" accept=".png, .jpeg, .gif">
        <p class="message">+</p>
    `;
    document.getElementById("upload-file").addEventListener("change", handleFileSelect);
});

function handleFileSelect(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        dropzoneArea.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
    };

    if (file) {
        reader.readAsDataURL(file);
    }
}

document.getElementById("upload-file").addEventListener("change", handleFileSelect);


document.getElementById('submit-button').addEventListener('click', function() {
    $.ajax({
        type: "POST",
        url: "../Server/Producto.php",
        data: $("#dropzone-box").serialize(),
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert("Cambios guardados correctamente.");
            } else {
                console.log("Respuesta inesperada del servidor:", response);
                alert("Ocurrio un problema.");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
            alert("Error al conectar con el servidor. Intente de nuevo más tarde.");
        }
    });
});