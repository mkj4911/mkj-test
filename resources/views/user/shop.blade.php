<x-app-layout>
    <x-slot name="header">
          <div class="md:flex">
            店舗情報
            <x-flash-message status="session('status')" />
          </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($shop->is_selling)
            <span class="border rounded-full font-semibold text-2xl py-2 px-2 ring-4 ring-indigo-700 bg-indigo-400 text-white">営業中</span>
            @else    
            <span class="border rounded-full font-semibold text-2xl py-2 px-2 ring-4 ring-red-700 bg-red-400 text-white">休業中</span>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="md:flex">
                    <div class="md:w-3/5 text-center mt-4">
                        @if ($shop->filename !== null)
                        <img class="mx-auto w-200 h-80 object-cover rounded-md" src="{{ asset('storage/shops/' . $shop->filename )}}">
                        @else
                        <img class="mx-auto w-200 h-80 object-cover rounded-md" src="">
                        @endif
                        <div class="mt-4">{{ $shop->name }}</div><br>
                        <div>{{ $shop->information}}</div>
                    </div>
                    <div class="md:w-2/5 mx-auto mt-2">
                      <div class="flex justify-between">
                        <div class="text-lg">{{ $calendar->getTitle() }}<span class="text-sm">の定休日</span></div>
                        <div class="flex justify-end items-center"><span class="text-pink-300 text-2xl">■</span><span class="text-sm text-gray-700">は休日となります。</span></div>
                      </div>
                        {!! $calendar->render() !!}
                    </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>