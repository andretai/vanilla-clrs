@extends('ms.layouts.app')

@section('content')
  <div class="m-6">
    <p>Settings</p>
    <a href="{{ route('courses.seed') }}">Seed</a>
    <div>
      @livewire('ms.associate-courses')
      @livewire('ms.collab-filter', ['userCount' => $numberOfUsers])
      @livewire('ms.desc-tags')
    </div>
  </div>
@endsection