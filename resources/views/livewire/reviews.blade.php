<div>
    <form class="my-4 flex" wire:submit.prevent="addReview">
        <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="What is in your mind?" wire:model.lazy="newReview">
        <button type="submit" class="p-2 bg-blue-500 w-20 rounded shadow text-white">Add</button>
</form>
    @foreach($reviews as $review)
    <div class="rounded border shadow p-3 my-2">
        <div class="flex justify-between my-2">
            <div class="flex">
                <p class="font-bold text-lg">{{$review['creator']}}</p>
                <p class="mx-3 py-1 text-xs text-gray-500 font-semibold">{{$review['created_at']}}
                </p>
            </div>
        </div>
        <p class="text-gray-800">{{$review['body']}}</p>
    </div>
    @endforeach
</div>