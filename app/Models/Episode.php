<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episode extends Model
{
    use HasUuids;
    use HasFactory;
    protected $table = "episode";
    protected $guarded = ['id'];

    public function tvseries()
    {
        return $this->belongsTo(Tv::class, 'tv_id', 'id');
    }
}
