<?php
$app->get('/', App\Action\HomePageAction::class, 'home');
$app->get('/api/ping', App\Action\PingAction::class, 'api.ping');
$app->get('/beer', App\Action\Beer\Index::class, 'beer.index');
// $app->get('/beer/{id}', App\Action\Beer\View::class, 'beer.view');
$app->post('/beer', App\Action\Beer\Create::class, 'beer.create');
$app->put('/beer/{id}', App\Action\Beer\Update::class, 'beer.update');
$app->delete('/beer/{id}', App\Action\Beer\Delete::class, 'beer.delete');
