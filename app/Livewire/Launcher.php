<?php

namespace App\Livewire;

use App\Enums\NoteEvent;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Launcher extends Component
{
    public string $title = '';
    public string $description = '';
    public Note $currentNote;
    public ?int $currentNoteId = null;
    public bool $canBeDiscarded = false;

    public function updated($field, $value)
    {
        if(! $this->currentNoteId) {
            $this->currentNote = new Note;
            $this->currentNote->user_id = Auth::id();
        }

        if ($field === 'title') {
            $this->currentNote->title = $value;
        }

        if ($field === 'description') {
            $this->currentNote->description = $value;
        }

        $this->canBeDiscarded = ! ($this->title == '' && $this->description == '');

        $this->currentNote->save();
        $this->currentNoteId = $this->currentNote->id;
    }

    public function discard()
    {
        $this->currentNote->delete();
        $this->currentNoteId = null;
        $this->reset('title', 'description');
        $this->canBeDiscarded = false;
    }

    public function relaunch()
    {
        $this->dispatch(NoteEvent::CREATED->value);

        $this->currentNote = new Note;
        $this->currentNoteId = null;
        $this->reset('title', 'description');
        $this->canBeDiscarded = false;
    }

    public function render(): View
    {
        return view('livewire.launcher');
    }
}
