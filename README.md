# qTwitter
Twitter like app using GraphQL Vue.js on Laravel by http://www.qcode.in
Check out the tutorials.

 ![QTwitter App](https://i1.wp.com/www.qcode.in/wp-content/uploads/2017/09/qTwitter-App.jpg?w=1200)

- [Implementing GraphQL with Laravel](http://www.qcode.in/build-api-for-twitter-like-app-using-graphql-in-laravel)
- [Build Twitter Like app on Vue, Vuex and Vue Router to consume GraphQL](http://www.qcode.in/building-front-end-for-twitter-like-app-on-vuejs)

## Installation 
- Clone the repo and run `composer install` once installed you can create `.env` by `cp .env.example .env` now add your db credential in it.
- Now generate a key for your app using `php artisan key:generate`
- Then run the `php artisan db:seed` to seed the app with dummy data
- point the baseURL of axios http to your app url by editing it in `resources/assets/js/utils/http.js`, by default it set to `http://locahost:8000`
- If your url is localhost:8000 you can run the app by `php artisan serve` otherwise you need to install npm deps by running `npm install` after this you need to `npm run watch` to build the app browse.

### Author
Created by [QCode.in](http://www.qcode.in)

## License  
[MIT license](http://opensource.org/licenses/MIT).
