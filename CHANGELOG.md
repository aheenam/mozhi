CHANGELOG
===

This changelog contains all notable change of the mozhi package

0.4.0
---
- drops support for Laravel 5.6
- adds Laravel 5.8 support
- Refactoring of the template renderer
- Inject a markdown parser, this way it can now be swapped out

### Breaking changes

- The Route Resolver has been modified. Every page has to live in its own directory now. The URL `/blog` should have a `contents/blog/blog.md` while previously `contents/blog.md` was enough. (https://github.com/aheenam/mozhi/pull/18)

0.3.0
---
- adds support for Laravel 5.6

0.2.0
---

This release adds the feature that there can be additional routes to the Mozhi routes. Before this version, every route would be automatically caught by Mozhi and passed to Mozhi's frontend controller. Now it is up to you to define this.

Upgrade Guide
---

If you are upgrading from a version `< 0.2.0` then make sure that you add `Mozhi::routes()` to the `map()` function of your RouteServiceProvider.

```php
<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Mozhi;

...

/**
 * Define the routes for the application.
 *
 * @return void
 */
public function map()
{
    $this->mapApiRoutes();

    $this->mapWebRoutes();

    Mozhi::routes();
}
```

0.1.2
---
Fixes that the `config` helper does not work in a ServiceProvider

0.1.1
---
This release fixes the issue that the base route / was not caught by the Controller. Now the RouteResolver will look for a index.md file in the root directory of the contents.

0.1.0: Initial release
---

This is the first release just having the basic feature implemented:

1. Catch all routes and render the appropriate template.