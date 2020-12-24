@extends('layouts.app')

@section('content')
<div class="bg-indigo-700 px-32 p-10 flex justify-center">
    <h2 class="text-4xl text-white font-semibold pt-8 ">Continuous Learning Recommendation System</h2>
</div>
@livewire('rec-m-fav')
@livewire('rec-review')
@livewire('rec-fav')
@livewire('rec-category')

@endsection