<?php

namespace App\Livewire;

use App\Enums\NoteEvent;
use App\Models\Note;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class NoteContainer extends Component
{
    public Collection $userNotes;

    public function refreshNotes(): void
    {
        $this->userNotes = Note::query()
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();
    }

    #[On(NoteEvent::CREATED->value)]
    public function newNote(): void
    {
        $this->refreshNotes();
    }

    public function mount()
    {
        $this->refreshNotes();
    }

    public function render()
    {
        return view('livewire.note-container');
    }
}
