<div>
  <p class="font-bold">Product Association by Course Reviews (Non-Personalized)</p>
  {{-- <p>{{ $selectedCourse->title ?? '' }}</p> --}}
  <div>
    <div>
      {{-- <select wire:model="alphaCourse">
        @if ($courses)
          @foreach ($courses as $course)
            <option value={{ array_search($course, $courses) }}>{{ $course->title }}</option>
          @endforeach
        @endif        
      </select> --}}
      {{-- <p>{{ $userratings ?? '' }} rated this course.</p> --}}
    </div>
    <div>
      {{-- <p>They've also rated</p> --}}
      @if ($assoc)
        @foreach ($assoc as $item => $item_score)
          <p>{{ $item }}</p>
          <p>{{ $item_score }}</p>
        @endforeach
      @endif      
    </div>
  </div>
</div>
