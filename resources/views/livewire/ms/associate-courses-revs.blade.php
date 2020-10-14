<div>
  <p class="font-bold">Course Association by Course Reviews (Non-Personalized)</p>
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
  <div class="">
    <p class="my-3 font-semibold italic">Results</p>
    <div class="grid grid-cols-5">
      <p class="col-span-4 text-center">Course Names</p>
      <p class="col-span-1 text-center">Scores</p>
    </div>
    @if ($assoc)
      @foreach ($assoc as $item => $item_score)
      <div class="flex">
        <p class="w-4/5 text-left">{{ $item }}</p>
        <p class="w-1/5 text-center">{{ $item_score }}</p>
      </div>
      @endforeach
    @endif      
  </div>
</div>
