<x-app-layout>
    <x-slot name="header">
          <div class="md:flex">
            カート
            <x-flash-message status="session('status')" />
          </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(count($products) > 0)
                      @foreach($products as $product)
                        <div class="md:flex md:items-end mb-2 border-b" >
                            <div class="md:w-2/12">
                                @if ($product->imageOne->filename !== null)
                                <img class="rounded-md w-40 h-20" src="{{ asset('storage/products/' . $product->imageOne->filename )}}">
                                @else
                                <img src="">
                                @endif
                            </div>
                            <div class="md:w-2/12 md:ml-4">{{ $product->name }}</div>
                            <div class="md:w-2/12">{{ number_format($product->price) }}<span class="text-sm text-gray-700">円(税込)</span></div>
                                <div class="md:w-1/12 md:px-8">{{ $product->pivot->quantity }}個</div>
                                <div class="md:w-3/12 md:px-20">{{ number_format($product->pivot->quantity * $product->price) }}<span class="text-sm text-gray-700">円(税込)</span></div>    
                            <div class="md:w-2/12">
                                <form method="post" action="{{ route('user.cart.delete', ['item' => $product->id])}}">
                                    @csrf
                                    <button class="flex ml-12 hover:animate-pulse">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span class="text-red-700 font-medium">削除</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                      @endforeach
                      <div class="flex justify-end my-12">
                        <div class="my-2">
                            合計金額: <span class="text-2xl">{{ number_format($totalPrice)}}</span><span class="text-sm text-gray-700">円(税込)</span>
                        </div>
                        <div>
                            <button class="text-white bg-gray-500 h-8 w-36 mx-8 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg" onclick="location.href='{{ route('user.cart.checkout')}}'">購入する</button>
                        </div>
                      </div>
                    @else
                      カートに商品が入っていません。
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>