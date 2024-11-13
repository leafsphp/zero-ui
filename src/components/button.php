<?php

use Zero\Core;

function Button(array $props)
{
  $children = [];
  $as = $props['as'] ?? 'button';
  $props['type'] = $props['type'] ?? 'button';
  $props['data-zero-component'] = 'Button';

  if (isset($props['href'])) {
    $as = 'a';
  }

  $defaultStyles = 'transition-all inline-flex justify-center rounded-lg text-sm font-semibold py-2.5 px-4';
  $buttonStyles = [
    'text' => '',
    'link' => 'text-[#EC504B] hover:text-[#FFAA49]',
    'default' => 'bg-[#EC504B] text-white hover:bg-[#FF6A49]',
    'outline' => 'bg-white/0 text-slate-900 ring-1 ring-slate-900/10 hover:bg-white/25 hover:ring-slate-900/15 whitespace-nowrap'
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
    $children[] = Core::createElement(
      'span',
      ['class' => 'ml-2', 'aria-hidden' => 'true'],
      $props['icon']
    );

    unset($props['icon']);
  }

  return Core::createElement($as, $props, $children);
}
