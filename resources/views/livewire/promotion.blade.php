<div>
    <div class="bg-indigo-700 px-32 p-10">
        <h2 class="text-4xl text-white font-semibold pt-8">Quests & Promotions</h2>
    </div>
    <div class="px-32 p-10">

        <div class="pb-10 w-4/5">
            <div class="flex">
                <div>
                    <p class="text-4xl font-bold pb-5 pr-5">Quests</p>
                </div>
                <div>
                    <button wire:click="refresh" class="text-red-800 text-lg font-semibold pt-4 hover:text-red-500 focus:outline-none"><i class="fas fa-sync pr-2"></i>Refresh</button>
                </div>
            </div>

            @if (session('claimed'))
            <div class="my-5 flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" /></svg>
                <p>{{ session('claimed') }}</p>
            </div>
            @endif
            @if (session('success'))
            <div class="my-5 flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" /></svg>
                <p>{{ session('success') }}</p>
            </div>
            @endif
            @if(!$missions->isEmpty())
            <div class="divide-y divide-black">
                @foreach($missions as $mission)
                <div>
                    <div class="flex py-3">
                        <div class="pr-5 pt-3">
                            @if(!$this->checkProgress($mission))
                                <i class="fas fa-question-circle fa-3x"></i>
                            @else
                                @if(!$this->checkClaim($mission->id))
                                    <i class="fas fa-check-circle fa-3x  text-orange-700"></i>
                                @else
                                    <i class="fas fa-check-circle fa-3x text-gray-600"></i>
                                @endif 
                            @endif

                        </div>
                        <div class="px-3 w-9/12">
                            <p class="text-3xl font-bold">{{$mission->title}} <span class="text-orange-600 font-semibold text-2xl ml-3"> {{$this->getProgress($mission)}}/{{$mission->volume}}</span></p>
                            <p class=" text-orange-600 text-lg inline-block capitalize font-semibold"><i class="fas fa-info-circle mr-2"></i>Reward: {{$mission->reward}}% Discount Promo Code for {{$mission->platform->platform}} platform</p>
                        </div>
                        <div>
                            @if(!$this->checkProgress($mission))
                            <a href="/course" type="submit" class=" rounded-lg w-24 bg-indigo-700 shadow-lg text-white px-4 py-2 hover:bg-indigo-500 mt-4 text-center font-semibold focus:outline-none ">
                                Go
                            </a>
                            @else
                            @if(!$this->checkClaim($mission->id))
                            <button wire:click="generatePromotion({{$mission->id}})" type="submit" class=" rounded-lg w-24 bg-orange-700 shadow-lg text-white px-4 py-2 hover:bg-orange-500 mt-4 text-center font-semibold focus:outline-none ">
                                Claim
                            </button>
                            @else
                            <p class=" rounded-lg w-24 bg-gray-600 shadow-lg text-white px-4 py-2 mt-4 text-center font-semibold focus:outline-none ">
                                Claimed
                            </p>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="px-32 p-10">

                <div class="mx-auto h-full flex justify-center items-center pb-5"><i class="fas fa-tasks fa-7x text-indigo-700"></i></div>
                <div class=" mx-auto h-full flex justify-center items-center text-3xl font-bold">No quests is Found</div>
                <div class=" mx-auto h-full flex justify-center items-center text-2xl font-semibold">Latest quests will be update soon!</div>

            </div>
            @endif
        </div>
        <div>
            <p class="text-4xl font-bold pb-5">Promotion</p>
            @if(!$promotions->isEmpty())
            <div class="divide-y divide-black">
                @foreach($promotions as $promotion)
                <div class="flex py-3">
                    <div class="pr-5">
                        <img class="overflow-hidden h-auto w-56 object-cover" src="/images/{{$promotion->platform->image}}" :alt="">
                    </div>
                    <div class="px-5 w-3/5">
                        <h2 class=" font-bold text-3xl capitalize text-gray-900">{{$promotion->platform->platform}} Platform</h2>
                        <div class="flex mt-1">
                            <p class="pr-5 font-semibold text-2xl">Promo Code:</p>
                            <p class="font-semibold text-orange-600 text-2xl pr-5">{{$promotion->code}}</p>
                            <p class="font-semibold text-orange-600 text-2xl">(Expired by {{$promotion->end_date}})</p>
                        </div>
                        <p class="text-xl capitalize mb-5"> {{$promotion->description}}</p>
                        <a href="{{$promotion->url}}" target="_blank" class="inline-block px-3 py-2 border rounded text-white bg-indigo-700 border-white hover:border-transparent hover:bg-indigo-500 lg:mt-0">Go to the Platform<i class="fas fa-info-circle ml-2"></i></a>

                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="px-32 p-10">

                <div class="mx-auto h-full flex justify-center items-center pb-5"><i class="fas fa-tags fa-7x text-indigo-700"></i></div>
                <div class=" mx-auto h-full flex justify-center items-center text-3xl font-bold">No promotion is Found</div>
                <div class=" mx-auto h-full flex justify-center items-center text-2xl font-semibold">Lets Do Some Quest to Claim the Promo Code</div>

            </div>
            @endif
        </div>
    </div>
</div>