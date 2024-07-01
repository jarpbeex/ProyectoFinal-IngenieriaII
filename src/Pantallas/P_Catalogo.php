<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Estilos/stylesCatalogo.css">
    <title>Gestión de Catálogo</title>
</head>
<body>
    <main>
        <h1>Gestión de Mugumis</h1>
        <form id="productForm">
            <input type="hidden" id="index" value="-1">
            <input type="text" id="name" placeholder="Nombre del Mugumi" required>
            <input type="text" id="description" placeholder="Descripción" required>
            <input type="text" id="imageUrl" placeholder="URL de la imagen" required>
            <input type="text" id="price" placeholder="Precio" required>
            <button type="submit" id="submitBtn">Añadir Producto</button>
        </form>
        <section id="A_section">
            <!-- Aquí se mostrarán los productos añadidos -->
        </section>
    </main>

    <script>
        // Función para cargar los productos desde localStorage y mostrarlos
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
    </script>
</body>
</html>
