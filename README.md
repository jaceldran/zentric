# Zentric 

**Zentric** is my super simple PHP Framework.

It relies on some basic aims (no dogmatic rules)

- The less core libraries, the better. Because it is fine to fully understand what is happening behind the scene.
- This is an agnostic framework for coding from scratch because I love coding. You can, of course, integrate and reuse any third-party or your own plugins or libraries.
- Simple and readable configuration files are fine for most cases. Put there as many information as possible and maintain well organized.

## Core libraries

Core libraries are located at `vendor/zentric`.

You can read and understand the core Zentric libraries in less than an hour.

	- `App.php`
	- `Locale.php`
	- `Navigation.php`
	- `Request.php`
	- `Response.php`
	- `Storage.php`
	- `View.php`

## Demo application

Everything is easier to understand with a working demo. 

Folder "demo" contains the sources for a full demo application with most of standar components which are clasified by subfolders:

- **config** all confguration files.
- **content** static contents.
- **locale** dictionary files for multilang support.
- **src** application scripts like controllers, utilities, etc.
- **templates** template files.

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
 