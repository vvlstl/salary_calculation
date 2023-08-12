<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Resources\Transaction\TransactionResourse;
use App\Models\Transaction;

class TransactionController extends BaseController
{
    public function __invoke()
    {
        $transactions = Transaction::all();
        return TransactionResourse::collection($transactions);
    }
}
