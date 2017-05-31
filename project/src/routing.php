<?php
use Symfony\Component\HttpFoundation\Request;

function getPayload()
{
  return <<<'PAYLOAD'
{
  "storage": "catalog",
  "product": {
    "sku": "nu3_2",
    "status": "new",
    "name": " Silly Hodgin",
    "type": "config",
    "price": {
      "final": 5172
    },
    "tax_rate": 19,
    "attributes": [
      "is_gluten_free",
      "is_lactose_free"
    ],
    "seo": {
      "robots": ["noindex", "follow"],
      "title": " Silly Hodgkin "
    },
    "manufacturer": "philips2",
    "description": "Your neighbours will visit you more often",
    "short_description": "curved 55\" tv",
    "manufacturer": "philips",
    "label_language": [
      "en",
      "it"
    ]
  }
}
PAYLOAD;
}

$app->get('/product/save', function(Request $request) use($app) {
  /** @var Nu3\Service\Product\SaveAction\Action $service */
  $service = $app['product.save_action'];
  $productSaveRequest = new \Nu3\Service\Product\SaveAction\Request(getPayload());

  return $service->run(
    $productSaveRequest,
    $app['product.gateway']
  );
});

$app->get('/product/{sku}/{storage}', function($sku, $storage) use($app) {
  /** @var Nu3\Service\Product\GetAction\Action $service */
  $service = $app['product.get_action'];
  $productGetRequest = new \Nu3\Service\Product\GetAction\Request(['sku' => $sku, 'storage' => $storage]);

  return $service->run(
    $productGetRequest,
    $app['product.gateway']
  );
});
