<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasUuids;
    use HasFactory;
    protected $table = "country";
    protected $guarded = ['id'];
    public $timestamps = false;
}
