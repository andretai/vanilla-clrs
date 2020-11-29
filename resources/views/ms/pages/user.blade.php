@extends('ms.layouts.app')

@section('content')
  <div class="p-6">
    <p class="font-semibold text-3xl">Manage Users</p>
    <div class="grid grid-cols-6">
      <div class="col-span-4 text-center">
        <div class="flex">
          <div class="w-1/12">ID</div>
          <div class="w-4/12">NAME</div>
          <div class="w-6/12">E-MAIL</div>
          <div class="w-1/12">ROLE</div>
        </div>
        @foreach ($users as $user)
          <div class="flex">
            <div class="w-1/12">{{ $user->id }}</div>
            <div class="w-4/12 text-left">{{ $user->name }}</div>
            <div class="w-6/12 text-left">{{ $user->email }}</div>
            <div class="w-1/12">SET</div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection