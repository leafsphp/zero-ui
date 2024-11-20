<?php

use Zero\Core;

function Container(array $props)
{
  $props['data-zero-component'] = 'Container';

  $props['class'] = Core::mergeStyles(
    'container mx-auto',
    $props['class'] ?? ''
  );

  return Column($props);
}

function Row(array $props)
{
  $props['data-zero-component'] = $props['data-zero-component'] ?? 'Row';

  $props['class'] = Core::mergeStyles(
    'flex flex-row flex-wrap',
    ($props['center'] ?? false) ? 'justify-center items-center' : '',
    $props['class'] ?? ''
  );

  return Core::createElement('div', $props);
}

function Column(array $props)
{
  $props['data-zero-component'] = $props['data-zero-component'] ?? 'Column';

  $props['class'] = Core::mergeStyles(
    'flex-col',
    $props['class'] ?? ''
  );

  return Row($props);
}
