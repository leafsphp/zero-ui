<?php

require dirname(__DIR__) . '/vendor/autoload.php';

echo '<script src="https://cdn.tailwindcss.com"></script>';
echo '<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>';

echo Button([
  'href' => '#',
  'variant' => 'outline',
  'text' => 'Click me',
]);
