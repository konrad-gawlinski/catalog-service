<?php
use Symfony\Component\HttpFoundation\Request;

$app->put('/product/{sku}/{country}/{lang}',
  function(Request $request, string $sku, string $country, string $lang) use($app) {
    $payload = $request->request->all();

    /** @var Nu3\Service\Product\Action\UpdateProduct\Action $service */
    $service = $app['product.update_action'];
    $actionRequest = new \Nu3\Service\Product\Action\CURequest([
        'sku' => $sku, 'country' => $country, 'lang' => $lang, 'payload' => $payload]
    );

    return $service->run($actionRequest);
  }
);

$app->post('/product/{sku}',
  function(Request $request, string $sku) use($app) {
    $payload = $request->request->all();

    /** @var Nu3\Service\Product\Action\CreateProduct\Action $service */
    $service = $app['product.create_action'];
    $actionRequest = new \Nu3\Service\Product\Action\CURequest(['sku' => $sku, 'payload' => $payload]);

    return $service->run($actionRequest);
  }
);

$app->get('/product/{productId}', function($productId) use($app) {
  /** @var Nu3\Service\Product\Action\GetProduct\Action $service */
  $service = $app['product.get_action'];
  $actionRequest = new \Nu3\Service\Product\Action\GetRequest(['id' => $productId]);

  return $service->run($actionRequest);
});
