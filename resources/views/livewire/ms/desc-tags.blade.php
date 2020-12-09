<div>
  <p class="mt-3 font-bold">Filtering by Descriptive Tags (Content-Based)</p>
  <p class="my-3">Select course</p>
  <select wire:model="course_id" class="w-full p-1 border border-gray-500 focus:outline-none">
    @foreach ($courses as $course)
      <option value={{$course->id}}>
        <p>{{$course->id}}</p>
        <p>{{$course->title}}</p>
      </option>
    @endforeach
  </select>
  <div class="">
    <div>
      <p class="my-3">These tags are used to describe the above courses.</p>
      <div class="grid grid-cols-5 col-gap-3 row-gap-2 p-3 border border-gray-500 rounded-md">
        @if ($tags)
          @foreach ($tags as $tag)
            <button class="bg-gray-200 p-1 rounded-md">{{$tag}}</button>
          @endforeach
        @else
          <p class="col-span-5">[There are no descriptive tags for this course.]</p>
        @endif
      </div>
    </div>
    <div class="pb-24">
      <p class="my-3">These courses are also described by one or more of the tags.</p>
      <div style="height: 300px" class="p-3 border border-gray-500 rounded-md overflow-y-scroll">
        @if ($related)
          @foreach ($related as $rel)
            <button class="flex justify-between w-full bg-gray-200 mb-2 p-2 rounded-md cursor-default focus:outline-none">
              <p>{{$rel->course->id}}</p>
              <p>{{$rel->course->title}}</p>
            </button>
          @endforeach
        @else
          <p>[There are no courses with similar descriptive tags.]</p>
        @endif
      </div>
    </div>
  </div>
</div>
