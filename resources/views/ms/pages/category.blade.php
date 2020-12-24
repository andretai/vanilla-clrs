@extends('ms.layouts.app')

@section('content')
  <div>
    <div class="px-6 pt-6 pb-3 flex justify-between items-center">
      <div class="flex">
        <svg class="w-8 mr-3 fill-current text-green-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M16 16v2H4v-2H0V4h4V2h12v2h4v12h-4zM14 5.5V4H6v12h8V5.5zm2 .5v8h2V6h-2zM4 6H2v8h2V6z"/></svg>
        <p class="font-semibold text-xl">Categories Management</p>
      </div>
      <div class="flex items-center">
        <p class="mr-6">{{ sizeof($categories) }} records</p>
        <a href="{{route('ms-add', ['item_type' => 'category'])}}">
          <button class="flex items-center px-3 py-2 rounded-sm bg-green-500 text-white">
            <svg class="w-4 mr-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/></svg>
            <p class="text-sm">New Category</p>
          </button>        
        </a>
      </div>
    </div>
    @livewire('ms.search-categories')
  </div>
@endsection