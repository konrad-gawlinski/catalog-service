<?php
return array (
  'database' => 
  array (
    'username' => 'postgres',
    'password' => 'postgres',
    'host' => '172.17.0.2',
    'database' => 'nu3_catalog',
  ),
  'storage' => 
  array (
    'available' => 
    array (
      0 => 'catalog',
      1 => 'catalog_de',
      2 => 'catalog_at',
    ),
  ),
  'product' => 
  array (
    'config' => 
    array (
      'validation_rules' => 'config.yml',
      'default_values' => 'config.php',
    ),
    'bundle' => 
    array (
      'validation_rules' => 'config.yml',
      'default_values' => 'bundle.php',
    ),
  ),
);
