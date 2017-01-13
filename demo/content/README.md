# Content

This is the folder where **static** content for pages live.

It is clasified by language for convenience. So, any content can be loaded using `Zentric\View` class:

```php
View::load( CONTENT . '/' . LANG . '/the-content.html')
```

Or, if you don't plan multilang support, you don't need subfolders.

```php
View::load( CONTENT .  '/the-content.html')
```