## About

Project is a simple backend application to social network. Includes actions to: follower, following, post: text, images and video.

## Requirements

- PHP >= 7.1.3
- Composer

## Install

- Clone or download the project. After install open project folder in your terminal. And run:

`composer install`

- Application is configures to use Sqlite. Create a new empty file `database.sqlite` in folder `/database/`

- Change `.env.example` to `.env`

- Open .env and edit to:

DB_CONNECTION=sqlite

#DB_HOST=127.0.0.1

#DB_PORT=3306

#DB_DATABASE=laravel

#DB_USERNAME=root

#DB_PASSWORD=

- Run `php artisan migrate`. Database will started.

- Execute command ´php artisan key:generate´

- Run php: `php artisan serv` and will normaly runing on `<http://127.0.0.1:8000>`

## Routes

Public routes: 
- POST /users/create
- POST /users/login
- GET /users/logout

Private routes (require authentication):
- POST /users/update
- GET /users/likes
- GET /feeds
- GET /posts
- POST /posts/create
- POST /posts/update/{idPost}
- DELETE /posts/{idPost}
- GET /posts/likes/{idPost} => Save and remove likes 
- GET /followers/{idUser}
- GET /followers/users/{idUser}
- GET /following/{idUser}
- GET /following/users/{idUser}
- POST /following/save/{idUser} => Save and remove following 

## Tests

All can be testeds with application [Insomnia](https://insomnia.rest/download/). Import file Insomnia.json in root of the project.
