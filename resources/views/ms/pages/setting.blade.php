@extends('ms.layouts.app')

@section('content')
  <div>
    <p>Settings</p>
    <a href="{{ route('courses.seed') }}">Seed</a>
    <div class="grid grid-cols-2 row-gap-6">
      @livewire('ms.associate-courses-revs', ['alphaCourse' => $alphacourseId])
      @livewire('ms.vector-users')
      @livewire('ms.associate-courses-favs')
    </div>

  </div>
@endsection