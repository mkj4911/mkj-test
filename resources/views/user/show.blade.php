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
                        <div class="md:w-1/2">
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
                        <div class="md:w-1/2 ml-8">
                            <button type="button" onclick="history.back()" class="flex mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                <span class="text-gray-700 font-medium">戻る</span>
                            </button>
                            <h2 class="mb-4 text-sm title-font text-gray-500 tracking-widest">{{ $product->category->name }}</h2>
                            <h1 class="mb-4 text-gray-900 text-3xl title-font font-medium">{{ $product->name }}</h1>
                            <p class="mb-4 leading-relaxed">{{ $product->information }}</p>
                            <div class="flex justify-around items-center">
                                <div>
                                    <span class="title-font font-medium text-2xl text-gray-900">{{ number_format($product->price) }}</span><span class="text-sm text-gray-700">円(税込)</span>
                                </div>
                                <form method="post" action="{{ route('user.cart.add') }}">
                                    @csrf
                                <div class="flex justify-around items-center">
                                    <span class="mr-2">数量</span>
                                    <div class="relative mr-4">
                                    <select name="quantity" class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10">
                                        @for ( $i = 1; $i <= $quantity; $i++ )
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                    </div>
                                <button class="text-white bg-gray-500 h-8 w-36 ring-8 ml-4 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">カートに入れる</button>
                                </div>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="border-t border-gray-400 my-8"></div>
                    <div class="mb-4 text-center">この商品を販売しているショップ</div>
                    <div class="mb-4 text-center">{{ $product->shop->name }}</div>
                    <div class="mb-8 text-center">
                        @if ($product->shop->filename !== null)
                        <img class="mx-auto w-120 h-60 object-cover rounded-md" src="{{ asset('storage/shops/' . $product->shop->filename )}}">
                        @else
                        <img class="mx-auto w-120 h-60 object-cover rounded-md" src="">
                        @endif
                    </div>
                    <div class="mb-4 text-center">
                        <button data-micromodal-trigger="modal-1" href='javascript:;' type="button" class="text-white bg-gray-400 border-0 py-2 px-6 focus:outline-none hover:bg-gray-600 rounded">ショップの詳細を見る</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
        <div class="modal__overlay z-50" tabindex="-1" data-micromodal-close>
          <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
              <h2 class="text-xl text-gray-700" id="modal-1-title">
                {{ $product->shop->name }}
              </h2>
              <button type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
              <p>
                {{ $product->shop->information }}
              </p>
              <div class="text-lg">{{ $calendar->getTitle() }}</div>
              <div class="py-2">
                  {!! $calendar->render() !!}
              </div> 
            </main>
            <footer class="modal__footer">
              <button type="button" class="modal__btn" data-micromodal-close aria-label="Close this dialog window">閉じる</button>
            </footer>
          </div>
        </div>
      </div> --}}
    <script src="{{ mix('js/swiper.js') }}"></script>
</x-app-layout>