<?php

Route::any('{slug?}')
    ->uses(\Aheenam\Mozhi\RequestHandler::class)
    ->name('mozhi.page')
    ->where('slug', '.*');
