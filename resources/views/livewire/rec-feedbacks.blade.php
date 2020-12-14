<div class="flex pt-2 text-2xl">
    <div class="block uppercase tracking-wide text-indigo-700 text-lg font-bold pt-1 pr-4">
        Do you like the recommendation?
    </div>
    <div class="pr-10">
        @if(!$this->liked)
        <button class="focus:outline-none" wire:click="like" type="submit"><i class="text-indigo-700 hover:text-indigo-500 far fa-thumbs-up pr-3"></i></button>
        @else
        <button class="focus:outline-none" wire:click="undo" type="submit"><i class="text-indigo-700 hover:text-indigo-500 fas fa-thumbs-up pr-3"></i></button>
        @endif

        @if(!$this->disliked)
        <button class="focus:outline-none" wire:click="dislike" type="submit"><i class="text-indigo-700 hover:text-indigo-500 far fa-thumbs-down"></i></button>
        @else
        <button class="focus:outline-none" wire:click="undo" type="submit"><i class="text-indigo-700 hover:text-indigo-500 fas fa-thumbs-down"></i></button>
        @endif
    </div>
    <div>
        @if(session()->has('review'))
        <div class="items-center bg-indigo-700 rounded-md text-white text-sm font-bold px-4 py-2">
            {{session('review')}}
        </div>
        @elseif(session()->has('undo'))
        <div class="items-center bg-indigo-700 rounded-md text-white text-sm font-bold px-4 py-2">
            {{session('undo')}}
        </div>
        @endif
        
    </div>
</div>