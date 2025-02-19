<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Note extends Model
{
    use HasFactory;

    public $fillable = [
        'archived_at',
    ];

    public function archive(): void
    {
        $this->update([
            'archived_at' => Carbon::now(),
        ]);
    }
}
