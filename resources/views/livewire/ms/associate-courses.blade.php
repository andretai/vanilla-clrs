<div>
  <p>Distinct Courses</p>
  <p>Alpha</p>
  <p>{{ $selectedCourse->title }}</p>
  <div class="grid grid-cols-2">
    <div>
      <p>Pivot</p>
      <select wire:model="alphaCourse">
        @foreach ($courses as $course)
          <option value={{ array_search($course, $courses) }}>{{ $course->title }}</option>
        @endforeach
      </select>
      <p>{{ $userratings }} rated this course.</p>
    </div>
    <div>
      <p>They've also rated</p>
      {{-- @foreach ($updatedCourses as $course)
        <p>{{ $course->title }}</p>
      @endforeach --}}
      {{-- @foreach ($alsorated as $item)
        <p>{{ $item }}</p>
      @endforeach --}}
      @for ($i = 0; $i < sizeof($alsorated); $i++)
        <div class="flex justify-between">
          <p>{{ $assoc[$i] }}</p>
          <p>{{ $alsorated[$i] }}</p>
        </div>
      @endfor
    </div>
  </div>
</div>
