<div>
    <div class="bg-indigo-700">
        <div class="flex flex-wrap justify-center px-12 py-6 pt-20">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-white text-sm font-bold mb-2" for="grid-city">
                    Course Name
                </label>
                <input type="text" wire:model.debounce.500ms="search" class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Example: Cooking">
                
            </div>
            <div>
                <label class="block uppercase tracking-wide text-white text-sm font-bold mb-2" for="grid-state">
                    Category
                </label>
                <div class="inline-block relative mr-5">
                    <select wire:model="category" class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="category" id="category">
                        <option value="">-- None --</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category}}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                    </div>
                </div>
                <!-- <div class="inline-block">
                        <button class=" border rounded text-white bg-indigo-700 border-white px-3 py-2 mr-3hover:border-transparent hover:bg-indigo-500" type="submit">
                            Search
                        </button>
                    </div> -->
            </div>
        </div>
        </form>
    </div>
    <div class="flex flex-wrap justify-center px-12 p-6">
        @foreach( $courses as $course)
        <a class="mt-6 px-2 w-64" href="/course/{{$course->id}}">
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
                        <div class="mt-2 text-red-700 text-lg font-semibold tracking-wide">
                            {{ $course->price }}
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    <div class="py-12 px-32">
        {{ $courses->appends(request()->query())->links() }}
    </div>
</div>