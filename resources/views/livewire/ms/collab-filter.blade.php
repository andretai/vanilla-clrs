<div>
  <p class=" mt-3 font-bold">Collaborative Filtering (Content-Based)</p>
  <div class="flex justify-between my-3">
    <p class="italic font-semibold">Filter by</p>
    <select class="border border-gray-300" wire:model="type">
      <option value="ratings">Ratings</option>
      <option value="favourites">Favourites</option>
    </select>
  </div>
  <div class="flex justify-between my-3">
    <p class="italic font-semibold">Alpha User</p>
    <select class="border border-gray-300" wire:model="alphaUser">
      @for ($i = 3; $i < $userCount; $i++)
        <option value={{$i}}>{{$i}}</option>
      @endfor
    </select>
  </div>
  <p class="my-3 italic font-semibold">Results</p>
  @foreach ($results as $result)
    <p>{{ $result }}</p>
  @endforeach
</div>
