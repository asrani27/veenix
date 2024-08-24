<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Actor extends Model
{
    use HasUuids;
    use HasFactory;
    protected $table = "actor";
    protected $guarded = ['id'];
    public $timestamps = false;
}
