<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const WRITE_OFF = 0;
    const REPLENISH = 1;

    protected $guarded = [];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id', 'id');
    }

    public static function getOperationTypes()
    {
        return [
            self::WRITE_OFF => 'Списание',
            self::REPLENISH => 'Пополнение',
        ];
    }
}
