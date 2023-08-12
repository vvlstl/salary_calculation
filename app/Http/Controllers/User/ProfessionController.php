<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\User\ProfessionResourse;
use App\Models\Profession;

class ProfessionController extends BaseController
{
    public function __invoke()
    {
        $professions = Profession::all();
        return ProfessionResourse::collection($professions);
    }
}
