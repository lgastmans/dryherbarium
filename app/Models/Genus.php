<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Genus extends Model
{
    use HasFactory;

    /**
     * for some reason table name had to be defined for this model
     * on the import command (app/console/commands/ImportGenus) the following error occured otherwise:
     * 
     *  Illuminate\Database\QueryException
     *   
     *  SQLSTATE[42S02]: Base table or view not found: 1146 Table 'avherbarium.genera' doesn't exist (Connection: mysql, SQL: insert into 
     *    `genera` (`genus`, `updated_at`, `created_at`) values (Ipomoea obscura (L.) Ker Gawler, 2024-05-15 03:58:26, 2024-05-15 03:58:26))
     *
     *  maybe because the column name is the same as the table name?
     */
    protected $table = 'genus';

    protected $fillable = [
        "name"
    ];

    public function images(): HasMany
    {
        return $this->hasMany(GenusImage::class);
    }

}
