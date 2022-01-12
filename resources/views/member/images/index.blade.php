<x-app-layout>
    <x-slot name="header">
          <div class="md:flex">
            商品画像管理
            <x-flash-message status="session('status')" />
          </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-end mb-4">  
                        <button onclick="location.href='{{ route('member.images.create') }}'" class="text-white bg-gray-500 h-8 w-36 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">新規登録する</button>
                    </div>
                    <div class="flex flex-wrap">
                        @foreach ($images as $image )
                        <div class="md:w-1/4 p-4">
                            <a href="{{ route('member.images.edit', ['image' => $image->id]) }}">
                            <div class="border rounded-md p-4">   
                                <div class=" hover:animate-pulse"><x-thumbnail :filename="$image->filename" type="products" /></div>
                                <div class="text-gray-700 ">{{ $image->title }}</div>    
                            </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    {{ $images->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
