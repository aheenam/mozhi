*Do not use in production yet*

Mozhi
===

The package provides a simple way to add a static files based CMS to your Laravel project. It uses Markdown files as the content provider and uses Laravel's Blade for templating.

Installation
---
You can install the package via composer:

```bash
composer require aheenam/mozhi
```

Configuration
---

Mozhi comes with a set of configuration possibilities, so make sure to check the config file's content:

```php
<?php

return [

    /**
     * The name of the disk Laravel's filesystem should use to search
     * for the content files. Mozhi expects a content directory inside of
     * the disk where the contents a located
     *
     * Default is set to local, that means storage_path('app/')
     * will be used to look for a contents directory
     */
    'content_disk' => env('MOZHI_CONTENT_DISK', 'local'),

    /**
     * the path where the themes are located, must be relative to the
     * base_path
     */
    'theme_path' => env('MOZHI_THEME_PATH', 'resources/themes/'),

    /**
     * The name of the theme that should be used to render the views
     */
    'theme' => env('MOZHI_THEME', 'default'),

    /**
     * The name of the template that should be used if no template was defined
     * in the page's markdown file
     */
    'default_template' => env('MOZHI_DEFAULT_TEMPLATE', 'page'),

    /**
     * Add all the CommonMark extension you want to use
     */
    'markdown_extensions' => [
        new \Webuni\CommonMark\TableExtension\TableExtension()
    ]

];
```

All the keys are commented well enough, so the usage should not be too tough. If there is something not that clear, feel free to post an issue.

As you see all the config variables can be set using the env file, but if you want, you can also publish them to change the values.

```bash
$ php artisan vendor:publish --provider="Aheenam\Mozhi\MozhiServiceProvider"
```

Usage
---

After the setup all of your routes will be caught by Mozhi and the package will try to find the appropriate content file for it.

Consider the config as above and then a call to `/blog/awesome-blog`. Now Mozhi will look for a file in `storage/contents/blog/` that is named `awesome-blog.md`.

If it is found, it will render the specified template of the currenty theme and pass the content and the header of the markdown file.

The MarkDown files are parsed using Spatie's awesome package called [YAML Front Matter](https://github.com/spatie/yaml-front-matter) before parsing the markdown, so you can (and should decorate) your markdown files.

So in your template file you can use the `$content` and the `$meta` variables. First is the html of the content file and `$meta` is an array of all header data specified in the Markdown file.

> Note: If no template was specified it will fallback to the `default_theme` specified in the config.

### Parsing Markdown

Mozhi uses the CommonMark implementation of [The PHP League](https://github.com/thephpleague/commonmark) to parse Markdown to HTML. They offer a way to extend the specification. Mozhi uses the Table Extension by default, but you can manage all the extension by changing the `markdown_extensions` array in the config.

Changelog
---
Check [CHANGELOG](CHANGELOG.md) for the changelog

Testing
---
To run tests use

    $ composer test

Contributing
---


Security
---
If you discover any security related issues, please email rathes@aheenam.com or use the issue tracker of GitHub.

About
---
Aheenam is a small company from NRW, Germany creating custom digital solutions. Visit [our website](https://aheenam.com)
to find out more about us.

License
---
The MIT License (MIT). Please see [License File](https://github.com/Aheenam/laravel-translatable/blob/master/LICENSE)
for more information.