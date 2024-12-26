# Leaf Zero

Leaf Zero is a carefully crafted group of components, page sections, UI blocks and application scaffold, fully charged with Alpine, Leaf and Tailwind that will help you build your frontend in no time, leaving you to focus on all the interesting parts of your application.

<!-- Zero has free components which are available for download on the [Leaf Zero GitHub repository](https://github.com/leafsphp/zero) and premium components which you can use by subscribing to [Leaf Zero](https://zero.leafphp.com/). -->

## UI Components

Zero comes with a variety of everyday components like buttons, cards, modals, forms, and more. These components are designed to be easy to use and customize, but also to look great out of the box. They have different styles and colors to fit your application's design.

```php
Button([
  'href' => '/login',
  'variant' => 'text',
  'text' => 'Sign In'
]);
```

## Page Sections/UI Blocks

Zero also comes with a variety of page sections and UI blocks which have been componentized to make them flexible and easy to use in your application. These include headers, footers, hero sections, feature sections, and more.

```php
Hero([
  'title' => 'Plan your next trip Supafast...',
  'subtitle' => 'Get the best deals on flights, hotels, and car rentals.',
  'buttons' => [
    Button([
      'href' => '/subscribe',
      'text' => 'Subscribe to TripifyX',
    ]),
    Button([
      'icon' => '→',
      'href' => '/login',
      'variant' => 'outline',
      'text' => 'Sign In',
    ]),
  ],
]);
```

## Leaf powered

Zero components and UI blocks are powered by Leaf, which means that every section will have a full integration and will work as expected right out of the box. Things like form submissions, login, sign up, newsletter subscriptions, blog posts, and more are all built-in and ready to use.

```php
Form([
  'action' => '/subscribe',
  'method' => 'POST',
  'fields' => [
    Input([
      'name' => 'email',
      'label' => 'Email',
      'placeholder' => 'Enter your email',
      'required' => true,
    ]),
    Button([
      'text' => 'Subscribe',
    ]),
  ],
]);
```

```php
LoginPage_Premium_112([
  'title' => 'Sign In',
  'layout' => 'center',
  'form' => Form([
    'action' => '/login',
    'method' => 'POST',
    'fields' => [
      Input([
        'name' => 'email',
        'label' => 'Email',
        'placeholder' => 'Enter your email',
        'required' => true,
      ]),
      Input([
        'name' => 'password',
        'label' => 'Password',
        'type' => 'password',
        'placeholder' => 'Enter your password',
        'required' => true,
      ]),
      Button([
        'text' => 'Sign In',
      ]),
    ],
  ]),
]);
```
