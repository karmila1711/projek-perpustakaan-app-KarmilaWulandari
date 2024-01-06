<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Books extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $table    = "books";
    protected $fillable = [
        'id',
        'book_name',
        'author_id',
        'published_at',
        'created_at',
        'updated_at'
    ];

    public function author()
    {
        return $this->belongsTo(Authors::class, 'author_id', 'author_id');
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/books/' . $value),
        );
    }
}
