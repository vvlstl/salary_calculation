<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\UpdateRequest;

class UpdateUserController extends BaseController
{
    public function __invoke(UpdateRequest $request, $id)
    {
        $data = $request->validated();
        $this->service->update($id, $data);
    }
}
