<x-app-layout>
    <x-slot name="header">
          <div class="md:flex">
            購入履歴
            <x-flash-message status="session('status')" />
          </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(count($historys) > 0)
                      @foreach($historys as $history)
                        <div class="md:flex md:items-center">
                            <div class="md:w-2/12">
                                @if ($history->filename !== null)
                                <img class="round ed-md md:w-32 md:h-20 w-40 h-20" src="{{ asset('storage/products/' . $history->filename )}}">
                                @else 
                                <img src=""> 
                                @endif
                            </div>
                            <div class="md:w-2/12 pt-8"><span class="text-xs text-gray-700">商品名：</span>{{ $history->product_name }}</div>
                            <div class="md:w-2/12 pt-8"><span class="text-xs text-gray-700">　単価：</span>{{ number_format($history->price) }}<span class="text-sm text-gray-700">円(税込)</span></div>
                            <div class="md:w-2/12 pt-8"><span class="text-xs text-gray-700">　数量：</span>{{ $history->quantity }}個</div>
                            <div class="md:w-2/12 pt-8"><span class="text-xs text-gray-700">　合計：</span>{{ number_format($history->quantity * $history->price) }}<span class="text-sm text-gray-700">円(税込)</span></div>
                            <div class="md:w-2/12 pt-8"><span class="text-xs text-gray-700">購入日：</span>{{ date('Y-m-d', strtotime($history->created_at)) }}</div>
                        </div>
                        <div class="flex justify-end border-b my-2">
                          <p class="mb-4"><a class="border rounded-full px-4 ml-4 hover:bg-gray-200" href="{{ route('user.items.show', ['item' => $history->product_id])}}">商品詳細を見る</a></p>
                          <p class="mb-4"><a class="border rounded-full px-4 ml-4 hover:bg-gray-200" href="{{ route('user.history.edit', ['sale_id' => $history->id]) }}">Reviewを書く</a></p>
                        </div>
                        @endforeach
                    @else
                        履歴はありません。
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>