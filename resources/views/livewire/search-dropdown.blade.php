<div class="px-6 relative">
    <div>
        <input type="text" wire:model="query" wire:keydown.escape="resetValues" wire:keydown.tab="resetValues" class="bg-gray-200 text pt-2 w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline" placeholder="Search Courses..." />
    </div>
    <div wire:loading class="absolute z-10 bg-white w-64 rounded-t-none shadow-lg">
        <p class="hover:bg-gray-100 px-3 py-3">Searching...</p>
    </div>

    @if(!empty($query))
    <div class="fixed top-0 right-0 bottom-0 left-0" wire:click="resetValues"></div>
    <div class="absolute z-10 bg-white w-64 rounded-t-none shadow-lg">
        @if(!empty($courses))
        <ul>
            @foreach($courses as $course)
            <li class="border-b border-gray-300">
                <a href="/course/{{$course['id']}}" class="block hover:bg-gray-100 px-3 py-3">{{$course['title']}}</a>
            </li>
            @endforeach
        </ul>

        @else
        <p class="hover:bg-gray-100 px-3 py-3">No results!</p>
    </div>
    @endif
    @endif
</div>