@extends('ms.layouts.app')

@section('content')
<div class="m-6">
  <div class="flex justify-between items-center mb-6">
    <p class="font-sans text-4xl">Statistics</p>
    <div class="flex">
      <button class="mx-6">All</button>
      |
      <button class="mx-6">Category</button>
      |
      <button class="mx-6">Miscellaneous</button>
    </div>
    {{-- <select onchange="location = this.value" class="border border-gray-500">
      @for ($i = 1; $i <= 12; $i++)
        <option value="{{ route('ms-stats', ['col' => $i]) }}"
          @if ($col == $i)
            selected="selected"
          @endif
        >
          <a href="{{ route('ms-stats', ['col' => $i]) }}">{{$i}}</a>
        </option>
      @endfor
    </select> --}}
  </div>
  @livewire('ms.chartjs', ['charts' => $charts, 'col' => $col])
</div>
@endsection