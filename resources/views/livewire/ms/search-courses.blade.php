<div>
  <div class="p-6 flex">
    <p class="mr-6">Search</p>
    <input wire:model="search" class="mr-6 px-1 border border-gray-500" type="text" name="query" id="query">
    <p class="text-green-500">{{ $delete_message ?? '' }}</p>
  </div>
  <div class="min-h-screen p-6 bg-gray-200">
    <table class="w-4/5 mx-auto">
      <tr>
        <th class="w-1/12"><input type="checkbox"></th>
        <th class="w-2/12">Preview</th>
        <th class="w-7/12">Title</th>
        <th class="w-2/13">Action</th>
      </tr>
      @foreach ($courses as $course)
        <tr class="bg-gray-100 border border-gray-300 rounded-lg shadow-md">
          <td class="py-3 text-center"><input type="checkbox" name="" id=""></td>
          <td><img src={{ $course->image }} alt=""></td>
          <td>{{ $course->title }}</td>
          <td><a href="{{ route('ms-edit', ['item_type' => 'course', 'id' => $course->id]) }}">EDIT</a></td>
        </tr>
      @endforeach
    </table>
  </div>
</div>
