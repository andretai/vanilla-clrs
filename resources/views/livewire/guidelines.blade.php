<div>
<button wire:click="create()" class=" focus:outline-none text-lg block mt-8 mr-4 lg:mt-0 text-indigo-700 hover:text-indigo-600">How To Use</button>

@if($isOpenHome)
    @include('livewire.guideline-home')
@endif
@if($isOpenCourse)
    @include('livewire.guideline-course')
@endif
@if($isOpenFavourite)
    @include('livewire.guideline-fav')
@endif
@if($isOpenPromotion)
    @include('livewire.guideline-promotion')
@endif
</div>
