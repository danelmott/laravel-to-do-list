<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory, HasUuids;

    protected function casts(): array
    {
        return [
            'title' => 'string',
            'description' => 'string',
            'completed' => 'boolean'
        ];
    }

    protected $fillable = [
        "title",
        "description"
    ];

    protected $hidden = [
        ""
    ];


    public function user(): BelongsTo{
        return $this->BelongsTo(User::class);
    }

}
