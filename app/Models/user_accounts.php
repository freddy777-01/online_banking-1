<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_accounts extends Model
{
    use HasFactory;
    protected $table = 'user_accounts';

    public function accounts()
    {
        return $this->hasMany(accounts::class);
    }
}
