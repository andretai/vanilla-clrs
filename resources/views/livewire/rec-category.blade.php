<div class="px-20 py-6">

    <div>
        <div class="flex p-2 pt-6">
            <div class="block tracking-wide text-3xl font-bold pr-4">
                Top Categories 
            </div>
            @if(Auth::User())
            @livewire('rec-feedbacks',['rec'=>$order[0]->id])
            @endif
        </div>

        <div class="flex flex-wrap">
            @foreach($recCategory as $course)
            <a class="mt-2 px-2 w-64" href="/search?title=&category={{$course->course->category_id}}">
                <div class="bg-white border rounded-lg overflow-hidden hover:shadow-xl">
                    <img class="h-32 w-full object-cover" src="{{$course->course->image}}" alt="{{$course->course->description}}">
                    <div class="p-6">
                        <h4 class="mt-1 font-semibold text-xl leading-tight capitalize truncate">{{$course->course->category->category}}</h4>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>