@extends('ms.layouts.app')

@section('content')
  <div class="">
    <form action="{{ route('courses.store') }}" method="POST">
      @csrf
      <div class="px-6 py-6 flex justify-between items-center border-b border-gray-300">
        <div class="flex">
          <a href="{{ $back }}">Back</a>
          <p class="ml-6 font-semibold">Add a {{ $item_type }}</p>
        </div>
        <div>
          <button class="px-3 py-2 rounded-sm bg-indigo-500 text-white" type="submit">Save</button>
        </div>
      </div>
      <div class="w-2/3 mx-auto mt-6 mb-24">
        @foreach ($item_fields as $item_field)
          <div class="flex justify-between text-sm">
            <label class="capitalize" for="{{ $item_field->name }}">{{ $item_field->name }}</label>
            @if ($errors->has($item_field->name))
              <p class="text-red-500">{{ $errors->first($item_field->name) }}</p>
            @endif
          </div>
          <input type="{{$item_field->type}}" name="{{$item_field->name}}"
            @if ($errors->has($item_field->name))
              class="my-3 p-2 w-full block border border-red-500 rounded-sm font-semibold"
            @else
              class="my-3 p-2 w-full block border border-gray-300 rounded-sm font-semibold"
            @endif
          >
        @endforeach  
      </div>
    </form>
  </div>
@endsection