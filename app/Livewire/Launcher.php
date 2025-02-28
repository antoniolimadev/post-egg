<?php

namespace App\Livewire;

use App\Enums\NoteEvent;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class Launcher extends Component
{
    public string $title = '';
    public string $description = '';
    #[Locked]
    public Note $currentNote;
    #[Locked]
    public ?int $currentNoteId = null;
    public bool $canBeDiscarded = false;
    public bool $editMode = false;

    public function updated($field, $value)
    {
        $this->validate();

        if(! $this->currentNoteId) {
            $this->authorize('create', Note::class);

            $this->currentNote = new Note;
            $this->currentNote->user_id = Auth::id();
        }

        $this->authorize('update', $this->currentNote);

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
        $this->authorize('delete', $this->currentNote);

        $this->resetErrorBag();
        $this->currentNote->delete();
        $this->currentNoteId = null;
        $this->reset();
        $this->canBeDiscarded = false;
    }

    public function archive()
    {
        $this->authorize('archive', $this->currentNote);

        $this->currentNote->archive();
        $this->currentNoteId = null;
        $this->reset();
        $this->canBeDiscarded = false;
        $this->editMode = false;

        $this->dispatch(NoteEvent::ARCHIVED->value);
    }

    public function relaunch()
    {
        $this->resetErrorBag();

        $this->dispatch(NoteEvent::CREATED->value);

        $this->currentNote = new Note;
        $this->currentNoteId = null;
        $this->reset();
        $this->canBeDiscarded = false;
        $this->editMode = false;
    }

    #[On(NoteEvent::EDIT->value)]
    public function editNote(Note $note): void
    {
        $this->currentNote = $note;
        $this->currentNoteId = $note->id;
        $this->title = $note->title ?? '';
        $this->description = $note->description ?? '';
        $this->canBeDiscarded = true;
        $this->editMode = true;
    }

    protected function rules()
    {
        return [
            'title' => 'max: 200',
            'description' => 'max: 20000',
        ];
    }

    public function render(): View
    {
        return view('livewire.launcher');
    }
}
