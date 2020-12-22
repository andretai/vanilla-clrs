@extends('ms.layouts.app')

@section('content')
<div class="m-6">
  <p class="font-sans text-4xl">Settings</p>
  <div class="flex">
    <div class="flex items-center my-4 mr-3 px-3 py-1 border border-gray-500 rounded-lg"">
      <svg class="w-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5.33 12.77A4 4 0 1 1 3 5.13V5a4 4 0 0 1 5.71-3.62 3.5 3.5 0 0 1 6.26 1.66 2.5 2.5 0 0 1 2 2.08 4 4 0 1 1-2.7 7.49A5.02 5.02 0 0 1 12 14.58V18l2 1v1H6v-1l2-1v-3l-2.67-2.23zM5 10l3 3v-3H5z"/></svg>
      <a href="{{ route('ms-sets-seed') }}" class="mr-6">Seed</a>
    </div>
    <div class="flex items-center my-4 mr-3 px-3 py-1 border-2 border-green-500 rounded-lg"">
      <svg class="w-4 mr-3 text-blue-500 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 0h1v3l3 7v8a2 2 0 0 1-2 2H5c-1.1 0-2.31-.84-2.7-1.88L0 12v-2a2 2 0 0 1 2-2h7V2a2 2 0 0 1 2-2zm6 10h3v10h-3V10z"/></svg>
      <a href="{{ route('ms-sets-recommend') }}" class="">Recommendation</a>
    </div>
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
    <div class="flex mb-6 items-center justify-between">
      <p class="font-semibold text-xl">Manage Recommendation</p>
      @if (isset($status))
        <div class="flex items-center font-semibold capitalize">
          @if ($status)
            <div class="w-1/12">
              <img class="w-24" src="/images/checked.png" alt="">
            </div>
            <p class="w-11/12 ml-3 text-green-500">Operation completed.</p>
          @else
            <div class="w-1/12">
              <img class="w-24" src="/images/wrong.png" alt="">
            </div>
            <p class="w-11/12 ml-3 text-red-500">Operation failed.</p>
          @endif
        </div>
      @endif
    </div>
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