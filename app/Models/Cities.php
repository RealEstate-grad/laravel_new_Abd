<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function places()
        {
            return $this->hasMany(Places::class);

        }
        public function estate()
        {
            return $this->hasMany(Estate::class);

        }

}
