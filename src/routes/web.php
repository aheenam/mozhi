<?php

Route::any('{slug?}')
    ->uses(\Aheenam\Mozhi\Controllers\FrontendController::class . '@show')
    ->name('mozhi.page')
    ->where('slug', '.*');