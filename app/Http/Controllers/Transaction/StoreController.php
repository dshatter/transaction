<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\Request;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $newTransaction = Transaction::create($data);
            $changedWallet = $this->makeOperation($newTransaction);

            DB::commit();

        } catch (Exception $exception) {

            DB::rollBack();

            abort('500');

        }
        return redirect(route('users.show', $changedWallet->user->id));
    }

    public function makeOperation($transaction): Wallet
    {
        $wallet = $transaction->wallet()->get()->first();
        $walletBalance = $wallet->balance;

        if ((int) $transaction->type === (int) Transaction::WRITE_OFF) {
            $wallet->balance -= $transaction->amount;
        } elseif ((int) $transaction->type === (int) Transaction::REPLENISH) {
            $wallet->balance += $transaction->amount;
        }

        $wallet->save();
        return $wallet;
    }
}
