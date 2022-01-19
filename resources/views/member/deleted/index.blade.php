<x-app-layout>
    <x-slot name="header">
          <div class="md:flex">
            削除済み商品一覧
            <x-flash-message status="session('status')" />
          </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-wrap">
                        @if(count($deletedProducts) > 0)
                        @foreach($deletedProducts as $product)
                            <div class="md:w-1/4 p-2 md:p-4">
                                <div class="border rounded-md p-2 md:p-4">    
                                    <x-thumbnail filename="{{$product->imageOne->filename ?? ''}}" type="products" />
                                    <div class="text-gray-700">{{ $product->name }}</div>
                                    <div class="text-gray-700">{{ $product->deleted_at->diffForHumans() }}</div>
                                    <div class="flex justify-end mt-4 mb-2">
                                    <form id="update_{{$product->id}}" method="post" action="{{ route('member.deleted.update', ['item' => $product->id]) }}">
                                        @csrf
                                            <a href="#" data-id="{{ $product->id }}" onclick="updatePost(this)" class="text-white text-sm bg-gray-400 border-0 py-2 px-8 md:px-4 focus:outline-none hover:bg-gray-600 rounded">復元</a>
                                    </form>
                                    @if ($product->delete === 1)
                                    <form id="delete_{{$product->id}}" method="post" action="{{ route('member.deleted.destroy', ['item' => $product->id]) }}">
                                        @csrf
                                            <a href="#" data-id="{{ $product->id }}" onclick="deletePost(this)" class="text-white text-sm bg-red-400 border-0 py-2 px-8 md:px-4 ml-4 focus:outline-none hover:bg-red-600 rounded">削除</a>
                                    </form>
                                    @else
                                        <p class="text-red-700 font-semibold mx-4 animate-pulse">削除申請中</p>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                        削除されている商品はありません。
                      @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updatePost(e) {
        'use strict';
        if (confirm('復元しますか?')) {
        document.getElementById('update_' + e.dataset.id).submit();
        }
    }
        function deletePost(e) {
        'use strict';
        if (confirm('本当に削除してもいいですか?')) {
        document.getElementById('delete_' + e.dataset.id).submit();
        }
    }
    </script>
</x-app-layout>