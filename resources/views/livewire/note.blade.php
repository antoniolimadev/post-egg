<div
    x-data="{ deleteButtonIsVisible: false }"
    x-on:mouseenter="deleteButtonIsVisible=true"
    x-on:mouseleave="deleteButtonIsVisible=false"
    wire:click="edit()"
    class="pe-c-note__wrapper"
>
    <div class="pe-c-note">
        <p class="pe-c-note__title pe-l-clamp pe-l-clamp--limit-1">
            {{ $note->title }}
        </p>
        <p class="pe-c-note__description">
            {!! nl2br(strip_tags($note->description)) !!}
        </p>
    </div>

    <div
        x-show="deleteButtonIsVisible"
        x-transition
        wire:click.stop="deleteMe"
        class="pe-c-note__delete"
        title="Delete"
    >
        <i class="fa fa-circle-xmark"></i>
    </div>
</div>
