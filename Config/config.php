<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Window Layout
    |--------------------------------------------------------------------------
    | Views hint can be used as "View::make('{SOME_HINT}::someView')"
    |
    */
	'viewsHint' => 'gui',

    /*
    |--------------------------------------------------------------------------
    | Window Layout
    |--------------------------------------------------------------------------
    | Path to assets on frontend. Relative to "public" directory.
    |
    */
    'assetsFrontendPath' => '/gui',

    /*
    |--------------------------------------------------------------------------
    | Window Layout
    |--------------------------------------------------------------------------
    | Path to assets on server. Usually absolute path.
    |
    */
	'assetsBackendPath' => public_path('gui'),

    /*
    |--------------------------------------------------------------------------
    | Window Layout
    |--------------------------------------------------------------------------
    | Tag for artisan. Can be used in artisan command
    | "vendor:publish --tag={SOME_TAG}"
    |
    */
	'publishesTag' => 'public',

    /*
    |--------------------------------------------------------------------------
    | Full Class Name to Generator Implementation
    |--------------------------------------------------------------------------
    | Example: App\Concrete\GUIGenerator
    |
    */
    'generatorImplementation' => '',
    /*
    |--------------------------------------------------------------------------
    | Basic Element Enabled
    |--------------------------------------------------------------------------
    | Determines whether is it possible to create element without contract.
    |
    */
    'basicElementEnabled' => false,

];