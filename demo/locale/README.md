# locale

This is the folder where multilang support files live.

It is clasified by language for convenience so that the core library `Locale` can load the required dictionaries for the current lang.

```php
// configure lang for current user
$app->locale->lang = 'es-ES';

// load lang dictionaries as configured with $app->locale->lang.
$app->locale::load('dictionary-a','dictionary-b'...,'dictionary-x')
```
