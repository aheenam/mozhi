<?php

Route::any('{slug?}')
    ->uses(\Aheenam\Mozhi\Controllers\RequestHandler::class)
    ->name('mozhi.page')
    ->where('slug', '.*');
