@extends('ms.layouts.app')

@section('content')
<div class="m-6">
  <div class="flex justify-between mb-6">
    <p>Statistics</p>
    <div class="grid grid-cols-2 col-gap-6">
      <p>No. of Col</p>
      <select onchange="location = this.value" class="border border-gray-500">
        @for ($i = 1; $i <= 12; $i++)
          <option value="{{ route('ms-stats', ['col' => $i]) }}"
            @if ($col == $i)
              selected="selected"
            @endif
          >
            <a href="{{ route('ms-stats', ['col' => $i]) }}">{{$i}}</a>
          </option>
        @endfor
      </select>
    </div>
  </div>
  @livewire('ms.chartjs', ['charts' => $charts, 'col' => $col])
</div>
@endsection