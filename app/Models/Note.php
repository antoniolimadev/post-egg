<?php

namespace App\Models;

use App\Models\Scopes\SessionScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

#[ScopedBy([SessionScope::class])]
class Note extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'archived_at',
        'session_id',
    ];

    protected static function booted(): void
    {
        static::created(function (Note $note) {
            $note->update([
                'session_id' => session()->getId(),
            ]);
        });

    }

    public function archive(): void
    {
        $this->update([
            'archived_at' => Carbon::now(),
        ]);
    }
}
