<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\StoreRequest;

class StoreUserController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        return $this->service->store($data);
    }
}

