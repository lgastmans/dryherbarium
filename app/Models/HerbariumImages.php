<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HerbariumImages extends Model
{
    use HasFactory;

    protected $table = 'herbarium_images';

    protected $fillable = ['herbarium_id', 'filename'];

    public function herbarium(): BelongsTo
    {
        return $this->belongsTo(Herbarium::class);
    }    

}
