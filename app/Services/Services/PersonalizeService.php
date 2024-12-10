<?php

namespace App\Services\Services;

use App\Repositories\PersonalizeRepository;
use App\Services\Contracts\PersonalizeContract;

class PersonalizeService  implements PersonalizeContract
{
    protected PersonalizeRepository $personalizeRep;
    public function __construct()
    {
        $this->personalizeRep = new PersonalizeRepository();
    }

    public function updatePersonalize($id, $data)
    {
        return $this->personalizeRep->updatePersonalize($id, $data);
    }
}
