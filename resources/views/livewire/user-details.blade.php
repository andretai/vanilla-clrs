<div class="bg-indigo-700 px-32 p-10">
    <h2 class="text-4xl text-white font-semibold pt-8">User Details</h2>
</div>
<!-- component -->
<div class="px-32 p-10">
    
    <div class="grid grid-cols-12 ">

        <div class="col-span-12 md:border-solid md:border-l md:border-black md:border-opacity-25 h-full pb-12 md:col-span-10">
            <div class="px-4 pt-4">
                <form action="#" class="flex flex-col space-y-8">

                    <div>
                        <h3 class="text-3xl font-semibold">Basic Information</h3>
                        <hr>
                    </div>

                    <div class="form-item">
                        <label class="text-2xl font-semibold">Full Name</label>
                        <input type="text" value="{{$user->name}}" class="w-full appearance-none text-black text-lg rounded shadow py-3 px-2  mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 " disabled>
                    </div>

                    <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-4">

                        <div class="form-item w-full">
                            <label class="text-2xl font-semibold">Username</label>
                            <input type="text" value="{{$user->name}}" class="w-full appearance-none text-black text-lg rounded shadow py-3 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200" disabled>
                        </div>

                        <div class="form-item w-full">
                            <label class="text-2xl font-semibold">Email</label>
                            <input type="text" value="{{$user->email}}" class="w-full appearance-none text-black text-lg rounded shadow py-3 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200" disabled>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>