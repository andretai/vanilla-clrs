@extends('ms.layouts.app')

@section('content')
  <div>
    <div class="px-6 pt-6 pb-3 flex justify-between items-center">
      <p class="font-semibold text-3xl">Manage Promotions</p>
      <div class="flex items-center">
        <p class="mr-6">{{ sizeof($promotions) }} records</p>
        <a href="{{route('ms-add', ['item_type' => 'promotion'])}}">
          <button class="px-3 py-2 rounded-sm bg-green-500 text-white">New Promotion</button>
        </a>
      </div>
    </div>
    @livewire('ms.search-promotions')
  </div>
@endsection