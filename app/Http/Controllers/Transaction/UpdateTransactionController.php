<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\UpdateRequest;
use App\Models\Transaction;

class UpdateTransactionController extends BaseController
{
    public function __invoke(UpdateRequest $request, $id)
    {
        $data = $request->validated();
        $this->service->update($id, $data);
    }
}
