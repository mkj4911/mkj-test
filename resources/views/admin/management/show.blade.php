<x-app-layout>
    <x-slot name="header">
          <div class="md:flex">
            商品の詳細
            <x-flash-message status="session('status')" />
          </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="md:flex justify-around">
                        <div class="md:w-1/3">
                            <div class="swiper-container">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                  <!-- Slides -->
                                <div class="swiper-slide">
                                    @if (empty($product->imageOne->filename))
                                    <img src="{{ asset('images/no_image.jpg') }}">
                                    @else
                                    <img src="{{ asset('storage/products/' . $product->imageOne->filename )}}">
                                    @endif
                                </div>
                                <div class="swiper-slide">
                                    @if (empty($product->imageTwo->filename))
                                    <img src="{{ asset('images/no_image.jpg') }}">
                                    @else
                                    <img src="{{ asset('storage/products/' . $product->imageTwo->filename )}}">
                                    @endif
                                </div>
                                <div class="swiper-slide">
                                    @if (empty($product->imageThree->filename))
                                    <img src="{{ asset('images/no_image.jpg') }}">
                                    @else
                                    <img src="{{ asset('storage/products/' . $product->imageThree->filename )}}">
                                    @endif
                                </div>
                                <div class="swiper-slide">
                                    @if (empty($product->imageFour->filename))
                                    <img src="{{ asset('images/no_image.jpg') }}">
                                    @else
                                    <img src="{{ asset('storage/products/' . $product->imageFour->filename )}}">
                                    @endif
                                </div>
                                <div class="swiper-slide">
                                    @if (empty($product->imageFive->filename))
                                    <img src="{{ asset('images/no_image.jpg') }}">
                                    @else
                                    <img src="{{ asset('storage/products/' . $product->imageFive->filename )}}">
                                    @endif
                                </div>
                                <div class="swiper-slide">
                                    @if (empty($product->imageSix->filename))
                                    <img src="{{ asset('images/no_image.jpg') }}">
                                    @else
                                    <img src="{{ asset('storage/products/' . $product->imageSix->filename )}}">
                                    @endif
                                </div>
                                <div class="swiper-slide">
                                    @if (empty($product->imageSeven->filename))
                                    <img src="{{ asset('images/no_image.jpg') }}">
                                    @else
                                    <img src="{{ asset('storage/products/' . $product->imageSeven->filename )}}">
                                    @endif
                                </div>
                                <div class="swiper-slide">
                                    @if (empty($product->imageEight->filename))
                                    <img src="{{ asset('images/no_image.jpg') }}">
                                    @else
                                    <img src="{{ asset('storage/products/' . $product->imageEight->filename )}}">
                                    @endif
                                </div>
                                <div class="swiper-slide">
                                    @if (empty($product->imageNine->filename))
                                    <img src="{{ asset('images/no_image.jpg') }}">
                                    @else
                                    <img src="{{ asset('storage/products/' . $product->imageNine->filename )}}">
                                    @endif
                                </div>

                                </div>
                                <!-- If we need pagination -->
                                <div class="swiper-pagination"></div>
                              
                                <!-- If we need navigation buttons -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                              
                                <!-- If we need scrollbar -->
                                <div class="swiper-scrollbar"></div>
                              </div>
                        </div>
                        <div class="md:w-1/3 ml-8">
                            <h1 class="mb-4 text-gray-900 text-2xl title-font font-medium">{{ $product->name }}</h1>
                            <p class="mb-4 leading-relaxed text-gray-700">{{ $product->information }}</p>
                        </div>
                        <div class="md:w-1/3 ml-8">
                            <div class="mb-4 flex justify-end ">
                                @if ($product->is_selling)
                                  <span class="border rounded-full py-1 px-2 bg-indigo-400 text-white text-xs">販売中</span>
                                @else    
                                  <span class="border rounded-full py-1 px-2 bg-red-400 text-white text-xs">停止中</span>
                                @endif
                            </div>
                                <div class="mb-2"><span>担当者：</span>{{ $product->member->name }}</div>
                                <div class="mb-2"><span>登録日：</span>{{ date_format($product->created_at, 'Y-m-d')}}</div>
                                    @if ($product->deleted_at)
                                    <div class="mb-2"><span>削除日：</span>{{ date_format($product->deleted_at, 'Y-m-d') }}</div>
                                    @else 
                                    <div class="mb-2"><span>削除日：</span></div>
                                    @endif
                                    <div class="mb-4"><span>現在庫：</span>{{ $quantity }}</div>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="title-font font-medium text-lg text-gray-900"><span class=" text-base text-gray-500">カテゴリー：</span>{{ $product->category->name }}</div>
                                <div><span class="title-font font-medium text-2xl text-gray-900"><span class="text-lg text-gray-500">販売価格：</span>{{ number_format($product->price) }}</span><span class="text-sm text-gray-700">円(税込)</span></div>
                                <div class="border border-t-2 my-4"></div>
                                <h2 class="mt-4 text-lg text-gray-700">商品削除承認処理</h2>
                                <p class="text-sm text-red-700 ml-4">変更したときは更新ボタンを押してください</p>
                                <form method="post" action="{{ route('admin.management.update', ['item' => $product->id]) }}">
                                    @csrf
                                    <div class="flex justify-around">
                                    <div class="flex items-center my-2">
                                        <div><input type="radio" id="ok" name="delete" value="1" class="h-5 w-5" @if($product->delete === 1){ checked } @endif ></div>
                                        <label class="ml-2 text-lg" for="ok">承認</label>
                                    </div>
                                    <div class="flex items-center my-2">
                                        <div><input type="radio" id="ng" name="delete" value="0" class="h-5 w-5" @if($product->delete === 0){ checked } @endif></div>
                                        <label class="ml-2 text-lg" for="ng">未承認</label>
                                    </div>
                                    </div>
                                    <div class="flex p-2 mx-auto justify-around my-4">
                                        <button type="button" onclick="location.href='{{ route('admin.management.index') }}'" class="mx-4 text-white bg-gray-300 h-8 w-36 ring-8 ring-gray-400 rounded-full hover:bg-gray-400 text-lg">戻る</button>
                                        <button type="submit" class="mx-4 text-white bg-gray-500 h-8 w-36 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">更新する</button>
                                    </div>
                                </form>
                        </div>
                    </div>
                    <div>
                        <h2 class="my-4 text-lg text-gray-700">在庫数変動履歴</h2>
                    <table class="table-auto w-full text-left whitespace-no-wrap md:table-fixed">
                        <thead>
                          <tr>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-200">処理日</th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-200">処理区分</th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-200">数量</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($stocks as $stock)
                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">{{ $stock->created_at }}</td>
                                    @if($stock->type === 1)<td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">事務処理：追加</td>@endif
                                    @if($stock->type === 2)<td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">事務処理：削減</td>@endif
                                    @if($stock->type === 3)<td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">販売：削減</td>@endif
                                    @if($stock->type === 4)<td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">販売：キャンセル</td>@endif
                                    @if($stock->type === 5)<td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">事務処理：販売戻し</td>@endif
                                    <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">{{ $stock->quantity }}個@if($stock->quantity === 0)
                                    <span class="text-red-700 ml-8">商品情報編集</span>@endif</td>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/swiper.js') }}"></script>
</x-app-layout>