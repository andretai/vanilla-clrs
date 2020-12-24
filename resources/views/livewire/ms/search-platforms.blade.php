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
        <div class="w-2/12">Preview</div>
        <div class="w-8/12">Platform</div>
        <div class="w-1/12 text-left">Action</div>
      </div>
      @foreach ($platforms as $platform)
        <div class="flex items-center my-2 border border-gray-300 rounded-md">
          <div class="w-1/12 py-3 text-center">
            {{ $platform->id }}
          </div>
          <div class="w-2/12">
            <img 
              class="w-24 mx-auto p-3"
              @if ($platform->platform == 'udemy')
                src="/images/udemy.png"
              @else
                src="/images/futurelearn.jpg"
              @endif 
              alt=""
            >
          </div>
          <div class="w-8/12 px-3 capitalize">
            {{ $platform->platform }}
          </div>
          <div class="w-1/12">
            <a href="{{ route('ms-edit', [
              'item_type' => 'platform',
              'id' => $platform->id
            ])}}">
              <svg class="w-5 ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M17 16v4h-2v-4h-2v-3h6v3h-2zM1 9h6v3H1V9zm6-4h6v3H7V5zM3 0h2v8H3V0zm12 0h2v12h-2V0zM9 0h2v4H9V0zM3 12h2v8H3v-8zm6-4h2v12H9V8z"/></svg>
            </a>
          </div>
        </div>
      @endforeach
    </div>
    {{ $platforms->links() }}
  </div>
</div>
