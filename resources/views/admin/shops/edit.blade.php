<x-app-layout>
    <x-slot name="header">
        <div class="md:flex">
            店舗情報編集
            <x-flash-message status="session('status')" />
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="post" action="{{ route('admin.shops.update', ['shop' => $shop->id])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="-m-2">
                        <div class="p-2 md:w-1/2 mx-auto">
                            <div class="relative">
                              <label for="name" class="leading-7 text-sm text-gray-600">店名 ※必須</label>
                              <input type="text" id="name" name="name" value="{{ $shop->name }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <div class="p-2 md:w-1/2 mx-auto">
                            <div class="relative">
                              <label for="information" class="leading-7 text-sm text-gray-600">店舗情報 ※必須</label>
                              <textarea id="information" name="information" rows="10" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $shop->information }}</textarea>
                            </div>
                        </div>
                        <div class="md:w-1/2 p-2 mx-auto rounded-md">
                            <x-thumbnail :filename="$shop->filename" type="shops" />
                        </div>
                        <div class="p-2 md:w-1/2 mx-auto">
                          <div class="relative">
                            <label for="image" class="leading-7 text-sm text-gray-600">画像</label>
                            <input type="file" id="image" name="image" accept="image/png,image/jpeg,image/jpg" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>
                        <div class="p-2 md:w-1/2 mx-auto">
                          <div class="relative flex justify-around">
                              <div><input type="radio" name="is_selling" value="1" class="mr-2 h-5 w-5" @if($shop->is_selling === 1){ checked } @endif>営業中</div>
                              <div><input type="radio" name="is_selling" value="0" class="mr-2 h-5 w-5" @if($shop->is_selling === 0){ checked } @endif>休業中</div>
                          </div>
                        </div>
                        <div class="p-2 w-full flex justify-around mt-4">
                            <button type="button" onclick="location.href='{{ route('admin.shops.index') }}'" class="text-white bg-gray-300 h-8 w-36 ring-8 ring-gray-400 rounded-full hover:bg-gray-400 text-lg">戻る</button>
                            <button type="submit" class="text-white bg-gray-500 h-8 w-36 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">更新する</button>
                        </div>
                    </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
