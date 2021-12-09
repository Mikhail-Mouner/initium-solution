<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
