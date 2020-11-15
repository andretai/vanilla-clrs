<div>
  <p>Select course</p>
  <select wire:model="course_id">
    @foreach ($courses as $course)
      <option value={{$course->id}}>{{$course->title}}</option>
    @endforeach
  </select>
  <div>
    <p>These tags are used to describe the above courses.</p>
    @foreach ($tags as $tag)
      <p>{{$tag}}</p>
    @endforeach
  </div>
  <div>
    <p>These courses are also described by one or more of the above tags.</p>
    @foreach ($related as $rel)
      <p>{{$rel}}</p>
    @endforeach
  </div>
</div>
