<div>
<button wire:click="create()" class=" focus:outline-none text-lg font-semibold pt-3  lg:mt-0 text-indigo-700 hover:text-indigo-500">[Example of Review]</button>

@if($isOpenReview)
    @include('livewire.guideline-review')
@endif

</div>
