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
  <div class="mt-6">
    @php
      $count = 1;  
    @endphp
    @foreach ($recommendations as $rec)
      <div class="flex justify-between items-center my-3 p-3 border border-gray-500 rounded-sm">
        <div class="flex">
          <p class="mr-6">{{ $count }}</p>
          <p class="mr-6">{{ $rec->name }}</p>
          <p class="mr-6">{{ $rec->type }}</p>
          <p class="mr-6">order {{ $rec->order }}</p>
        </div>
        <div class="grid grid-cols-4 col-gap-3">
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