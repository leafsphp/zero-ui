<?php

use Zero\Core;

function Heading(array $props)
{
  $props['data-zero-component'] = 'Heading';
  $as = $props['as'] ?? 'p';

  $props['class'] = Core::mergeStyles(
    'font-bold',
    $props['class'] ?? ''
  );

  return Core::createElement($as, $props);
}

function Text(array $props)
{
  $props['data-zero-component'] = 'Text';

  $props['class'] = Core::mergeStyles(
    'text-base',
    $props['class'] ?? ''
  );

  return Core::createElement('p', $props);
}

function Icon(array $props)
{
  $size = $props['size'] ?? '24';
  $variant = $props['variant'] ?? 'solid';
  $props['data-zero-component'] = 'Icon';
  $props['class'] = Core::mergeStyles(
    'size-6',
    $props['class'] ?? '',
  );

  if ($variant === 'outline') {
    $props['stroke'] = $props['stroke'] ?? 'currentColor';
    $props['fill'] = 'none';
  } else {
    $props['fill'] = $props['fill'] ?? 'currentColor';
    $props['stroke'] = 'none';
  }

  $props['data-slot'] = 'icon';
  $props['aria-hidden'] = 'true';
  $props['viewBox'] = $props['viewBox'] ?? "0 0 $size $size";

  if (isset($props['theme'])) {
    $props['class'] = Core::mergeStyles(
      $props['class'] ?? '',
      'text-' . Core::getTheme()[$props['theme']]['default']
    );
  }

  $props['children'] = file_get_contents(dirname(__DIR__) . "/icons/{$variant}/{$props['name']}.svg");

  // unset($props['name']);
  // unset($props['variant']);

  return Core::createElement('svg', $props);
}
