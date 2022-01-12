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
                        <div class="md:flex md:items-end mb-2 border-b" >
                            <div class="md:w-2/12">
                                @if ($history->filename !== null)
                                <img class="rounded-md md:w-32 md:h-20 w-40 h-20" src="{{ asset('storage/products/' . $history->filename )}}">
                                @else
                                <img src="">
                                @endif
                            </div>
                            <div class="md:w-2/12"><span class="text-xs text-gray-700">商品名：</span>{{ $history->product_name }}</div>
                            <div class="md:w-2/12"><span class="text-xs text-gray-700">　単価：</span>{{ number_format($history->price) }}<span class="text-sm text-gray-700">円(税込)</span></div>
                            <div class="md:w-2/12"><span class="text-xs text-gray-700">　数量：</span>{{ $history->quantity }}個</div>
                            <div class="md:w-2/12"><span class="text-xs text-gray-700">　合計：</span>{{ number_format($history->quantity * $history->price) }}<span class="text-sm text-gray-700">円(税込)</span></div>
                            <div class="md:w-2/12"><span class="text-xs text-gray-700">購入日：</span>{{ date('Y-m-d', strtotime($history->created_at)) }}</div>
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