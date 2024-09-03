<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collector extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "surname"
    ];


    public function getDisplayCollectorAttribute()
    {
        return $this->name." ".(is_null($this->surname)? "" : $this->surname);
    }    
}
