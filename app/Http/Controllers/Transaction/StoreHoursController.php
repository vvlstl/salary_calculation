<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Requests\Transaction\StoreHoursRequest;

class StoreHoursController extends BaseController
{
    public function __invoke(StoreHoursRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);
    }
}
