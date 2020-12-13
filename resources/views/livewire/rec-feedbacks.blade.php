<div class="flex pt-2 text-2xl">
    <div class="block uppercase tracking-wide text-indigo-700 text-lg font-bold pt-1 pr-4">
        Do you like the recommendation?
    </div>
    <div>
        @if(!$this->liked)
        <button wire:click="like" type="submit"><i class="text-indigo-700 far fa-thumbs-up pr-3"></i></button>
        @else
        <button wire:click="undo" type="submit"><i class="text-indigo-700 fas fa-thumbs-up pr-3"></i></button>
        @endif

        @if(!$this->disliked)
        <button wire:click="dislike" type="submit"><i class="text-indigo-700 far fa-thumbs-down"></i></button>
        @else
        <button wire:click="undo" type="submit"><i class="text-indigo-700 fas fa-thumbs-down"></i></button>
        @endif
    </div>
</div>