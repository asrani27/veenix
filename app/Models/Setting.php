<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasUuids;
    use HasFactory;
    protected $table = "setting";
    protected $guarded = ['id'];
    public $timestamps = false;
}
