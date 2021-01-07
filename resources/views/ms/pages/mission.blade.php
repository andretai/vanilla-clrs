@extends('ms.layouts.app')

@section('content')
  <div>
    <div class="px-6 pt-6 pb-3 flex justify-between items-center">
      <div>
        <div class="flex">
          <svg class="w-8 mr-3 fill-current text-orange-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9 20v-1.7l.01-.24L15.07 12h2.94c1.1 0 1.99.89 1.99 2v4a2 2 0 0 1-2 2H9zm0-3.34V5.34l2.08-2.07a1.99 1.99 0 0 1 2.82 0l2.83 2.83a2 2 0 0 1 0 2.82L9 16.66zM0 1.99C0 .9.89 0 2 0h4a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zM4 17a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>
          <p class="font-semibold text-xl">Mission Management</p>
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
        <p class="mr-6">{{ sizeof($missions) }} records</p>
        <a href="{{route('ms-add', ['item_type' => 'mission'])}}">
          <button class="flex items-center px-3 py-2 rounded-sm bg-green-500 text-white">
            <svg class="w-4 mr-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9 20v-1.7l.01-.24L15.07 12h2.94c1.1 0 1.99.89 1.99 2v4a2 2 0 0 1-2 2H9zm0-3.34V5.34l2.08-2.07a1.99 1.99 0 0 1 2.82 0l2.83 2.83a2 2 0 0 1 0 2.82L9 16.66zM0 1.99C0 .9.89 0 2 0h4a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zM4 17a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>
            <p class="text-sm">New Mission</p>
          </button>
        </a>
      </div>
    </div>
    @livewire('ms.search-missions')
  </div>
@endsection