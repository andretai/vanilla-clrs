@extends('ms.layouts.app')

@section('content')
  <div>
    <p>Statistics</p>
    @livewire('associate-courses', ['alphaCourse' => $alphacourseId])
  </div>
@endsection