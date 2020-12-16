@extends('ms.layouts.app')

@section('content')
<div class="m-6">
  <p class="font-sans text-4xl">Settings</p>
  <div class="flex my-6">
    <a href="{{ route('ms-sets-seed') }}" class="mr-6">Seed</a>
    |
    <a href="{{ route('ms-sets-recommend') }}" class="mx-6 font-semibold">Recommendation</a>
    |
    <button class="mx-6">Miscellaneous</button>
  </div>
  <div class="grid grid-cols-4 col-gap-3 row-gap-6">
    @foreach ($results as $result)
      <div class="p-6 border border-gray-500 rounded-md shadow-md capitalize">
        <p class="font-semibold text-xl">{{$result->name}}</p>
        <p class="text-gray-700">{{$result->type}}</p>
        <div class="flex items-baseline">
          <p 
            @if ($result->ratio < 75)
              class="font-semibold text-red-600 text-3xl"
            @else
              class="font-semibold text-blue-600 text-3xl"
            @endif
          >
            {{$result->ratio}}%
          </p>
          <p class="ml-3">positive</p>
        </div>
        <p class="text-sm">in {{$result->positive}} out of {{$result->count}} ratings</p>        
      </div>
    @endforeach
  </div>
  <hr class="mt-8">
  <div class="mt-6 capitalize">
    <p class="mb-6 font-semibold text-xl">Manage Recommendation</p>
    @php
      $count = 1;  
    @endphp
    <div class="flex px-6 font-semibold text-center">
      <div class="flex w-11/12">
        <p class="w-1/12">no</p>
        <p class="w-3/12">type</p>
        <p class="w-6/12">name</p>
        <p class="w-2/12">order</p>
      </div>
      <div class="w-1/12">
        <p>actions</p>
      </div>
    </div>
    @foreach ($recommendations as $rec)
      <div class="flex justify-between items-center my-3 px-6 py-3 border border-gray-500 rounded-md shadow-sm">
        <div class="flex w-11/12">
          <p class="w-1/12 text-center">{{ $count }}</p>
          <p class="w-3/12">{{ $rec->type }}</p>
          <p class="w-6/12">{{ $rec->name }}</p>
          <p class="w-2/12 text-center">{{ $rec->order }}</p>
        </div>
        <div class="grid grid-cols-2 w-1/12">
          <a href="{{ route('ms-sets-recommend-move', ['rec_id' => $rec->id, 'action' => 'up'])}}">
            <img src="/images/top.png" class="w-6"/>
          </a>
          <a href="{{ route('ms-sets-recommend-move', ['rec_id' => $rec->id, 'action' => 'down'])}}">
            <img src="/images/top.png" class="w-6 transform rotate-180"/>
          </a>
          {{-- <a href="{{ route('ms-sets-recommend-move', ['rec_id' => $rec->id, 'action' => 'top'])}}">
            <img src="/images/top.png" class="w-6"/>
          </a>
          <a href="{{ route('ms-sets-recommend-move', ['rec_id' => $rec->id, 'action' => 'bottom'])}}">
            <img src="/images/top.png" class="w-6 transform rotate-180"/>
          </a> --}}
        </div>
      </div>
      @php
          $count++;
      @endphp
    @endforeach
  </div>
</div>
@endsection