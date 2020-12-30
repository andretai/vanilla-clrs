@extends('layouts.app')

@section('content')
<div class="bg-indigo-700 px-32 p-10">
    <h2 class="text-4xl text-white font-semibold pt-8">Promotion</h2>
</div>
<div class="px-32 p-10">
    <div class="divide-y divide-black">
        @foreach($promotions as $promotion)
        <div class="flex py-3">
            <div class="pr-5">
                <img class="overflow-hidden h-auto w-64 object-cover" src="{{$promotion->image}}" :alt="">
            </div>
            <div class="px-5 w-3/5">
                <h2 class=" font-bold text-3xl capitalize text-gray-900">{{$promotion->platform}} Platform</h2>
                <div class="flex mt-1">
                    <p class="pr-5 font-semibold text-2xl">Promo Code:</p>
                    <p class="font-semibold text-orange-600 text-2xl">{{$promotion->code}}</p>
                </div>
                <p class="text-xl capitalize mb-5"> {{$promotion->description}}</p>
                <a href="{{$promotion->url}}" target="_blank" class="inline-block px-3 py-2 border rounded text-white bg-indigo-700 border-white hover:border-transparent hover:bg-indigo-500 lg:mt-0">Go to the Platform<i class="fas fa-info-circle ml-2"></i></a>

            </div>
        </div>
        @endforeach

    </div>
</div>
@livewire('newsletter')
@endsection