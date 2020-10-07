@extends('ms.layouts.app')

@section('content')
  <div>
    <div class="px-6 pt-6 pb-3 flex justify-between items-center">
      <p class="font-semibold">Platforms</p>
      <div class="flex items-center">
        <p class="mr-6">5 records</p>
        <a href="{{route('ms-add', ['item_type' => 'platform'])}}">
          <button class="px-3 py-2 rounded-sm bg-green-500 text-white">New Platform</button>
        </a>
      </div>
    </div>
    <div class="p-6 flex">
      <p class="mr-6">Search</p>
      <input class="border border-gray-500" type="text" name="query" id="query">
    </div>
    <div class="min-h-screen p-6 bg-gray-200">

    </div>
  </div>
@endsection