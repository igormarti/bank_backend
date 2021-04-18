<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    protected $table = 'useraccount';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number_account', 'agency', 'balance', 'user_id', 'status'
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transaction that owns the useraccount.
     */
    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
