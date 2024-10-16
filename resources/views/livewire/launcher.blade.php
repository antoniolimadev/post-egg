<div
    x-data @click.away="$wire.relaunch()"
    class="pe-c-launcher"
>

    <p>
        <input
            type="text"
            wire:model.live.debounce="title"
            placeholder="Post it..."
        >
    </p>

    <p>
        <textarea
            wire:model.live.debounce="description"
            placeholder="Description"
            rows="5"
        ></textarea>
    </p>

    <div x-data="{ isVisible: @entangle('canBeDiscarded') }" style="position: relative;">
        <a
            wire:click="discard"
            x-show="isVisible"
            class="pe-c-launcher__discard"
        >
            <i class="fa fa-trash-alt"></i>
        </a>
    </div>

</div>
