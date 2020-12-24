@extends('ms.layouts.app')

@section('content')
  <div>
    <div class="px-6 pt-6 pb-3 flex justify-between items-center">
      <div>
        <div class="flex">
          <svg class="w-8 mr-3 fill-current text-red-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M6 4H5a1 1 0 1 1 0-2h11V1a1 1 0 0 0-1-1H4a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V5a1 1 0 0 0-1-1h-7v8l-2-2-2 2V4z"/></svg>
          <p class="font-semibold text-xl">Course Management</p>
        </div>
        @if (isset($status))
          <div class="flex items-center mt-6 ml-1 font-semibold capitalize">
            @if ($status)
              <div class="">
                <img class="w-6" src="/images/checked.png" alt="">
              </div>
              <p class="ml-3 text-green-500">Delete successful.</p>
            @else
              <div class="">
                <img class="w-6" src="/images/wrong.png" alt="">
              </div>
              <p class="ml-3 text-red-500">Delete unsuccessful.</p>
            @endif
          </div>
        @endif
      </div>
      <div class="flex items-center">
        <p class="mr-6">{{ sizeof($courses) }} records</p>
        <a href="{{route('ms-add', ['item_type' => 'course'])}}">
          <button class="flex items-center px-3 py-2 rounded-sm bg-green-500 text-white">
            <svg class="w-4 mr-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/></svg>
            <p class="text-sm">New Course</p>
          </button>
        </a>
      </div>
    </div>
    @livewire('search-courses')
  </div>
@endsection