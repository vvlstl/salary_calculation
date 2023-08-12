<?php

namespace App\Servises\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Service
{
    public function store($data)
    {
        $user = User::where('email', $data['email'])->first();
        if ($user) return response(['error' => 'User with is email already exist'], 403);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $token = auth()->tokenById($user->id);
        return response(['access_token' => $token]);
    }

    public function update($id, $data)
    {
        $transaction = User::find($id);
        $transaction->update($data);
        return response([]);

    }
}
