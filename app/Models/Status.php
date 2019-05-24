<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model{

    const ACTIVE = 1;
    const INACTIVE = 2;

    protected $table = 'status';
    protected $fillable = ['name'];
}
