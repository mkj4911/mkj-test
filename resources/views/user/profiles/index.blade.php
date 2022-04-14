<x-app-layout>
    <x-slot name="header">
        <div class="md:flex">
          お客様情報
          <x-flash-message status="session('status')" />
        </div>
  </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
        				  <form method="post" action="{{ route('user.profiles.update')}}" enctype="multipart/form-data">
                    @csrf

                  <div class="md:flex justify-around">
                    
                    <div class="md:w-2/3">

                        <div class="md:flex flex-col mb-2">
                          <label class="px-2" for="name">お客様名</label>
                          <input type="text" name="name"  id="name" placeholder="郵便番号..." value="{{ $profile->user->name }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                        </div>
                        <div class="flex flex-col mb-2">
                          <label class="px-2" for="">メールアドレス</label>
                          <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $profile->user->email }}</div>
                        </div>
                        <div class="md:flex flex-col ">
                          <label class="px-2" for="zipcode">郵便番号</label>
                          <input type="text" name="zipcode"  id="zipcode" placeholder="郵便番号..." value="{{ $profile->zipcode ?? ''}}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                        </div>
                        <div class="md:flex flex-col ">
                          <label class="px-2" for="address1">住所1</label>
                          <input type="text" name="address1"  id="address1" placeholder="住所1..." value="{{ $profile->address1 ?? ''}}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                        </div>
                        <div class="md:flex flex-col ">
                          <label class="px-2" for="zipcode">住所2</label>
                          <input type="text" name="zipcode"  id="zipcode" placeholder="郵便番号..." value="{{ $profile->zipcode ?? ''}}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                        </div>
                        <div class="md:flex flex-col ">
                          <label class="px-2" for="zipcode">電話番号1</label>
                          <input type="text" name="zipcode"  id="zipcode" placeholder="郵便番号..." value="{{ $profile->zipcode ?? ''}}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                        </div>
                        <div class="md:flex flex-col ">
                          <label class="px-2" for="zipcode">電話番号2</label>
                          <input type="text" name="zipcode"  id="zipcode" placeholder="郵便番号..." value="{{ $profile->zipcode ?? ''}}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                        </div>
                      
                    </div>
                    <div class="md:w-1/3 md:ml-4 mt-4">

                        @if (empty($profile->image))
                          <img class="mx-auto w-40 h-40 mb-2 object-cover rounded-full"  src="{{ asset('images/no_face.jpg') }}">
                        @else
                          <img class="mx-auto w-60 h-40 mb-2 rounded-md" src="{{ asset('storage/users/' . $profile->image )}}">
                        @endif 

                        <input type="hidden" name="old_image" value="{{ $profile->image }}">
                        <div class="relative mb-2">
                          <label for="image" class="leading-7 text-sm text-gray-600">画像変更</label>
                          <input type="file" id="image" name="image" accept="image/png,image/jpeg,image/jpg" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>

                        <div class="flex justify-center">
                            <button type="submit" class="text-white bg-gray-500 h-8 w-36 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">登録する</button>
                        </div>
                    
                    </div>
                  </div>

                  </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>