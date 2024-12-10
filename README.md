# API-REST-PHP
Se a generado una APi Rest en Symfony para la gestión de una biblioteca con los siguientes recursos:

Libros:
- GET /libros: Devuelve una lista de todos los libros.
- POST /libros: Añade un nuevo libro (título, autor, género, año de publicación).
- PUT /libros/:id: Actualiza la información de un libro existente.
- DELETE /libros/:id: Elimina un libro.

Usuarios:
- GET /usuarios: Devuelve una lista de todos los usuarios.
- POST /usuarios: Añade un nuevo usuario (nombre, email, password, edad).
- PUT /usuarios/:id: Actualiza la información de un libro existente.
- DELETE /usuarios/:id: Elimina un usuario.

## Requisitos

- PHP >= 7.4
- Composer
- Symfony CLI
- MySQL (o cualquier base de datos que uses)

## Instalación

1. Clona el repositorio:
    ```bash
    git clone https://github.com/tu-usuario/nombre-de-tu-proyecto.git
    cd nombre-de-tu-proyecto
    ```

3. Instala las dependencias:
    ```bash
    composer install
    ```

5. Ejecuta el servidor de desarrollo:
    ```bash
    symfony server:start
    ```

## Uso: Consultas cURL
### Libro
1. Obtener la Lista de Libros
   ```bash
   curl -X GET http://127.0.0.1:8000/api/libros
    ```
2. Crear Libro
    ```bash
    curl -X POST http://127.0.0.1:8000/api/libros -H "Content-Type: application/json" -d '{"titulo": "El Quijote", "autor": "Miguel de Cervantes", "genero": "Novela", "anoPublicacion": "1605"}'
    ```
3. Actualizar Libro
    ```bash
   curl -X PUT http://127.0.0.1:8000/api/libros/1 -H "Content-Type: application/json" -d '{"titulo": "El Quijote - Edición Revisada"}'
    ```
4. Eliminar Libro
   ```bash
    curl -X DELETE http://127.0.0.1:8000/api/libros/1
    ```
### Usuarios
1. Crear Usuario
    ```bash
    curl -X POST http://127.0.0.1:8000/api/usuarios -H "Content-Type: application/json" -d '{"nombre": "Juan Pérez", "email": "juan.perez@example.com", "password": "123456", "edad": 30}'
    ```
2. Actualizar Usuario
    ```bash
    curl -X PUT http://127.0.0.1:8000/api/usuarios/1 -H "Content-Type: application/json" -d '{"nombre": "Nuevo Nombre"}'
    ```
3. Eliminar Usuario
   ```bash
    curl -X DELETE http://127.0.0.1:8000/api/usuarios/1
    ```
## Tests
Si es necesario elimina todos lo sdatos de la base de datos y inicializa las secuencias tanto del id de libro como de usuario hay que resetearlas a 1 o modificar este dato en los test.

Para ejecutar los tests, usa el siguiente comando:
```bash
php vendor/bin/phpunit
```