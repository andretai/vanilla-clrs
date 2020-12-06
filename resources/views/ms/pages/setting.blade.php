@extends('ms.layouts.app')

@section('content')
  <div class="m-6">
    <p class="font-sans text-4xl">Settings</p>
    <div class="flex my-6">
      <button class="mr-6">Seed</button>
      |
      <button class="mx-6">Recommendation</button>
      |
      <button class="mx-6">Miscellaneous</button>
    </div>
    <a href="{{ route('courses.seed') }}">Seed</a>
    <div class="grid grid-cols-2 col-gap-6 row-gap-6">
      {{-- @livewire('ms.associate-courses')
      @livewire('ms.collab-filter', ['userCount' => $numberOfUsers])
      @livewire('ms.desc-tags') --}}
    </div>
  </div>
@endsection