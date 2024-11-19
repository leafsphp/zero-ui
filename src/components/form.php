<?php

use Zero\Core;

function _Form(array $props)
{
  $props['data-zero-component'] = 'Form';
  $props['method'] = isset($props['method']) ? strtolower($props['method']) : 'post';

  // if (!in_array($props['method'], ['get', 'post'])) {
  //   $props['method'] = 'post';
  //   $props['children'][] = Core::createElement('input', ['type' => 'hidden', 'name' => '_method', 'value' => $props['method']]);
  // }

  return Core::createElement('form', $props);
}

function Toggle(array $props = [])
{
  $props['data-zero-component'] = 'Toggle';

  $checked = (string) ($props['checked'] ?? 'false');
  $props['x-data'] = "{ active: $checked }";

  $colors = Core::getTheme()[$props['theme'] ?? 'primary'];
  $mainColor = $colors['default'];
  $hoverColor = $colors['hover'];

  $variant = $props['variant'] ?? 'round';
  $label = $props['label'] ?? false;

  $props['@click'] = 'active = !active';
  $props[':aria-checked'] = 'active';
  $props['class'] = Core::mergeStyles(
    $label ? 'flex items-center gap-2' : '',
    $props['class'] ?? ''
  );

  $props['children'] = [
    Core::createElement('div', [
      'class' => Core::mergeStyles(
        'cursor-pointer h-6 w-10 p-1 ring-1 ring-inset transition duration-200 ease-in-out',
        $variant === 'round' ? 'rounded-full' : 'rounded-sm',
        $props['class'] ?? ''
      ),
      ':class' => "active ? \"bg-$mainColor hover:bg-$hoverColor ring-slate-900/5\" : \"bg-slate-900/10 hover:bg-slate-900/20 ring-slate-900/5\"",
      'children' => [
        Core::createElement('input', [
          'type' => 'checkbox',
          'name' => $props['name'] ?? 'switch',
          'class' => 'hidden',
          ':checked' => 'active',
        ]),
        Core::createElement('button', [
          'class' => Core::mergeStyles(
            'size-4 rounded-full bg-white shadow-sm ring-1 ring-slate-700/10 transition duration-200 ease-in-out',
            $variant === 'round' ? 'rounded-full' : 'rounded-sm',
          ),
          ':class' => 'active ? "translate-x-4" : "translate-x-0"',
        ])
      ]
    ]),
    $label ? Core::createElement('label', [':class' => "{ 'text-$mainColor': active, 'opacity-50': !active }", 'children' => [$label]]) : ''
  ];

  return Core::createElement('div', $props);
}

function Radio(array $props)
{
  $props['data-zero-component'] = 'RadioGroup';
  $props['role'] = 'radiogroup';
  $props['aria-labelledby'] = $props['name'];

  $children = $props['children'] ?? [];

  $dataValues = array_map(function ($child) {
    return $child['value'];
  }, $children);

  $selected = (string) ($props['selected'] ?? 'null');
  $props['x-data'] = $props['x-data'] ?? "{ selected: '$selected', data: " . json_encode($dataValues) . " }";

  $props['children'] = [
    isset($props['title']) ? Core::createElement('p', ['class' => 'mb-2 Zero-RadioGroupLabel', 'children' => [$props['title']]]) : null,
  ];

  $props['@keydown.down.stop.prevent'] = "selected = data[(data.indexOf(selected) + 1) % data.length]";
  $props['@keydown.left.stop.prevent'] = "selected = data[(data.indexOf(selected) - 1 + data.length) % data.length]";
  $props['@keydown.up.stop.prevent'] = "selected = data[(data.indexOf(selected) - 1 + data.length) % data.length]";
  $props['@keydown.right.stop.prevent'] = "selected = data[(data.indexOf(selected) + 1) % data.length]";
  $props['@keydown.home.stop.prevent'] = "selected = data[0]";
  $props['@keydown.end.stop.prevent'] = "selected = data[data.length - 1]";

  foreach ($children as $child) {
    $colors = Core::getTheme()[$child['theme'] ?? 'primary'];
    $mainColor = $colors['default'];
    $hoverColor = $colors['hover'];

    $currentValue = $child['value'];

    $description = isset($child['description']) ? (
      Core::createElement('p', ['class' => 'text-sm opacity-50 col-start-2', 'children' => [$child['description']]])
    ) : null;

    $label = isset($child['label']) ? (
      Core::createElement('label', ['class' => '', 'children' => [$child['label']], '@click' => "selected = '$currentValue'"])
    ) : null;

    $props['children'][] = Core::createElement('div', [
      'data-zero-component' => 'Radio',
      'role' => 'radio',
      ':aria-checked' => "selected === '$currentValue'",
      'class' => Core::mergeStyles(
        'grid grid-cols-[auto_1fr] gap-x-2 gap-y-1 items-center',
        $label ? 'w-full' : '',
      ),
      'children' => [
        Core::createElement('input', [
          'type' => 'radio',
          'name' => $props['name'] ?? 'radio',
          'class' => 'hidden',
          'value' => $child['value'],
          ':checked' => "selected === '$currentValue'",
        ]),
        Core::createElement('button', [
          'class' => Core::mergeStyles(
            'size-5 rounded-full shadow-sm ring-1 transition duration-200 ease-in-out flex items-center justify-center outline-offset-2',
            $child['class'] ?? '',
          ),
          ':class' => "selected === '$currentValue' ? \"bg-$mainColor ring-$mainColor hover:bg-$hoverColor hover:ring-$hoverColor\" : \"hover:bg-slate-900/5 ring-slate-700/10\"",
          '@click' => "selected = '$currentValue'",
          'children' => [
            Core::createElement('div', [
              'class' => 'size-3 rounded-full bg-white',
              ':class' => "{ 'hidden': selected !== '$currentValue' }",
            ]),
          ],
        ]),
        $label,
        $description,
      ],
    ]);
  }
  ;

  return Core::createElement('div', $props);
}

