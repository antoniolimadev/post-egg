<div style="display: flex; flex-wrap: wrap;">
    @foreach($userNotes as $note)
        <div class="pe-c-note__wrapper">
            <div class="pe-c-note">
                <p class="pe-c-note__title pe-l-clamp pe-l-clamp--limit-1">
                    {{ $note->title }}
                </p>
                <p class="pe-c-note__description">
                    {{ $note->description }}
                </p>
            </div>
        </div>
    @endforeach
</div>
