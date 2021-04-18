<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'old_balance', 'new_balance', 'value', 'useraccount_id', 'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' =>  'datetime:d/m/Y H:i',
        'updated_at' =>  'datetime:d/m/Y H:i',
    ];

    /**
     * Get the user that owns the account.
     */
    public function userAccount()
    {
        return $this->belongsTo(UserAccount::class);
    }
}
