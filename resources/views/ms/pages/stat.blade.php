@extends('ms.layouts.app')

@section('content')
<div class="m-6">
  <div class="flex justify-between items-center mb-6">
    <div class="flex items-center">
      <svg class="w-8 mr-3 fill-current text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M19.95 11A10 10 0 1 1 9 .05V11h10.95zm-.08-2.6H11.6V.13a10 10 0 0 1 8.27 8.27z"/></svg>
      <p class="font-semibold text-xl">Statistics</p>
    </div>
    <div class="flex items-center">
      <p class="mr-3">Charts Per Row</p>
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