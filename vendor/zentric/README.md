# vendor/zentric

Core and component libraries are located at `vendor/zentric`.

You can read and understand the core Zentric libraries in less than an hour.

## Core

	- `App.php`
	- `Locale.php`
	- `Navigation.php`
	- `Request.php`
	- `Response.php`
	- `Storage.php`
	- `View.php`

## Components (in progress)

	- `Calendar.php` (in progress)
	- `etc.`

## Composer configuration

The installation structure is intended to be compatible with composer configurations altough, by now, zentric is only available by download, not by packagist site.

I prefer define all folders for "App" namespace in file composer.json 
as an array of paths, so that it is not necessary include a "Use" 
sentence every time.

So, instead of:

```
Use App\Controllers\DefaultController;
$controller = new DefaultController();
```

I can code:

```
$controller = new DefaultController();
```

This is the current autoload PSR-4 configuration:	

```
{
	"name": "Zentric",
	"description": "Zentric PHP Framework",
	"autoload": {
		"psr-4": {
			"Zentric\\": "vendor/zentric",
			"App\\": ["demo", "demo/src"]
		}			
	}
} 
```
 