<?php

namespace Zero;

use YieldStudio\TailwindMerge\TailwindMerge;

/**
 * Leaf Zero Core
 * ---
 * This class is the core of Leaf Zero. It contains all the necessary
 * methods to get Leaf Zero up and running.
 */
class Core
{
  protected static $imports = [];

  protected static $styles = [];

  protected static $bodyScripts = [];

  protected static $globalMarkup = [];

  protected static $theme = [
    'primary' => [
      'default' => 'blue-500',
      'hover' => 'blue-600',
    ],
    'secondary' => [
      'default' => 'gray-500',
      'hover' => 'gray-600',
    ],
    'success' => [
      'default' => 'green-500',
      'hover' => 'green-600',
    ],
    'danger' => [
      'default' => 'red-500',
      'hover' => 'red-600',
    ],
    'info' => [
      'default' => 'indigo-500',
      'hover' => 'indigo-600',
    ],
    'warning' => [
      'default' => 'yellow-500',
      'hover' => 'yellow-600',
    ],
  ];

  /**
   * Get zero head imports
   */
  public static function imports()
  {

    $imports = implode("\n", static::$imports);
    $styles = implode("\n", static::$styles);

    return <<<HTML
    $imports
    $styles
    HTML;
  }

  /**
   * Create default theme for Zero
   *
   * @param array $theme
   * @return void
   */
  public static function createTheme(array $theme)
  {
    static::$theme = array_merge(static::$theme, $theme);
  }

  /**
   * Get theme
   */
  public static function getTheme()
  {
    return static::$theme;
  }

  /**
   * Create a new element
   * @param string $element
   * @param array $props
   * @param mixed $children
   * @return string
   */
  public static function createElement(string $element, array $props = [], $children = [])
  {
    $subs = '';
    $attributes = '';

    if (isset($props['children']) && (!$children || ($children && empty($children)))) {
      $children = $props['children'];
      unset($props['children']);
    }

    if (is_array($children)) {
      foreach ($children as $child) {
        $subs .= $child;
      }
    } else {
      $subs = $children;
    }

    if (!empty($props)) {
      foreach ($props as $key => $value) {
        $attributes .= "$key=\"" . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . "\" ";
      }
    }

    return (!$children || $children && empty($children))
      ? "<$element $attributes />"
      : "<$element $attributes>$subs</$element>";
  }

  /**
   * Map scripts to script tag
   *
   * @param array $scripts The scripts to apply
   * @param array $props Script tag attributes
   */

  /**
   * Map styles to style tag
   *
   * @param array $styles The styles to apply
   * @param array $props Style tag attributes
   */
  public static function createStyles(array $styles, array $props = [])
  {
    return self::createElement(
      'style',
      $props,
      Core::parseStyles($styles)
    );
  }

  /**
   * Loop over an array of items
   *
   * @param array|string|int $array The array to loop through
   * @param callable $handler Call back function to run per iteration
   */
  public static function loop($array, callable $handler)
  {
    $element = '';

    if (!is_array($array)) {
      $array = explode(',', str_repeat(',', (int) $array - 1));
    }

    if (is_callable($handler)) {
      foreach ($array as $key => $value) {
        $element .= call_user_func($handler, $value, $key);
      }
    }

    return $element;
  }

  /**
   * Merge tailwind styles
   */
  public static function mergeStyles(...$styles)
  {
    return TailwindMerge::instance()->merge(...$styles);
  }


  protected static function parseStyles(array $styles): string
  {
    $parsedStyles = '';

    foreach ($styles as $key => $value) {
      if (is_numeric($key)) {
        $value = rtrim($value, ';');
        $parsedStyles .= "$value;";
      } else if (is_string($value)) {
        $value = rtrim($value, ';');

        if (strpos($value, ':') !== false) {
          $parsedStyles .= "$key { $value; }";
        } else {
          $parsedStyles .= "$key: $value;";
        }
      } else {
        $parsedStyles .= "$key {";

        foreach ($value as $selector => $styling) {
          if (is_array($styling)) {
            if (is_string($selector)) {
              $parsedStyles .= self::parseStyles([$selector => $styling]);
            } else {
              $parsedStyles .= self::parseStyles($styling);
            }
          } else {
            $styling = rtrim($styling, ';');

            if (is_numeric($selector)) {
              $parsedStyles .= self::parseStyles(["$styling;"]);
            } else {
              if (strpos($styling, ':') !== false) {
                $parsedStyles .= "$selector { $styling; }";
              } else {
                $parsedStyles .= "$selector: $styling;";
              }
            }
          }
        }

        $parsedStyles .= '}';
      }
    }

    return $parsedStyles;
  }
}
