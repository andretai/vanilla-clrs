@extends('layouts.app')

@section('content')
<div class="bg-indigo-700 px-32 p-10 flex justify-center">
    <h2 class="text-4xl text-white font-semibold pt-8 ">Continuous Learning Recommendation System</h2>
</div>
@foreach($rec as $r)
    @if($r->key=="mFav")
    @livewire('rec-m-fav')

    @elseif($r->key=="recReview")
    @livewire('rec-review')

    @elseif($r->key=="recFav")
    @livewire('rec-fav')

    @elseif($r->key=="recTag")
    @livewire('rec-tag')

    @elseif($r->key=="recCategory")
    @livewire('rec-category')


    @endif

@endforeach


@endsection