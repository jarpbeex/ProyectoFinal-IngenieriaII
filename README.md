# ProyectoFinal-IngenieriaII

Pasos para instalar el entorno docker:  
- Instalar docker desktop:
    https://www.docker.com/products/docker-desktop/

- Una vez instalado, abrimos una terminal en la ubicacion de nuestro proyecto e introducimos el siguiente comando:
- `docker compose up -d`. Este comando instalara todos los contenedores para tener nuestro entorno lamp (linux, apache, mysql y php).
- `docker compose down` Este comando detiene nuestros contenedores (Para cuando ya terminemos de desarrollar).

¿Como ingresar a phpmyadmin y a nuestro proyecto?
- phpmyadmin: http://localhost:8080
- Abrir nuestra pagina php: http://localhost:9000/

Iniciar sesión en phpmyadmin:
- servidor: mysql_db (ya no se necesita el servidor solo usuario y contraseña)
- usuario: root
- contraseña: root
