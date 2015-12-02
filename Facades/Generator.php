<?php 

namespace Vitlabs\GUICore\Facades;

use Illuminate\Support\Facades\Facade;

class Generator extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'Vitlabs\GUICore\Contracts\Generator';
    }
    
}
