@extends('ms.layouts.app')

@section('content')
  <div>
    <p>Are you sure you want to delete {{ $item_type }} {{ $item_id }} ?</p>
    <div class="flex text-white">
      <a class="p-2 bg-blue-500"
        @if ($item_type === 'category')
          href="{{ route('categories.delete', ['item_type' => $item_type, 'id' => $item_id]) }}"  
        @else
          href="{{ route($item_type.'s.delete', ['item_type' => $item_type, 'id' => $item_id]) }}"
        @endif
      >
        Yes
      </a>
      <a class="p-2 bg-red-500" href="{{ route('ms-edit', ['item_type' => $item_type, 'id' => $item_id]) }}">
        No
      </a>
    </div>
  </div>
@endsection