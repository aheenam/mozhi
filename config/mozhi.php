<?php

return [

    /*
     * The name of the disk Laravel's filesystem should use to search
     * for the content files. Mozhi expects a content directory inside of
     * the disk where the contents a located
     *
     * Default is set to local, that means storage_path('app/')
     * will be used to look for a contents directory
     */
    'content_disk' => env('MOZHI_CONTENT_DISK', 'local'),

    /*
     * the path where the themes are located, must be relative to the
     * base_path
     */
    'theme_path' => env('MOZHI_THEME_PATH', 'resources/themes/'),

    /*
     * The name of the theme that should be used to render the views
     */
    'theme' => env('MOZHI_THEME', 'default'),

    /*
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
