<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tv extends Model
{
    use HasUuids;
    use HasFactory;
    protected $table = "tv";
    protected $guarded = ['id'];

    public function episode()
    {
        return $this->hasMany(Episode::class);
    }
}
