@extends('ms.layouts.app')

@section('content')
<div class="m-6">
  <div class="flex items-center">
    <svg class="w-8 mr-3 fill-current text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3.94 6.5L2.22 3.64l1.42-1.42L6.5 3.94c.52-.3 1.1-.54 1.7-.7L9 0h2l.8 3.24c.6.16 1.18.4 1.7.7l2.86-1.72 1.42 1.42-1.72 2.86c.3.52.54 1.1.7 1.7L20 9v2l-3.24.8c-.16.6-.4 1.18-.7 1.7l1.72 2.86-1.42 1.42-2.86-1.72c-.52.3-1.1.54-1.7.7L11 20H9l-.8-3.24c-.6-.16-1.18-.4-1.7-.7l-2.86 1.72-1.42-1.42 1.72-2.86c-.3-.52-.54-1.1-.7-1.7L0 11V9l3.24-.8c.16-.6.4-1.18.7-1.7zM10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>
    <p class="font-semibold text-xl">Settings</p>
  </div>
  <div class="flex">
    <div class="flex items-center my-4 mr-3 px-3 py-1 border-2 border-green-500 rounded-lg"">
      <svg class="w-4 mr-3 text-blue-500 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5.33 12.77A4 4 0 1 1 3 5.13V5a4 4 0 0 1 5.71-3.62 3.5 3.5 0 0 1 6.26 1.66 2.5 2.5 0 0 1 2 2.08 4 4 0 1 1-2.7 7.49A5.02 5.02 0 0 1 12 14.58V18l2 1v1H6v-1l2-1v-3l-2.67-2.23zM5 10l3 3v-3H5z"/></svg>
      <a href="{{ route('ms-sets-seed') }}" class="mr-6">Seed</a>
    </div>
    <div class="flex items-center my-4 mr-3 px-3 py-1 border border-gray-500 rounded-lg"">
      <svg class="w-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 0h1v3l3 7v8a2 2 0 0 1-2 2H5c-1.1 0-2.31-.84-2.7-1.88L0 12v-2a2 2 0 0 1 2-2h7V2a2 2 0 0 1 2-2zm6 10h3v10h-3V10z"/></svg>
      <a href="{{ route('ms-sets-recommend') }}" class="">Recommendation</a>
    </div>
  </div>
  {{-- <a href="{{ route('courses.seed') }}">Seed</a> --}}
  <div class="grid grid-cols-5 col-gap-6 row-gap-6">
    @foreach ($platforms as $platform)
      <div class="p-6 border border-gray-500 rounded-md shadow-md">
        <img src="/images/{{ $platform->image }}" alt="" class="h-32 mx-auto">
        <p class="mt-3 capitalize font-semibold text-lg">{{ $platform->platform }}</p>
        <p class="mb-3 text-sm">{{ $datasets[$platform->platform]->count }} course(s).</p>
        <a href="{{ route('ms-sets-seed-confirm', ['platform'=>$platform->platform, 'count'=>$datasets[$platform->platform]->count]) }}"
          class="w-1/2 mx-auto px-2 py-1 border border-gray-300 rounded-md bg-blue-500 capitalize text-sm text-white"
        >
          seed
        </a>
      </div>
    @endforeach
    @if (isset($status))
      <div class="col-span-5 flex items-center w-1/2 font-semibold capitalize">
        @if ($status)
          <img class="w-1/12 p-2" src="/images/checked.png" alt="">
          <p class="w-11/12 text-green-500">Operation completed.</p>
        @else
          <img class="w-1/12 p-2" src="/images/wrong.png" alt="">
          <p class="w-11/12 text-red-600">Operation failed.</p>
        @endif
      </div>
    @endif
  </div>
</div>
@endsection