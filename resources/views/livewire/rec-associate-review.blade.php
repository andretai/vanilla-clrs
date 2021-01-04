<div class="w-2/3 py-4 pb-10">
    @if(!$rec)
    <h2 class=" font-bold text-2xl text-gray-900">Same Category Courses</h2>
    <div class="divide-y divide-blue-300">
        @foreach($category[0] as $r)
        <div>
            <a href="{{$r->id}}">
                <div class="flex py-3">
                    <div>
                        <img class="h-16 w-16 object-cover" src="{{$r->image}}" alt="{{$r->image}}">
                    </div>
                    <div class="px-3 w-3/5">
                        <p class=" font-bold">{{$r->title}}</p>
                        <p class="inline-block capitalize font-semibold"><i class="fas fa-window-restore fa-sm mr-2"></i>{{$r->platform->platform}}</p>
                    </div>
                    <div>
                        <p class=" w-32  px-8 text-orange-600">{{$r->avgRating()}}<i class="fas fa-star fa-sm pl-3"></i></p>
                    </div>
                    <div>
                        <p class=" w-16"><i class="fas fa-user-alt fa-sm mr-2"></i> {{$r->countRating()}}</p>
                    </div>
                    <div>
                        <p class="pl-4 font-semibold text-red-700">{{$r->price}}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @else
    <h2 class=" font-bold text-2xl text-gray-900">People Also Check</h2>
    <div class="divide-y divide-blue-300">
        @foreach($rec as $r)
        <div>
            <a href="{{$r->course->id}}">
                <div class="flex py-3">
                    <div>
                        <img class="h-16 w-16 object-cover" src="{{$r->course->image}}" alt="{{$r->course->image}}">
                    </div>
                    <div class="px-3 w-3/5">
                        <p class=" font-bold">{{$r->course->title}}</p>
                        <p class="inline-block capitalize font-semibold"><i class="fas fa-window-restore fa-sm mr-2"></i>{{$r->course->platform->platform}}</p>
                    </div>
                    <div>
                        <p class=" w-32 px-8 text-orange-600">{{$r->course->avgRating()}}<i class="fas fa-star fa-sm pl-3"></i></p>
                    </div>
                    <div>
                        <p class=" w-16"><i class="fas fa-user-alt fa-sm mr-2"></i> {{$r->course->countRating()}}</p>
                    </div>
                    <div>
                        <p class="pl-4 font-semibold text-red-700">{{$r->course->price}}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @endif
</div>
