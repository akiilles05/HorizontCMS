<?php

use Illuminate\Support\Facades\Route;
use \App\Model\Settings;
use Illuminate\Http\Request;
use Illuminate\Contracts\Container\Container;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::resource('/', \App\Controllers\WebsiteController::class);

Route::any('/{slug?}/{args?}', function ($slug = "", $args = null, Request $request, Container $container) {

	try {

		try {

			$this->router->changeNamespace("Theme\\" . Settings::get('theme') . "\\App\\Controllers\\");

			$action = explode("/", $args)[0];

			return $this->router->resolve($slug, $action, ltrim($args, $action . "/"));
		} catch (Exception $e) {


			if ($e instanceof \App\Exceptions\FileNotFoundException || $e instanceof BadMethodCallException) {

				$controller = \App::make('\App\Controllers\WebsiteController');

				$controller->before();

				if (method_exists($controller, $slug)) {

					return $controller->callAction($slug, [$slug, $args]);
				}


				return $controller->callAction('index', [$slug, $args]);
			}


			throw $e;
		}
	} catch (Exception $e) {
		$handler = new \App\Exceptions\WebsiteExceptionHandler($container);

		return $handler->render($request, $e);
	}
})->where('args', '(.*)');