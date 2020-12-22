@extends('ms.layouts.app')

@section('content')
  <div>
    <form
      @if ($item_type === 'category')
        action="{{ route('categories.update', ['id' => $item_id]) }}"    
      @else
        action="{{ route($item_type.'s.update', ['id' => $item_id]) }}"
      @endif 
      method="POST">
      @csrf
      <div class="px-6 py-6 flex justify-between items-center border-b border-gray-300">
        <div class="flex">
          <a href="{{ $back }}">Back</a>
          <p class="ml-6 font-semibold">Editing {{ $item_type }}</p>
        </div>
        <div>
          <button class="mr-3 px-3 py-2 rounded-sm bg-indigo-500 text-white">
            Update
          </button>
          <a class="px-3 py-2 rounded-sm bg-red-500 text-white" href="{{ route('ms-remove', ['item_type' => $item_type, 'id' => $item_id]) }}">Delete</a>
        </div>
      </div>
      @if (isset($status))
        <div class="flex items-center mt-3 ml-6 font-semibold capitalize">
          @if ($status)
            <div class="">
              <img class="w-8" src="/images/checked.png" alt="">
            </div>
            <p class="ml-3 text-green-500">Operation completed.</p>
          @else
            <div class="">
              <img class="w-8" src="/images/wrong.png" alt="">
            </div>
            <p class="ml-3 text-red-500">Operation failed.</p>
          @endif
        </div>
      @endif
      <div class="w-2/3 mx-auto mt-6 mb-24">
        @foreach ($item_fields as $item_field)
          <div class="flex justify-between text-sm">
            <label class="capitalize" for="{{ $item_field->name }}">{{ $item_field->name }}</label>
            @if ($errors->has($item_field->name))
              <p class="text-red-500">{{ $errors->first($item_field->name) }}</p>
            @endif
          </div>
          <input type="{{$item_field->type}}" name="{{$item_field->name}}"
            @if ($item_field->value)
              value="{{ $item_field->value }}"
            @endif
            @if ($errors->has($item_field->name))
              class="my-3 p-2 w-full block border border-red-500 rounded-sm font-semibold"
            @else
              class="my-3 p-2 w-full block border border-gray-300 rounded-sm font-semibold"
            @endif
          >
          @if ($item_field->name === 'image')
            <img class="w-1/2 mb-6 shadow-md" src="{{ $item_field->value }}" alt="">
          @endif
        @endforeach  
      </div>   
    </form>
  </div>
@endsection