<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GenusImage extends Model
{
    use HasFactory;

    protected $fillable = [
        "genus_id", "filename"
    ];

    public function genus(): BelongsTo
    {
        return $this->belongsTo(Genus::class);
    }

}
