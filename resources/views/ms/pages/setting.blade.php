@extends('ms.layouts.app')

@section('content')
  <div class="m-6">
    <p>Settings</p>
    <a href="{{ route('courses.seed') }}">Seed</a>
    {{-- <div class="grid grid-cols-2 col-gap-6 row-gap-6">
      @livewire('ms.associate-courses')
      @livewire('ms.collab-filter', ['userCount' => $numberOfUsers])
    </div> --}}
  </div>
@endsection