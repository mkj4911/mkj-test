<x-app-layout>
  <x-slot name="header">
        <div class="md:flex">
          店舗情報
          <x-flash-message status="session('status')" />
        </div>
  </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($shops as $shop )
                    <div class="md:flex items-start">
                      <div class="md:w-1/2 md:mt-8">
                      <a href="{{ route('admin.shops.edit', ['shop' => $shop->id]) }}">
                      <div class="border rounded-md p-4 hover:animate-pulse">
                        <div class="mb-4">
                        <div class="flex justify-between items-center">
                          <div class="text-xl">{{ $shop->name }}</div>
                        @if ($shop->is_selling)
                          <span class="border rounded-full py-2 px-4 bg-indigo-400 text-white">営業中</span>
                        @else    
                          <span class="border rounded-full py-2 px-4 bg-red-400 text-white">休業中</span>
                        @endif
                        </div>     
                      </div>
                        <x-thumbnail :filename="$shop->filename" type="shops" />
                      </div>
                      </a>
                      </div>
                    @endforeach
                    <div class="md:w-1/2 hover:animate-pulse">
                      <a href="{{ route('admin.holiday.index')}}">
                      <div class="text-lg md:ml-8">{{ $calendar->getTitle() }}</div>
                      {!! $calendar->render() !!}
          						<div class="flex justify-end items-center"><span class="text-pink-300 text-2xl">■</span><span>は休日となります。</span></div>	
                      </a>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
