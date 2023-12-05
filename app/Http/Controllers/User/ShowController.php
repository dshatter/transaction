<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class ShowController extends Controller
{

    public function __invoke(User $user)
    {
        $transactions = $user->wallet->transactions;
        return view('user.show', compact('user', 'transactions'));
    }

}
