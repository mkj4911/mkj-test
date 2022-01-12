<x-app-layout>
    <x-slot name="header">
          <div class="md:flex">
            休日設定
            <x-flash-message status="session('status')" />
          </div>
    </x-slot>

    <div class="container px-5 py-6 mx-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-100">
    　　　       <div class="text-lg">{{ $calendar->getTitle() }}</div>
                    <div class="py-2">
                        {!! $calendar->render() !!}
                    </div> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>