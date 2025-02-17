<?php

namespace App\Livewire;

use App\Enums\NoteEvent;
use Livewire\Component;

class Note extends Component
{
    public \App\Models\Note $note;

    public function deleteMe()
    {
        $this->note->delete();

        $this->dispatch(NoteEvent::DESTROYED->value);
    }

    public function edit()
    {
        $this->dispatch(NoteEvent::EDIT->value, $this->note);
    }

    public function render()
    {
        return view('livewire.note');
    }
}
