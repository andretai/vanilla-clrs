@extends('ms.layouts.app')

@section('content')
<div class="px-6 pt-6 pb-3 flex justify-between items-center">
  <div class="flex">
    <svg class="w-8 mr-3 fill-current text-yellow-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5 5a5 5 0 0 1 10 0v2A5 5 0 0 1 5 7V5zM0 16.68A19.9 19.9 0 0 1 10 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/></svg>
    <p class="font-semibold text-xl">Users Management</p>
  </div>  
  <div class="flex items-center">
    <p class="mr-6">{{ sizeof($users) }} records</p>
    {{-- <a href="{{route('ms-add', ['item_type' => 'user'])}}">
      <button class="px-3 py-2 rounded-sm bg-green-500 text-white">New User</button>
    </a> --}}
  </div>
</div>
@if ($message !== '')
  <div class="flex items-center mt-6 ml-6 font-semibold capitalize" >
    <div class="">
      <img class="w-6" src="/images/checked.png" alt="">
    </div>
    <p class="ml-3 text-green-500">{{$message}}</p>
  </div>
@endif
@livewire('search-users', ['users' => $users, 'message' => $message ?? ''])
@endsection