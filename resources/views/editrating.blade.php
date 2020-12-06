@extends('layouts.app')

@section('content')
<div class="bg-indigo-700 px-32 p-10">
    <h2 class="text-4xl text-white font-semibold pt-8">Edit Review</h2>
</div>
<div class=" px-32 p-10">
    <form action="{{ route('ratings.update',['id' => $review->id]) }}" method="POST" role="review">
        @csrf
        <div>
            <select name="rating" id='rating' style="width: 150px">
                <option value="">Rating</option>
                <option value="1" {{('1' == $review->rate) ? 'selected' : ''}}>1 star</option>
                <option value="2" {{('2' == $review->rate) ? 'selected' : ''}}>2 star</option>
                <option value="3" {{('3' == $review->rate) ? 'selected' : ''}}>3 star</option>
                <option value="4" {{('4' == $review->rate) ? 'selected' : ''}}>4 star</option>
                <option value="5" {{('5' == $review->rate) ? 'selected' : ''}}>5 star</option>
            </select>
        </div>
        <div class="text-sm flex mt-4 flex-col">
            <input name="title" type="text" value="{{$review->title}}" class="mb-5 appearance-none w-full border border-gray-400 p-2 focus:outline-none focus:border-gray-500" placeholder="Enter your title"></input>
            <textarea name="review" type="text" class=" appearance-none w-full border border-gray-400 p-2 h-32 focus:outline-none focus:border-gray-500" placeholder="Enter your review">{{$review->review}}</textarea>
        </div>
        <div>
            <button type="submit" class=" rounded-lg w-full bg-indigo-700 shadow-lg text-white px-4 py-2 hover:bg-indigo-500 mt-8 text-center font-semibold focus:outline-none ">
                Update
            </button>
        </div>
    </form>
</div>
@endsection