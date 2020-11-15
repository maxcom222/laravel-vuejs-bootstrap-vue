<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'user_id', 'description'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string', 'description' => 'text'
    ];

    /**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id', 'id', 'user');
	}
}
