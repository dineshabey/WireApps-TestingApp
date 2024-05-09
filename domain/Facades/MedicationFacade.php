<?php

namespace domain\Facades;

use domain\Services\MedicationService;
use Illuminate\Support\Facades\Facade;

class MedicationFacade extends Facade
{

    protected static function getFacadeAccessor()
    {

        return MedicationService::class;
    }
}
