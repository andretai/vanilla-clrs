@extends('layouts.app')

@section('content')
<div>
    <div class="bg-indigo-700 px-32 p-10">

        <!-- <div class="max-w-md sm:max-w-xl lg:max-w-6xl mx-auto px-10 lg:px-0 py-4"> -->
        @if (session('success'))
        <div class="flex items-center mb-3 bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" /></svg>
            <p>{{ session('success') }}</p>
        </div>
        @endif
        @if (session('exist'))
        <div class="flex items-center mb-3 bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" /></svg>
            <p>{{ session('exist') }}</p>
        </div>
        @endif
        @if (session('alert'))
        <div class="flex items-center mb-3 bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" /></svg>
            <p>{{ session('alert') }}</p>
        </div>
        @endif
        <div class="flex">
            <div class="w-2/3 pr-2">
                <div class="mb-2">
                    <a href="/course" class="text-gray-200 font-semibold">Online Course</a>
                    <span class="text-gray-200">></span>
                    <a href="/search?title=&category={{$coursedetails->category_id}}" class="text-gray-200 font-semibold capitalize">{{$coursedetails->category->category}}</a>
                </div>
                <h2 class="font-bold text-3xl text-white pb-2">{{$coursedetails->title}}</h2>
                <p class="text-xl text-white">{{$coursedetails->description}}</p>
                <div class="flex mt-3">
                    <p class="mr-1 mt-1 font-semibold text-yellow-400">{{number_format($coursedetails->averageRating,1)}}</p>
                    <p class="font-semibold text-yellow-400">
                        @foreach(range(1,5) as $i)
                        <span class="fa-stack" style="width:1em">
                            <i class="far fa-star fa-stack-1x"></i>
                            @if($coursedetails->averageRating >0)
                            @if($coursedetails->averageRating >0.5)
                            <i class="fas fa-star fa-stack-1x"></i>
                            @else
                            <i class="fas fa-star-half fa-stack-1x"></i>
                            @endif
                            @endif
                            @php $coursedetails->averageRating--; @endphp
                        </span>
                        @endforeach
                    </p>
                    <p class="ml-3 mt-1 font-bold text-white"> ({{$coursedetails->totalRating }} ratings)</p>
                </div>

                <p class=" mt-3 font-base text-xl text-white tracking-wide">Created
                    by Andre Tai </p>
                <div class="flex">
                    <p class="text-white text-xl mr-6"><i class="far fa-clock mr-2"></i>5 Hours</p>
                    <p class="text-white text-xl mr-6 capitalize"><i class="fas fa-window-restore mr-2"></i> {{$coursedetails->platform->platform}}</p>
                    <p class="text-white text-xl"><i class="fas fa-tags mr-2"></i> {{$coursedetails->price}}</p>
                </div>
                <div class="mt-4">
                    <a href="addtofav/{{$coursedetails->id}}" class="inline-block px-3 py-2 mr-3 border rounded text-white bg-indigo-700 border-white hover:border-transparent hover:bg-indigo-500 lg:mt-0">Favourite<i class="far fa-heart ml-2"></i></a>

                    <a href="{{'https://www.'.$coursedetails->platform->platform.'.com'.$coursedetails->url}}" target="_blank" class="inline-block px-3 py-2 border rounded text-white bg-indigo-700 border-white hover:border-transparent hover:bg-indigo-500 lg:mt-0">More Info<i class="fas fa-info-circle ml-2"></i></a>
                </div>
            </div>
            <div class="w-1/3 items-center">
                <img class="overflow-hidden h-full w-full object-cover" src="{{$coursedetails->image}}" alt="{{$coursedetails->image}}">
            </div>
        </div>
    </div>

    <div class="bg-white px-32 p-10 ">
        <div class="w-2/3 py-4 pb-10">
            <h2 class=" font-bold text-2xl text-gray-900">People Also Check</h2>
            <div class="divide-y divide-blue-300">
                @foreach($coursedetails->recommendCourse as $r)
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
                            <p class="px-8 text-orange-600">{{$r->course->avgRating()}}<i class="fas fa-star fa-sm pl-3"></i></p>
                        </div>
                        <div>
                            <p class=" w-12"><i class="fas fa-user-alt fa-sm mr-2"></i> {{$r->course->countRating()}}</p>
                        </div>
                        <div>
                            <p class="pl-4 font-semibold text-red-700">{{$r->course->price}}</p>
                        </div>
                    </div>
                </a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="w-2/3">
            <h2 class=" font-bold text-2xl text-gray-900">Reviews</h2>
            <!-- @livewire('reviews') -->
            @if($coursedetails->userRating)
            <div class="p-3 my-2">
                <div class="flex justify-between">
                    <div class="flex">
                        <p class="font-bold text-lg">{{$coursedetails->userRating->user->name}}</p>
                        <p class="mx-3 py-1 text-xs text-gray-500 font-semibold">{{$coursedetails->userRating->created_at->diffForHumans()}}
                        </p>
                    </div>
                    <div class="flex">
                        <a href="#" class="mr-3 text-gray-600"><i class="fas fa-edit"></i></a>
                        <a href="/rating/removerating/{{$coursedetails->userRating->id}}" class="text-red-700"><i class="far fa-trash-alt"></i></a>
                    </div>
                </div>
                <div class="mt-1 flex">
                    <p class="font-semibold text-gray-800 text-xl mr-4">{{$coursedetails->userRating->title}}</p>
                    <p class="font-semibold text-yellow-400">
                        @foreach(range(1,5) as $i)
                        <span class="fa-stack" style="width:1em">
                            <i class="far fa-star fa-stack-1x"></i>
                            @if($coursedetails->userRating->rate >0)
                            @if($coursedetails->userRating->rate >0.5)
                            <i class="fas fa-star fa-stack-1x"></i>
                            @else
                            <i class="fas fa-star-half fa-stack-1x"></i>
                            @endif
                            @endif
                            @php $coursedetails->userRating->rate--; @endphp
                        </span>
                        @endforeach
                    </p>
                </div>
                <p class="text-gray-800">{{$coursedetails->userRating->review}}</p>
            </div>
            <hr class="border-black">
            @else

            <div class="p-3">
                <form action="/rating/{{$coursedetails->id}}" method="GET" role="review">
                    <div>
                        <select name="rating" id='rating' class="form-control ml-3" style="width: 150px">
                            <option value="">Rating</option>
                            <option value="1">1 star</option>
                            <option value="2">2 star</option>
                            <option value="3">3 star</option>
                            <option value="4">4 star</option>
                            <option value="5">5 star</option>
                        </select>
                    </div>
                    <div class="text-sm flex mt-4 flex-col">
                        <input name="title" type="text" class="mb-5 appearance-none w-full border border-gray-400 p-2 focus:outline-none focus:border-gray-500" placeholder="Enter your title"></input>
                        <textarea name="review" type="text" class=" appearance-none w-full border border-gray-400 p-2 h-32 focus:outline-none focus:border-gray-500" placeholder="Enter your review"></textarea>
                    </div>
                    <div>
                        <button type="submit" class=" rounded-lg w-full bg-indigo-700 shadow-lg text-white px-4 py-2 hover:bg-indigo-500 mt-8 text-center font-semibold focus:outline-none ">
                            Submit
                        </button>
                    </div>
                </form>
            </div>

            @endif
            <div class="divide-y divide-black">
                @foreach($coursedetails->allrating as $rating)
                <div class="p-3 my-2">
                    <div class="flex">
                        <p class="font-bold text-lg">{{$rating->user->name}}</p>
                        <p class="mx-3 py-1 text-xs text-gray-500 font-semibold">{{$rating->created_at->diffForHumans()}}
                        </p>
                    </div>
                    <div class="mt-1 flex">
                        <p class="font-semibold text-gray-800 text-xl mr-4 ">{{$rating->title}}</p>

                        <p class="font-semibold text-yellow-400">
                            @foreach(range(1,5) as $i)
                            <span class="fa-stack" style="width:1em">
                                <i class="far fa-star fa-stack-1x"></i>
                                @if($rating->rate >0)
                                @if($rating->rate >0.5)
                                <i class="fas fa-star fa-stack-1x"></i>
                                @else
                                <i class="fas fa-star-half fa-stack-1x"></i>
                                @endif
                                @endif
                                @php $rating->rate--; @endphp
                            </span>
                            @endforeach
                        </p>
                    </div>
                    <p class="text-gray-800">{{$rating->review}}</p>

                </div>

                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection