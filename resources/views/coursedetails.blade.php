@extends('layouts.app')

@section('content')
<div class="max-w-md sm:max-w-xl lg:max-w-6xl mx-auto px-10 lg:px-0 py-4">
    @if (session('success'))
    <div class="m-5 flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" /></svg>
        <p>{{ session('success') }}</p>
    </div>
    @endif
    @if (session('exist'))
    <div class="m-5 flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" /></svg>
        <p>{{ session('exist') }}</p>
    </div>
    @endif
    <div class="flex rounded-lg m-3">
        <div class="w-1/3 bg-white rounded-lg m-2 p-2 items-center">
            <div>
                <img class="overflow-hidden h-48 w-full rounded-lg object-cover" src="{{$coursedetails->image}}" alt="{{$coursedetails->image}}">
                <form action="{{'https://www.udemy.com'.$coursedetails->url}}" target="_blank">
                    <button class="w-full mt-4 p-3 bg-blue-700 hover:bg-blue-600 text-l rounded-lg uppercase text-white justified text-center font-bold tracking-wide" type="submit">More Info
                    </button>
                </form>

                <p class="w-full mt-4 p-3 bg-red-700 hover:bg-red-600 text-l rounded-lg uppercase text-white justified text-center font-bold tracking-wide">
                    <a href="addtofav/{{$coursedetails->id}}">Add Favourite</a>
                </p>
                <div>
                    <p class="mt-4 font-bold text-xl text-center">Rating:
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
                    <p class="mt-2 font-bold text-xl text-center"> ({{$coursedetails->totalRating }} Reviewers)</p>
                </div>
            </div>
        </div>
        <div class="w-2/3 bg-white rounded-lg m-2 p-5">
            <h2 class="pl-2 font-bold text-3xl text-gray-900">{{$coursedetails->title}}</h2>
            <p class="pl-2 mt-3 font-base text-xl text-gray-600 tracking-wide">{{$coursedetails->category}} &bull; Created
                by: Andre Tai </p>
            <p class="pl-2 italic monospaced text-gray-600 text-xl">Duration: 5 Hours</p>
            <p class="pl-2 italic monospaced text-gray-600 text-xl">Platform: {{$coursedetails->platform}}</p>
            <p class="pl-2 italic monospaced text-gray-600 text-xl ">Price: {{$coursedetails->price}}</p>

            <div class="bg-gray-100 mt-10 p-4 rounded-lg">
                <p class="italic text-l">What You'll Learn:</p>
                <p class="italic font-semibold text-xl">{{$coursedetails->description}}</p>

            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg m-6 p-5">
        <h2 class=" font-bold text-2xl text-gray-900">Review & Rating</h2>
        @if($coursedetails->userRating)
        <div>
            <p>Name: {{$coursedetails->userRating->user->name}}</p>
            <p>Rating: {{$coursedetails->userRating->rate}}</p>
            <p>Review: {{$coursedetails->userRating->review}}</p>

        </div>
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
                    <textarea name="review" type="text" class=" appearance-none w-full border border-gray-200 p-2 h-32 focus:outline-none focus:border-gray-500" placeholder="Enter your review"></textarea>
                </div>
                <div>
                    <button type="submit" class=" rounded-lg w-full bg-blue-600 shadow-lg text-white px-4 py-2 hover:bg-blue-700 mt-8 text-center font-semibold focus:outline-none ">
                        Submit
                    </button>
                </div>
            </form>
        </div>
        @endif
        @foreach($coursedetails->allrating as $rating)
        <div class="mt-4">
            <p>Name: {{$rating->user->name}}</p>
            <p>Rating: {{$rating->rate}}</p>
            <p>Review: {{$rating->review}}</p>

        </div>
        @endforeach
    </div>


    @endsection