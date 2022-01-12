<x-app-layout>
    <x-slot name="header">
        <div class="md:flex">
          販売処理
          <x-flash-message status="session('status')" />
        </div>
  </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <div class="md:flex">
                    <div class="md:w-1/3 justify-around">
                        @foreach ($sales as $sale )
                        <div class="flex justify-around">
                            @if ($sale->filename !== null)
                                <img class="rounded-md md:w-80 md:h-60 w-60 h-40" src="{{ asset('storage/products/' . $sale->filename )}}">
                            @else
                                <img src="">
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <div class="md:w-1/3">
                        @foreach ($sales as $sale)
                            <div class="md:ml-2"><span>販売日：</span>{{ date('Y-m-d', strtotime($sale->created_at)) }}</div>
                            <div class="md:ml-2"><span>商品名：</span>{{ $sale->product_name }}</div>
                            <div class="md:ml-2"><span>　単価：</span>{{ number_format($sale->price) }}<span class="text-xs md:text-sm text-gray-700">円</span></div>
                            <div class="md:ml-2"><span>　数量：</span>{{ $sale->quantity }}</div>
                            <div class="md:ml-2"><span>　合計：</span>{{ number_format($sale->quantity * $sale->price) }}<span class="text-xs md:text-sm text-gray-700">円</span></div>
                            <div class="border-t-2 my-4"></div>
                            <div class="md:ml-2"><span>　 お客様名：</span>{{ $sale->user_name }}</div>
                            <div class="md:ml-2"><span>メールアドレス：</span>{{ $sale->user_email }}</div>
                        @endforeach
                    </div>
                    <div class="md:w-1/3 md:border-l-2">
                        <h2 class="flex justify-around text-lg my-8">販売処理</h2>
                        <form method="post" action="{{ route('member.sales.update', ['sale' => $sale->id])}}" enctype="multipart/form-data">
                            @csrf
                        @foreach ($sales as $sale)
                            <div class="relative flex justify-evenly mb-8">
                                <div class="flex">
                                <div><input type="radio" id="ng" name="processing" value="1" class="h-5 w-5" @if($sale->processing === 1){ checked } @endif ></div>
                                <label class="ml-2" for="ng">未処理</label>
                                </div>
                                <div class="flex">
                                <div><input type="radio" id="ok" name="processing" value="0" class="h-5 w-5" @if($sale->processing === 0){ checked } @endif></div>
                                <label class="ml-2" for="ok">処理済</label>
                                </div>
                            </div>
                                <div class="p-2 w-full flex justify-around my-12">
                                    <button type="button" onclick="location.href='{{ route('member.sales.index') }}'" class="text-white bg-gray-300 h-8 w-36 ring-8 ring-gray-400 rounded-full hover:bg-gray-400 text-lg">戻る</button>
                                    <button type="submit" class="text-white bg-gray-500 h-8 w-36 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">更新する</button>
                                </div>
                            
                        @endforeach
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>