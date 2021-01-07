@extends('ms.layouts.app')

@section('content')
  <div class="w-1/2 mx-auto mt-32 p-6 border border-gray-500 rounded-md shadow-md">
    <div class="flex justify-between items-center">
      <img class="w-1/5 p-3" src="/images/alarm.png" alt="">
      <div class="w-4/5 p-3">
        <p class=" font-semibold text-lg">
          {{-- Are you sure you want to delete {{ $item_type }} {{ $item_id }} ? --}}
          Are you sure you want to delete this {{ $item_type }} ?
        </p>
        <p class="font-semibold text-red-600 text-sm">
          Doing so will remove the {{$item_type}} and all of its data.
        </p>
      </div>
    </div>
    <div class="grid grid-cols-2 col-gap-6 px-12 pt-6 pb-3 text-white">
      <a class="py-1 bg-blue-500 border border-gray-300 rounded-lg text-center"
        @if ($item_type === 'category')
          href="{{ route('categories.delete', ['item_type' => $item_type, 'id' => $item_id]) }}"  
        @else
          href="{{ route($item_type.'s.delete', ['item_type' => $item_type, 'id' => $item_id]) }}"
        @endif
      >
        Yes
      </a>
      <a class="py-1 bg-red-500 border border-gray-300 rounded-lg text-center" href="{{ route('ms-edit', ['item_type' => $item_type, 'id' => $item_id]) }}">
        No
      </a>
    </div>
  </div>
@endsection