<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class CreateController extends Controller
{
    public function __invoke(int $walletID)
    {
        $transactionTypes = Transaction::getOperationTypes();
        return view('transaction.create', compact('walletID', 'transactionTypes'));
    }
}
