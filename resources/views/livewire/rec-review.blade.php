<div class="px-20 py-6">
    
    <div>
        <div class="flex p-2 pt-6">
            <div class="block tracking-wide text-3xl font-bold pr-4">
                People interested in those courses
            </div>
            @livewire('rec-feedbacks',['rec'=>$order[0]->id])
        </div>
        <div class="flex">
            @foreach($recReview as $course)
            <a class="mt-2 px-2 w-64" href="/course/{{$course->id}}">
                <div class="bg-white border rounded-lg overflow-hidden hover:shadow-xl">
                    <img class="h-40 w-full object-cover" src="{{$course->image}}" alt="{{$course->description}}">
                    <div class="p-6">
                        <div class="flex items-baseline">
                            <span class="inline-block bg-teal-200 text-teal-800 text-xs px-2 rounded-full uppercase font-semibold tracking-wide">{{$course->platform->platform}}</span>
                            <div class="ml-2 text-gray-600 text-xs uppercase font-semibold truncate">
                                {{$course->category->category}}
                            </div>
                        </div>

                        <h4 class="mt-1 font-semibold text-lg leading-tight truncate">{{ $course->title }}</h4>

                        <div class="flex mt-1">
                            <div class="text-gray-600 capitalize w-24 font-semibold truncate">
                                {{$course->instructor}}</div>
                            <div class="text-orange-600 ml-3">{{$course->avgRating()}} <i class="fas fa-star fa-sm pl-1"></i></div>
                        </div>
                        <div class="flex items-baseline">
                            <div class="mt-2 text-red-700 text-xl font-semibold tracking-wide">
                                {{ $course->price }}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach

        </div>
    </div>
</div>
