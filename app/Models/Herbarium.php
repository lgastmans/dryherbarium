<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class Herbarium extends Model
{
    use HasFactory;

    protected $table = 'herbarium';

    protected $fillable = [
        'family_id','place_id','taluk_id','district_id','state_id','genus_id','status_id','collector1_id','collector2_id','collector3_id','specific_id',
        'collection_number','herbarium_number','vernacular_name','quantity_main','quantity_duplicate','quantity_lent','notes','collected_on','latitude','longitude','altitude','habit','description','association','frequency','micro_habitat','leaf','phenology','flower','fruit','seeds','forest'
    ];


    
    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }    

    public function genus(): BelongsTo
    {
        return $this->belongsTo(Genus::class);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function taluk(): BelongsTo
    {
        return $this->belongsTo(Taluk::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function specific(): BelongsTo
    {
        return $this->belongsTo(Specific::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }


    public function collector1(): BelongsTo
    {
        return $this->belongsTo(Collector::class);
    }

    public function collector2(): BelongsTo
    {
        return $this->belongsTo(Collector::class);
    }

    public function collector3(): BelongsTo
    {
        return $this->belongsTo(Collector::class);
    }

}