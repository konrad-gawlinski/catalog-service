<?php

namespace Nu3\Service\Product;

use Nu3\Service\Product\Entity\Payload;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nu3\Core;
use Nu3\Property;
use Nu3\Service\Product\Entity\Properties as ProductProperty;

class Controller
{
  function save(Request $request, Model $productModel): Response
  {
    $json = $this->getInput();
    $payload = json_decode($json, true);

    $productModel->preValidatePayload($payload);

    $storedProduct = $productModel->getProductFromStorage(
      $payload[ProductProperty::PRODUCT][ProductProperty::PRODUCT_SKU],
      $payload[ProductProperty::STORAGE]
    );
    
    $productModel->preValidateProduct($payload, $storedProduct);
    $productModel->validatePayload($payload);
    $payloadEntity = $this->buildPayload($payload);
    $productEntity = $productModel->createProductEntity($payloadEntity, $storedProduct);
    $productModel->validateEntity($productEntity);

    $productModel->saveProduct($productEntity);

    return new Response('Product save action', 200);
  }

  private function buildPayload(array $input) : Payload
  {
    $payload = new Payload();
    $payload->product = $input[ProductProperty::PRODUCT];
    $payload->storage = $input[ProductProperty::STORAGE];

    return $payload;
  }

  private function getInput(): string
  {
    return <<<'PAYLOAD'
{
  "storage": "common",
  "product": {
    "sku": "nu3_1",
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
      "title": "Silly Hodgkin "
    },
    "manufacturer": "philips2",
    "description": "Your neighbours will visit you more often",
    "short_description": "curved 55\" tv",
    "manufacturer": "philips",
    "label_language": [
      " en ",
      " it"
    ]
  }
}
PAYLOAD;
  }
}