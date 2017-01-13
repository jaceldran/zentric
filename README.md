# Zentric 

Super simple PHP Framework. 

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

This is my current autoload PSR-4 configuration:	

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
 