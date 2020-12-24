<div class="px-20 py-6">
    <div>
        <div class="flex p-2 pt-6">
            <div class="block tracking-wide text-3xl font-bold pr-4">
                Most Favourite
            </div>
            @livewire('rec-feedbacks',['rec'=>1])
        </div>
        <div class="flex">
            @foreach($mFav as $course)
            <a class="mt-2 px-2 w-64" href="/course/{{$course->course->id}}">
                <div class="bg-white border rounded-lg overflow-hidden hover:shadow-xl">
                    <img class="h-40 w-full object-cover" src="{{$course->course->image}}" alt="{{$course->course->description}}">
                    <div class="p-6">
                        <div class="flex items-baseline">
                            <span class="inline-block bg-teal-200 text-teal-800 text-xs px-2 rounded-full uppercase font-semibold tracking-wide">{{$course->course->platform->platform}}</span>
                            <div class="ml-2 text-gray-600 text-xs uppercase font-semibold truncate">
                                {{$course->course->category->category}}
                            </div>
                        </div>

                        <h4 class="mt-1 font-semibold text-lg leading-tight truncate">{{ $course->course->title }}</h4>

                        <div class="flex mt-1">
                            <div class="text-gray-600 capitalize font-semibold truncate">
                                {{$course->course->instructor}}</div>
                        </div>
                        <div class="flex items-baseline justify-between">
                            <div class="mt-2 text-red-700 text-xl font-semibold tracking-wide">
                                {{ $course->course->price }}
                            </div>
                            <div class="flex">
                                <div class="text-orange-600 ml-3">{{$course->course->avgRating()}} <i class="fas fa-star fa-sm pl-1"></i></div>

                                <div class="text-red-600 ml-3">{{$course->total}} <i class="fas fa-heart"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
