@extends('ms.layouts.app')

@section('content')
<script>
  function flash(type) {
    let element = document.getElementById(type);
    element.style.transitionDuration = '1s';
    element.style.opacity = '75%';
    setTimeout(() => {
      document.getElementById(type).style.opacity = null;
    }, 1000);
  }
</script>
  @guest
    Please log in to continue.
  @endguest
  @auth
    <div class="grid grid-cols-5 col-gap-6 row-gap-6 m-12">
      <div class="col-span-3">
        <p class="font-sans text-5xl">Management System</p>
        <p>Manage content, users, and statistics from the clrs-ms dashboard.</p>
      </div>
      <div class="col-span-2 row-span-3">

      </div>
      <div class="col-span-3">
        <div class="flex">
          <button onclick="flash('sidebar')" class="w-1/3 border-2 rounded-md focus:outline-none hover:border-green-400">
            <img src="images/sidebar.png"/>
          </button>
          <div class="w-2/3 px-12 py-6">
            <p class="text-3xl">Left Side Bar</p>
            <p class="mt-3">Create, read, update, or delete individual models (content).</p>
            <div class="flex items-center mt-3">
              <svg class="w-4 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 10a10 10 0 1 1 20 0 10 10 0 0 1-20 0zm2 0a8 8 0 1 0 16 0 8 8 0 0 0-16 0zm8-2h5v4h-5v3l-5-5 5-5v3z"/></svg>
              <p class="font-semibold">Click It</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-span-3">
        <div class="flex">
          <button onclick="flash('navbar')" class="w-1/3 border-2 rounded-md focus:outline-none hover:border-green-400">
            <img src="images/header.png"/>
          </button>
          <div class="w-2/3 px-12 py-6">
            <p class="text-3xl">Navigation Bar</p>
            <p class="mt-3">Navigate between content management, statistics, and settings.</p>
            <div class="flex items-center mt-3">
              <svg class="w-4 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 10a10 10 0 1 1 20 0 10 10 0 0 1-20 0zm2 0a8 8 0 1 0 16 0 8 8 0 0 0-16 0zm8-2h5v4h-5v3l-5-5 5-5v3z"/></svg>
              <p class="font-semibold">Click It</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endauth
@endsection