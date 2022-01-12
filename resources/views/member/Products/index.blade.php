<x-app-layout>
    <x-slot name="header">
          <div class="md:flex">
            商品管理
            <x-flash-message status="session('status')" />
          </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-end mb-4">  
                        <button onclick="location.href='{{ route('member.products.create') }}'" class="text-white bg-gray-500 h-8 w-36 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">新規登録する</button>
                    </div>
                    <div class="flex flex-wrap">
                        @foreach ($memberInfo as $member )
                         @foreach ($member->product as $product)
                            <div class="md:w-1/4 p-2 md:p-4">
                                <a href="{{ route('member.products.edit', ['product' => $product->id]) }}">
                                <div class="border rounded-md p-2 md:p-4 hover:bg-gray-100 hover:shadow-lg"> 
                                    <div class="mb-4">
                                        @if ($product->is_selling)
                                          <span class="border rounded-full py-2 px-4 bg-indigo-400 text-white text-xs">販売中</span>
                                        @else    
                                          <span class="border rounded-full py-2 px-4 bg-red-400 text-white text-xs">停止中</span>
                                        @endif
                                    </div>   
                                    <div class=" hover:animate-pulse"><x-thumbnail filename="{{$product->imageOne->filename ?? ''}}" type="products" /></div>
                                    <div class="text-gray-700">{{ $product->name }}</div>
                                </div>
                                </a>
                            </div>
                         @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>