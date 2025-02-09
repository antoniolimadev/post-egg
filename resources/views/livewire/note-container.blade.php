<div style="display: flex; flex-wrap: wrap;">
    @foreach($userNotes as $note)
        <livewire:note :note="$note" :key="$note->id" />
    @endforeach
</div>
