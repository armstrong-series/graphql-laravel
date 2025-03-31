<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Task extends Model
{
    use HasUuids;


    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['id', 'title', 'status', 'description', 'due_date', 'user_id'];



    public function user()
    {
        return $this->belongsTo(User::class); 
    }
}
