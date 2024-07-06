
//estos codigos con suplementario de solo vistas, este codigo es inservible y solo se usa de referencia para guia de futuro codigo

function loadProducts() {
    const section = document.getElementById('A_section');
    section.innerHTML = ''; // Limpiar el contenido anterior
    const products = JSON.parse(localStorage.getItem('products')) || [];
    products.forEach((product, index) => {
        const article = document.createElement('article');
        article.innerHTML = `
            <img src="${product.imageUrl}" alt="${product.name}">
            <h2>${product.name}</h2>
            <p>${product.description}</p>
            <button>${product.price}</button>
            <button onclick="deleteProduct(${index})">Eliminar</button>
            <button onclick="editProduct(${index})">Editar</button>
        `;
        section.appendChild(article);
    });
}

// Función para manejar el envío del formulario
document.getElementById('productForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const index = document.getElementById('index').value;
    const name = document.getElementById('name').value;
    const description = document.getElementById('description').value;
    const imageUrl = document.getElementById('imageUrl').value;
    const price = document.getElementById('price').value;
    const products = JSON.parse(localStorage.getItem('products')) || [];

    if (index === "-1") {
        // Añadir nuevo producto
        products.push({ name, description, imageUrl, price });
    } else {
        // Editar producto existente
        products[index] = { name, description, imageUrl, price };
    }
    localStorage.setItem('products', JSON.stringify(products));
    loadProducts();
    this.reset(); // Limpiar el formulario
    document.getElementById('index').value = -1; // Resetear el índice
    document.getElementById('submitBtn').textContent = 'Añadir Producto'; // Cambiar el texto del botón
});

// Función para eliminar un producto
function deleteProduct(index) {
    const products = JSON.parse(localStorage.getItem('products')) || [];
    products.splice(index, 1);
    localStorage.setItem('products', JSON.stringify(products));
    loadProducts(); // Recargar los productos
}

// Función para editar un producto
function editProduct(index) {
    const products = JSON.parse(localStorage.getItem('products')) || [];
    const product = products[index];
    document.getElementById('index').value = index;
    document.getElementById('name').value = product.name;
    document.getElementById('description').value = product.description;
    document.getElementById('imageUrl').value = product.imageUrl;
    document.getElementById('price').value = product.price;
    document.getElementById('submitBtn').textContent = 'Guardar Cambios'; // Cambiar el texto del botón
}

// Cargar los productos al inicio
loadProducts();

document.getElementById('upload-file').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        const dropzoneArea = document.getElementById('dropzone-area');
        dropzoneArea.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width: 100%; height: auto;">`;
    };

    if (file) {
        reader.readAsDataURL(file);
    }
});