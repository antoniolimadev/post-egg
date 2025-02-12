<div class="pe-c-note__global_container">
    @foreach($userNotes as $note)
        <livewire:note :note="$note" :key="$note->id" />
    @endforeach
</div>
