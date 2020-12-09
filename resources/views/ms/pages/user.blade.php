@extends('ms.layouts.app')

@section('content')
<div class="px-6 pt-6 pb-3 flex justify-between items-center">
  <p class="font-semibold text-3xl">Manage Users</p>
  <div class="flex items-center">
    <p class="mr-6">{{ sizeof($users) }} records</p>
    {{-- <a href="{{route('ms-add', ['item_type' => 'user'])}}">
      <button class="px-3 py-2 rounded-sm bg-green-500 text-white">New User</button>
    </a> --}}
  </div>
</div>
@if ($message !== '')
  <div class="flex w-1/4 justify-between items-center mx-6 px-6 py-3 bg-green-200 rounded-md">
    <p>{{ $message ?? '' }}</p>
    <a href="{{ route('ms-user') }}">
      <svg class="w-4 text-red-600 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
    </a>
  </div>
@endif
@livewire('search-users', ['users' => $users, 'message' => $message ?? ''])
@endsection