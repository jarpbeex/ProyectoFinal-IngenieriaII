# ProyectoFinal-IngenieriaII

Pasos para instalar el entorno docker:  
- Instalar docker desktop:
    https://www.docker.com/products/docker-desktop/

- Una vez instalado, abrimos una terminal en la ubicacion de nuestro proyecto e introducimos el siguiente comando:
- `docker compose up -d`. Este comando instalara todos los contenedores para tener nuestro entorno lamp (linux, apache, mysql y php).
- `docker compose down` Este comando detiene nuestros contenedores (Para cuando ya terminemos de desarrollar).

¿Como ingresar a phpmyadmin y a nuestro proyecto?
- phpmyadmin: http://localhost:8080
- Abrir nuestra pagina php: http://localhost:9090/
- le seguririan los archivos, ejemplo: http://localhost:9090/src/Pantallas/index.html

Iniciar sesión en phpmyadmin:
- servidor: baseDatos
- usuario: root
- contraseña: root


Pantallas
- Usuario
    - http://localhost:9090/src/Pantallas/p_Inicio.html
    - http://localhost:9090/src/Pantallas/p_Catalogo.php
    - http://localhost:9090/src/Pantallas/P_Registro_Pedido.html
- Administrador
    - http://localhost:9090/src/Pantallas/Vista_Administrador/p_Login.html
    - http://localhost:9090/src/Pantallas/Vista_Administrador/p_GestionCatalogo.php
    - http://localhost:9090/src/Pantallas/Vista_Administrador/p_Product.html
    - http://localhost:9090/src/Pantallas/Vista_Administrador/p_pedidos.php

Estado de los pedidos: PENDIENTE, PAGADO, ENTREGADO.