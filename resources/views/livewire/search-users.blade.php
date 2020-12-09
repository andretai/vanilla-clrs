<div>
  <div class="p-6 flex justify-between shadow-md">
    <div class="flex">
      <p class="mr-6">Search</p>
      <input wire:model="search" class="mr-6 px-1 border border-gray-500" type="text" name="query" id="query">
      <p class="text-green-500">{{ $delete_message ?? '' }}</p>
      <p class="text-green-500">{{ $message ?? '' }}</p>
    </div>
  </div>
  <div class="min-h-screen px-6 pt-6 pb-24">
    <div class="w-4/5 mx-auto mb-8">
      <div class="flex font-semibold text-center">
        <div class="w-1/12">ID</div>
        <div class="w-4/12">Name</div>
        <div class="w-6/12">E-mail</div>
        <div class="w-1/12 text-left">Admin</div>
      </div>
      @foreach ($users as $user)
        <div class="flex items-center my-2 py-3 border border-gray-300 rounded-md">
          <div class="w-1/12 text-center">{{ $user->id }}</div>
          <div class="w-4/12 text-left">{{ $user->name }}</div>
          <div class="w-6/12 text-left">{{ $user->email }}</div>
          <div class="w-1/12">
            <a href="{{ route('ms-user-mod', ['user_id' => $user->id, 'is_admin' => $user->is_admin])}}">
              <svg
               @if ($user->is_admin)
                class="w-5 text-red-600 fill-current"
               @else
                class="w-5 text-gray-600 fill-current"
               @endif
               xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M20 12v5H0v-5a2 2 0 1 0 0-4V3h20v5a2 2 0 1 0 0 4zM3 5v10h14V5H3zm7 7.08l-2.92 2.04L8.1 10.7 5.27 8.56l3.56-.08L10 5.12l1.17 3.36 3.56.08-2.84 2.15 1.03 3.4L10 12.09z"/></svg>
            </a>
          </div>
        </div>
      @endforeach
    </div>
    {{ $users->links() }}
  </div>
</div>
