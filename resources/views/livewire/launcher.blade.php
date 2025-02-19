<div
    x-data="{ isFocused: false, editMode: @entangle('editMode') }"
    x-on:click.away="$wire.relaunch(); isFocused = false;"
    style="display: inline;"
>
    <div
        class="pe-c-launcher"
        :class="{'pe-c-launcher--edit-mode': editMode }">
        <p>
            <input
                type="text"
                wire:model.live.debounce="title"
                @focus="isFocused = true"
                placeholder="Post it..."
            >
        </p>

        <p>
            <textarea
                x-show="isFocused || editMode"
                x-transition.duration.300ms
                wire:model.live.debounce="description"
                placeholder="Description"
                rows="5"
                @input="resize($event)"
                :style="(! isFocused && ! editMode) && { height: 'auto' }"
            ></textarea>
        </p>

        <div
            x-data="{ canBeDiscarded: @entangle('canBeDiscarded') }"
            x-show="isFocused || editMode"
            class="pe-c-launcher__footer"
        >
            <span>
                <span>
                    <a
                        x-show="canBeDiscarded"
                        wire:click="discard"
                        title="Delete note"
                    >
                        <i class="fa fa-trash-alt"></i>
                    </a>
                </span>
            </span>


            @if($currentNote)
                <span
                    x-show="editMode"
                    class="pe-c-launcher__last_edit"
                >
                    Edited {{ Carbon::parse($currentNote->updated_at)->diffForHumans() }}
                </span>
            @endif

            <span>
                <a x-on:click="$wire.relaunch(); isFocused = false;">
                    Close
                </a>
            </span>

        </div>
    </div>

    <div
        x-show="editMode"
        x-transition:leave.duration.150ms
        @click="$wire.relaunch(); isFocused = false;"
        class="pe-c-launcher--edit-mode__background"
    ></div>

</div>
<script>
    function resize(event) {
        const textarea = event.target;

        if (textarea.offsetHeight < parseInt(getComputedStyle(textarea).maxHeight)) {
            textarea.style.height = `${textarea.scrollHeight}px`;
        }
    }
</script>
