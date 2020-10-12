<div>
  <p>Product Association (Non-Personalized)</p>
  <p>{{ $selectedCourse->title ?? '' }}</p>
  <div class="grid grid-cols-2">
    <div>
      <p>Alpha</p>
      <select wire:model="alphaCourse">
        {{-- @if ($courses)
          @foreach ($courses as $course)
            <option value={{ array_search($course, $courses) }}>{{ $course->title }}</option>
          @endforeach
        @endif         --}}
      </select>
      <p>{{ $userratings ?? '' }} rated this course.</p>
    </div>
    <div>
      <p>They've also rated</p>
      @if ($assoc)
        @foreach ($assoc as $item => $item_score)
          <p>{{ $item }}</p>
          <p>{{ $item_score }}</p>
        @endforeach
      @endif      
    </div>
  </div>
</div>
