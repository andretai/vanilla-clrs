<div>
    <div class="p-6 flex justify-between shadow-md">
      <div class="flex">
        <p class="mr-6">Search</p>
        <input wire:model="search" class="mr-6 px-1 border border-gray-500" type="text" name="query" id="query">
        <p class="text-green-500">{{ $delete_message ?? '' }}</p>
      </div>
    </div>
    <div class="min-h-screen px-6 pt-6 pb-24">
      <div class="w-4/5 mx-auto mb-8">
        <div class="flex font-semibold text-center">
          <div class="w-1/12">ID</div>
          <div class="w-10/12">Promotion</div>
          <div class="w-1/12">Action</div>
        </div>
        @foreach ($promotions as $promotion)
          <div class="flex items-center my-2 border border-gray-300 rounded-md">
            <div class="w-1/12 py-3 text-center">
              {{ $promotion->id }}
            </div>
            <div class="w-10/12 px-3">
              {{ $promotion->title }}
            </div>
            <div class="w-1/12">
              <a href="{{ route('ms-edit', [
                'item_type' => 'promotion',
                'id' => $promotion->id
              ])}}">EDIT</a>
            </div>
          </div>
        @endforeach
      </div>
      {{ $promotions->links() }}
    </div>
  </div>
