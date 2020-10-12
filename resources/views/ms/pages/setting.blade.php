@extends('ms.layouts.app')

@section('content')
  <div>
    <p>Settings</p>
    <a href="{{ route('courses.seed') }}">Seed</a>
    @livewire('associate-courses', ['alphaCourse' => $alphacourseId])
    <hr class="my-6">
    @livewire('ms.vector-users')
  </div>
@endsection