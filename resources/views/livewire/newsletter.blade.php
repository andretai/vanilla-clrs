<div class="px-32 pt-3 pb-10">
    <h2 class="text-5xl text-indigo-700 font-bold pt-8">Newsletter</h2>
    <div>
        <div class="divide-y divide-black">
            @foreach($news as $n)
            <div class="w-4/5 pb-5">
                <h2 class=" font-bold text-3xl text-gray-900">{{$n->title}}</h2>
                <h3 class="font-bold text-xl capitalize text-indigo-700">Platform: {{$n->platform}}</h3>
                <p class="text-xl capitalize mb-5">{{$n->description}}</p>

                <a href="{{$n->url}}" target="_blank" class="inline-block px-3 py-2 border rounded text-white bg-indigo-700 border-white hover:border-transparent hover:bg-indigo-500 lg:mt-0">Read Article<i class="fas fa-info-circle ml-2"></i></a>
            </div>
            @endforeach
        </div>
        <div class="w-4/5 pt-5">
            {{ $news->appends(request()->query())->links() }}
        </div>

    </div>