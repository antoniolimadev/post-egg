<?php

namespace App\Livewire;

use App\Enums\NoteEvent;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Note extends Component
{
    #[Reactive]
    public \App\Models\Note $note;

    public function mount(\App\Models\Note $note)
    {
        $this->note = $note;
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
