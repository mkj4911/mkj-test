<x-app-layout>
    <x-slot name="header">
          <div class="md:flex">
            商品登録
            <x-flash-message status="session('status')" />
          </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="post" action="{{ route('member.products.store')}}">
                    @csrf
                    <div class="-m-2">
                        <div class="p-2 md:w-1/2 mx-auto">
                            <div class="relative">
                              <label for="name" class="leading-7 text-sm text-gray-600">商品名 ※必須</label>
                              <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <div class="p-2 md:w-1/2 mx-auto">
                            <div class="relative">
                              <label for="information" class="leading-7 text-sm text-gray-600">商品情報 ※必須</label>
                              <textarea id="information" name="information" rows="10" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('information') }}</textarea>
                            </div>
                        </div>
                        <div class="p-2 md:w-1/2 mx-auto">
                            <div class="relative">
                              <label for="price" class="leading-7 text-sm text-gray-600">価格 ※必須</label>
                              <input type="number" id="price" name="price" value="{{ old('price') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <div class="p-2 md:w-1/2 mx-auto">
                            <div class="relative">
                              <label for="sort_order" class="leading-7 text-sm text-gray-600">表示順</label>
                              <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <div class="p-2 md:w-1/2 mx-auto">
                            <div class="relative">
                              <label for="quantity" class="leading-7 text-sm text-gray-600">初期在庫 ※必須</label>
                              <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              <span class="text-sm">0～99の範囲で入力してください</span>
                            </div>
                        </div>
                        <div class="p-2 md:w-1/2 mx-auto">
                            <div class="relative">
                                <label for="category" class="leading-7 text-sm text-gray-600">カテゴリー</label>
                                <select name="category" id="category" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    @foreach($categories as $category)
                                      <optgroup label="{{ $category->name }}">
                                        @foreach($category->secondary as $secondary)
                                        <option value="{{ $secondary->id}}">
                                            {{ $secondary->name }}
                                        </option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <x-select-image :images="$images" name="image1" />
                            <x-select-image :images="$images" name="image2" />
                            <x-select-image :images="$images" name="image3" />
                            <x-select-image :images="$images" name="image4" />
                            <x-select-image :images="$images" name="image5" />
                            <x-select-image :images="$images" name="image6" />
                            <x-select-image :images="$images" name="image7" />
                            <x-select-image :images="$images" name="image8" />
                            <x-select-image :images="$images" name="image9" />
                            <x-select-image :images="$images" name="image10"/>
                        </div>
                        <div class="p-2 w-1/2 mx-auto">
                            <div class="relative flex justify-around">
                                <div><input type="radio" name="is_selling" value="1" class="mr-2" checked >販売中</div>
                                <div><input type="radio" name="is_selling" value="0" class="mr-2" >停止中</div>
                            </div>
                        </div>
                        <div class="p-2 w-full flex justify-around mt-4">
                            <button type="button" onclick="location.href='{{ route('member.products.index') }}'" class="text-white bg-gray-300 h-8 w-36 ring-8 ring-gray-400 rounded-full hover:bg-gray-400 text-lg">戻る</button>
                            <button type="submit" class="text-white bg-gray-500 h-8 w-36 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">登録する</button>
                        </div>
                    </div>
                    </form>    
                </div>
            </div>
        </div>
    </div>
    <script>
    'use strict'
        const images = document.querySelectorAll('.image') //全てのimageタグを取得
        images.forEach(image => { // 1つずつ繰り返す
        image.addEventListener('click', function(e){ // クリックしたら
        const imageName = e.target.dataset.id.substr(0, 6) //data-idの6文字
        const imageId = e.target.dataset.id.replace(imageName + '_', '') // 6文字カット
        const imageFile = e.target.dataset.file
        const imagePath = e.target.dataset.path
        const modal = e.target.dataset.modal
        // サムネイルと input type=hiddenのvalueに設定
        document.getElementById(imageName + '_thumbnail').src = imagePath + '/' + imageFile
        document.getElementById(imageName + '_hidden').value = imageId
        MicroModal.close(modal); //モーダルを閉じる
        },)
     })
    </script>
</x-app-layout>