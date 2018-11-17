# App de control de juegos deportivos

## Funciones
1. Agregar Organizaciones
2. Agregar Torneos
3. Agregar Fases de grupos o Liguillas
4. Agregar Etapas (Semifinal y Final)
5. Generar llaves de encuentros
6. Crear calendarios
7. Ingresar Resultados de partidos
8. Tablas de posiciones
9. Estadisticas (Goleadores, Encestadores)
10. Agregar Equipos
11. Agregar Jugadores
12. Agregar Páginas

## Limitaciones
- Solo soporta 4 tipos de deportes; Fútbol, Basquet, Volley y Futsal.
- No se pueden agregar mas deportes, esta parte no es dinámica.
- Las llaves solo estan disponibles para Semifinal y final.

## Técnologias usadas
1. Base de datos: Mysql
2. Sass para frontend
3. Gulp para compilar Sass
4. Vue.js -> minima parte del admin.
5. Javascript es5 para algunos eventos.
6. Otros que podrás ver en Package.json & composer.json

## Importante.
Si deseas probar este codigo debes tener conocimientos de Laravel y los comandos de ejecución de migraciones y semillas, si los tienes sigue los siguientes pasos.
1. Configura la base de datos con el arhivo `playsport.sql`
2. Configura el archivo `.env`
3. Dirigete a enclace `domain-name/dt-login`
4. Usuario `admin@mail.com` y contraseña `admin`

Si deseas probar el proyecto con una base de datos nueva y sin ningun registro, prueba lo siguiente.

1. Configura el archivo `.env`
2. Ejecuta el comando `php artisan migrate`
3. Ejecuta el comando `php artisan db:seed`
4. Repita el paso 3 y 4 de la lista anterior.

## Capturas de pantalla

![Imgur](https://i.imgur.com/ZAgXPPN.png)
![Imgur](https://i.imgur.com/jddILkL.png)
![Imgur](https://i.imgur.com/jddILkL.png)
![Imgur](https://i.imgur.com/kdjhUNA.png)
