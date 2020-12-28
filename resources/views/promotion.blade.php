@extends('layouts.app')

@section('content')
<div class="bg-indigo-700 px-32 p-10">
    <h2 class="text-4xl text-white font-semibold pt-8">Promotion</h2>
</div>
<div class="px-32 p-10">
    <div class="divide-y divide-black">
        <div class="flex py-3">
            <div class="pr-5">
                <img class="overflow-hidden h-auto w-64 object-cover" src="/images/udemy.png" :alt="">
            </div>
            <div class="px-5 w-3/5">
                <h2 class=" font-bold text-3xl text-gray-900">Udemy Platform</h2>
                <div class="flex mt-1">
                    <p class="pr-5 font-semibold text-2xl">Promo Code:</p>
                    <p class="font-semibold text-orange-600 text-2xl">UDEMYCLRS10</p>
                </div>
                <p class="text-xl capitalize mb-5"> Get 10% discount for best Udemy courses with coupon codes that guarantee great savings up to 50USD.</p>
                <a href="https://www.udemy.com/" target="_blank" class="inline-block px-3 py-2 border rounded text-white bg-indigo-700 border-white hover:border-transparent hover:bg-indigo-500 lg:mt-0">Go to the Platform<i class="fas fa-info-circle ml-2"></i></a>

            </div>
        </div>
        <div class="flex py-3">
            <div class="pr-5">
                <img class="overflow-hidden h-auto w-64 object-cover" src="/images/futurelearn.jpg" :alt="">
            </div>
            <div class="px-5 w-3/5">
                <h2 class=" font-bold text-3xl text-gray-900">FutureLearn Platform</h2>
                <div class="flex mt-1">
                    <p class="pr-5 font-semibold text-2xl">Promo Code:</p>
                    <p class="font-semibold text-orange-600 text-2xl">FLCLRS10</p>
                </div>
                <p class="text-xl capitalize mb-5"> Get 10% discount for best futurelearn courses with coupon codes that guarantee great savings up to 50USD.</p>
                <a href="https://www.futurelearn.com/" target="_blank" class="inline-block px-3 py-2 border rounded text-white bg-indigo-700 border-white hover:border-transparent hover:bg-indigo-500 lg:mt-0">Go to the Platform<i class="fas fa-info-circle ml-2"></i></a>
            </div>

        </div>
    </div>
</div>

<div class="px-32 pt-10">
    <h2 class="text-5xl text-indigo-700 font-bold pt-8">Newsletter</h2>
</div>
<div class="px-32 pt-3 pb-10">
    
    <div class="divide-y divide-black">
        <div class="w-4/5 pb-3">
            <h2 class=" font-bold text-3xl text-gray-900">November 2020 Customer Newsletter</h2>

            <p class="text-xl capitalize mb-5"> What’s new this month from Udemy for Business Featured content The 2021 Workplace Learning Trends Report After the unpredictable challenges we faced in the workplace this year, the future of work and learning can seem more uncertain...</p>

            <a href="https://ufbsupport.udemy.com/hc/en-us/articles/360060226553-November-2020-Customer-Newsletter
" target="_blank" class="inline-block px-3 py-2 border rounded text-white bg-indigo-700 border-white hover:border-transparent hover:bg-indigo-500 lg:mt-0">Read Article<i class="fas fa-info-circle ml-2"></i></a>
        </div>
        <div class="w-4/5 pb-3">
            <h2 class=" font-bold text-3xl text-gray-900">October 2020 Customer Newsletter</h2>

            <p class="text-xl capitalize mb-5"> What’s new this month from Udemy for Business FEATURED UPDATE Get (even more) familiar with Udemy for Business Last month we shared a tutorial video for your employees…this month, check out this short refresher on key features...
</p>

            <a href="https://www.futurelearn.com/" target="_blank" class="inline-block px-3 py-2 border rounded text-white bg-indigo-700 border-white hover:border-transparent hover:bg-indigo-500 lg:mt-0">Read Article<i class="fas fa-info-circle ml-2"></i></a>
        </div>
        <div class="w-4/5" pb-3>
            <h2 class=" font-bold text-3xl text-gray-900">September 2020 Customer Newsletter</h2>

            <p class="text-xl capitalize mb-5"> What’s new this month from Udemy for Business: COURSE SPOTLIGHT This Month's Hottest Skills Swift 5 ProgrammingInstructor: Nick WalterSwift 5, the newly released iOS programming language, is a game-changer for mobile app development. Udemy for Business instructor...
</p>

            <a href="https://www.futurelearn.com/" target="_blank" class="inline-block px-3 py-2 border rounded text-white bg-indigo-700 border-white hover:border-transparent hover:bg-indigo-500 lg:mt-0">Read Article<i class="fas fa-info-circle ml-2"></i></a>
        </div>
    </div>

</div>
@endsection