function Checkbox(array $props)
{
  $props['data-zero-component'] = 'Checkbox';

  $className = $props['class'] ?? '';
  $checked = (string) ($props['checked'] ?? 'false');
  $props['x-data'] = "{ active: $checked }";

  $colors = Core::getTheme()[$props['theme'] ?? 'primary'];

  $mainColor = $colors['default'];
  $hoverColor = $colors['hover'];

  $description = isset($props['description']) ? (
    Core::createElement('p', ['class' => 'text-sm opacity-50 col-start-2', 'children' => [$props['description']]])
  ) : null;
  $label = isset($props['label']) ? (
    Core::createElement('label', ['class' => '', 'children' => [$props['label']], '@click' => 'active = !active'])
  ) : null;

  $props['role'] = 'checkbox';
  $props[':aria-checked'] = 'active';
  $props['class'] = Core::mergeStyles(
    'grid grid-cols-[auto_1fr] gap-x-2 gap-y-1 items-center',
    $label ? 'w-full' : '',
  );

  $props['children'] = [
    Core::createElement('input', [
      'type' => 'checkbox',
      'name' => $props['name'] ?? 'checkbox',
      'class' => 'hidden',
      ':checked' => 'active',
    ]),
    Core::createElement('button', [
      'class' => Core::mergeStyles(
        'size-5 rounded-sm shadow-sm ring-1 transition duration-200 ease-in-out flex items-center justify-center outline-offset-2',
        $className,
      ),
      ':class' => "active ? \"bg-$mainColor ring-$mainColor hover:bg-$hoverColor hover:ring-$hoverColor\" : \"hover:bg-slate-900/5 ring-slate-700/10\"",
      '@click' => 'active = !active',
      'children' => [
        Core::createElement('svg', [
          'class' => 'w-2/3 h-2/3',
          ':class' => '{ "hidden": !active }',
          'viewBox' => '0 0 24 24',
          'fill' => 'none',
          'stroke' => 'white',
          'data-slot' => 'icon',
          'children' => [
            Core::createElement('path', ['d' => 'M5 13l4 4L19 7', 'stroke-width' => '4', 'stroke-linecap' => 'round', 'stroke-linejoin' => 'round']),
          ],
        ]),
      ],
    ]),
    $label,
    $description,
  ];

  return Core::createElement('div', $props);
}

function Button(array $props)
{
  $children = [];
  $as = $props['as'] ?? 'button';
  $props['type'] = $props['type'] ?? 'button';
  $props['data-zero-component'] = 'Button';

  $colors = Core::getTheme()[$props['theme'] ?? 'primary'];
  $mainColor = $colors['default'];
  $hoverColor = $colors['hover'];

  if (isset($props['href'])) {
    $as = 'a';
  }

  $defaultStyles = 'transition-all inline-flex justify-center rounded-lg text-sm font-semibold py-2.5 px-4';
  $buttonStyles = [
    'text' => '',
    'link' => "text-$mainColor hover:text-$hoverColor underline",
    'default' => "bg-$mainColor text-white hover:bg-$hoverColor",
    'outline' => "bg-white/0 text-slate-900 ring-1 ring-slate-900/10 hover:bg-white/25 hover:ring-slate-900/15 whitespace-nowrap"
  ];

  $props['class'] = Core::mergeStyles(
    $defaultStyles,
    $buttonStyles[$props['variant'] ?? 'default'],
    $props['class'] ?? ''
  );

  if ($as === 'a') {
    unset($props['type']);
    unset($props['as']);
  }

  if (isset($props['text'])) {
    $children[] = $props['text'];
    unset($props['text']);
  }

  if (isset($props['icon'])) {
    $children[] = $props['icon'];
    unset($props['icon']);
  }

  return Core::createElement($as, $props, $children);
}
