    <div>
        <div class="flex py-3">
            <div class="pr-5 pt-3">
                <i class="fas fa-question-circle fa-3x"></i>
            </div>
            <div class="px-3 w-9/12">
                <p class="text-3xl font-bold">{{$mission->title}}</p>
                <p class=" text-orange-600 text-lg inline-block capitalize font-semibold"><i class="fas fa-info-circle mr-2"></i>Reward: {{$mission->reward}}% Discount Promo Code for {{$mission->platform->platform}} platform</p>
            </div>
            <div>
                @if(!$this->completed)
                <a href="/course" type="submit" class=" rounded-lg w-24 bg-indigo-700 shadow-lg text-white px-4 py-2 hover:bg-indigo-500 mt-4 text-center font-semibold focus:outline-none ">
                    Go
                </a>
                @else
                    @if(!$this->claimed)
                    <button wire:click="generatePromotion" type="submit" class=" rounded-lg w-24 bg-orange-700 shadow-lg text-white px-4 py-2 hover:bg-orange-500 mt-4 text-center font-semibold focus:outline-none ">
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