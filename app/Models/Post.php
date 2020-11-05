<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'body' , 'user_id', 'slug',
    ];

    //TODO непонятно чегоне зочет работать
    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:s',
        'updated_at' => 'datetime:d/m/Y H:s',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
