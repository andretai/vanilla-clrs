@extends('ms.layouts.app')

@section('content')
  @guest
    Please log in to continue.
  @endguest
  @auth
    <div>
      <p>Management System Content</p>
    </div>
  @endauth
@endsection