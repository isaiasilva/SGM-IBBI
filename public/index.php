<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| O Composer fornece um carregador de classes conveniente e gerado automaticamente para
| nossa aplicação. Nós apenas precisamos utilizá-lo! Simplesmente exigimos
| no script aqui para que não tenhamos que nos preocupar com o manual
| carregando qualquer uma de nossas aulas mais tarde. É ótimo relaxar.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| Precisamos iluminar o desenvolvimento do PHP, então vamos acender as luzes.
| Isso inicializa a estrutura e a prepara para uso, depois
| irá carregar este aplicativo para que possamos executá-lo e enviar
| as respostas de volta ao navegador e encantam nossos usuários.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Assim que tivermos o aplicativo, podemos lidar com a solicitação recebida
| através do kernel e envie a resposta associada de volta para
| o navegador do cliente, permitindo que eles apreciem o criativo
| e maravilhosa aplicação que preparamos para eles.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
