<div>
  <p class="mt-3 font-bold">Course Association (Non-Personalized)</p>
  <div class="flex justify-between my-3">
    <p class="italic font-semibold">Filter by</p>
    <select class="border border-gray-300" wire:model="metric">
      <option value="ratings">Ratings</option>
      <option value="favourites">Favourites</option>
    </select>
  </div>
  <div>
    <p class="my-3 font-semibold italic">Alpha Course</p>
    <select wire:model="alphaCourse" class="border border-gray-300">
      @if ($courses)
        @foreach ($courses as $course)
          <option value={{ array_search($course, $courses) }}>{{ $course->title }}</option>
        @endforeach
      @endif        
    </select>
  </div>
  {{-- <div class="flex justify-between my-3">
    <p class="italic font-semibold">Result Count</p>
    <select class="border border-gray-300" wire:model="resultCount">
      <option value={{5}}>5</option>
      <option value={{10}}>10</option>
      <option value={{15}}>15</option>
    </select>
  </div> --}}
  <div class="">
    <p class="my-3 font-semibold italic">Results</p>
    @if ($results)
      @foreach ($results as $result)
      <div>
        <p>{{ $result->course->title }}</p>
      </div>
      @endforeach
    @endif      
  </div>
</div>
