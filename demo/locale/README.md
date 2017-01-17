# locale

This is the folder where multilang support files live.

It is clasified by language for convenience so that the core library `Locale` can load the required dictionaries of one or another lang.

```php
// configure lang for current user
$app->locale->lang = 'es-ES';

// load dictionaries for current method or process
$app->locale::load('dictionary-a','dictionary-b'...,'dictionary-x')
```
