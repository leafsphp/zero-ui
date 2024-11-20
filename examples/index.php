<?php

require dirname(__DIR__) . '/vendor/autoload.php';

echo '<script src="https://cdn.tailwindcss.com"></script>';
echo '<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>';

// echo '<style>body{background:black;color:white;}</style>';

echo '<div class="flex justify-between w-2/3">';

echo Button([
  'text' => 'Default Button',
]);

echo Button([
  'variant' => 'outline',
  'text' => 'Click me',
]);

echo Button([
  'href' => '#',
  'variant' => 'text',
  'text' => 'Click me',
]);

echo Button([
  'href' => '#',
  'variant' => 'link',
  'text' => 'Click me',
]);

echo Button([
  'theme' => 'success',
  'text' => 'Click me',
]);

echo Button([
  'theme' => 'danger',
  'text' => 'Click me',
]);

echo Button([
  'theme' => 'info',
  'text' => 'Click me',
]);

echo Button([
  'theme' => 'warning',
  'text' => 'Click me',
]);

echo Button([
  'href' => '#',
  'class' => 'bg-purple-500 text-black hover:bg-purple-600',
  'icon' => Icon([
    'name' => 'heart',
    'class' => 'text-red-500',
  ]),
  'text' => 'Click me',
]);

echo '</div>';

echo Icon([
  'name' => 'heart',
  'class' => 'text-red-500 size-40',
]);

echo Icon([
  'variant' => 'outline',
  'name' => 'academic-cap',
  'class' => 'text-purple-500 size-20',
]);

echo Icon([
  'variant' => 'solid',
  'name' => 'bolt',
  'class' => 'text-amber-300 size-10',
]);

echo Icon([
  'theme' => 'success',
  'name' => 'bolt',
  'class' => 'size-10',
]);

echo _Form([
  'method' => 'get',
  'action' => 'https://google.com/search',
  'children' => [
    '<input type="text" name="q" placeholder="Search" class="p-2 border border-gray-500 rounded-lg text-black">',
    Button([
      'type' => 'submit',
      'text' => 'Search',
    ]),
  ],
]);

echo '<hr />';

echo Toggle();
echo Toggle([
  'theme' => 'success',
  'variant' => 'square',
]);
echo Toggle([
  'theme' => 'danger',
  'checked' => true,
]);
echo Toggle([
  'theme' => 'info',
  'label' => 'Toggle me',
]);

echo '<hr />';

echo Checkbox([
  'class' => 'size-16',
]);

echo Checkbox([
  'theme' => 'success',
  'checked' => true,
]);

echo Checkbox([
  'label' => 'Do you agree to the terms?',
]);

echo Checkbox([
  'theme' => 'danger',
  'label' => 'Email notifications',
  'description' => 'Receive email notifications when someone follows you.',
]);

echo '<hr />';

echo Radio([
  'name' => 'platform',
  'children' => [
    ['label' => 'Windows', 'value' => 'windows'],
    ['label' => 'Mac', 'value' => 'mac'],
    ['label' => 'Linux', 'value' => 'linux'],
  ],
]);

echo Radio([
  'selected' => 'green',
  'name' => 'eye_color',
  'class' => 'my-8 grid gap-y-3',
  'children' => [
    ['label' => 'Blue', 'value' => 'blue'],
    [
      'theme' => 'success',
      'label' => 'Green',
      'value' => 'green',
    ],
    [
      'theme' => 'danger',
      'label' => 'Not sure',
      'value' => 'not_sure',
      'description' => 'I am not sure what my eye color is.',
    ],
  ],
]);

echo Container([
  'class' => 'bg-gray-100 p-4',
  'children' => [
    Heading([
      'as' => 'h1',
      'text' => 'Hello, World!',
    ]),
    Text([
      'text' => 'This is a paragraph.',
    ]),
  ],
]);
