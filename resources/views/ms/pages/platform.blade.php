@extends('ms.layouts.app')

@section('content')
  <div>
    <div class="px-6 pt-6 pb-3 flex justify-between items-center">
      <p class="font-semibold text-3xl">Manage Platforms</p>
      <div class="flex items-center">
        <p class="mr-6">{{ sizeof($platforms) }} records</p>
        <a href="{{route('ms-add', ['item_type' => 'platform'])}}">
          <button class="px-3 py-2 rounded-sm bg-green-500 text-white">New Platform</button>
        </a>
      </div>
    </div>
    @livewire('ms.search-platforms')
  </div>
@endsection