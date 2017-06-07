let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js','public/js')

	.js('resources/assets/js/api/controllers/users/ListController.js','public/js/api/controllers/users/ListController.js')
	.js('resources/assets/js/api/controllers/users/EditController.js','public/js/api/controllers/users/EditController.js')
	.js('resources/assets/js/api/controllers/users/CreateController.js','public/js/api/controllers/users/CreateController.js')

	.js('resources/assets/js/components/users/List.vue','public/js/components/users/List.js')
	.js('resources/assets/js/components/users/Edit.vue','public/js/components/users/Edit.js')
	.js('resources/assets/js/components/users/Create.vue','public/js/components/users/Create.js')

   .sass('resources/assets/sass/app.scss', 'public/css');
