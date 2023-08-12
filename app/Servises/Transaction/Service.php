<?php

namespace App\Servises\Transaction;

use App\Models\Transaction;

class Service
{
    public function store($data)
    {
        Transaction::create($data);
        return response([]);
    }

    public function update($id, $data){
        $transaction = Transaction::find($id);
        $transaction->update($data);
        return response([]);

    }
}
