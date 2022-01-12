<x-app-layout>
    <x-slot name="header">
        <div class="md:flex">
            販売履歴編集
            <x-flash-message status="session('status')" />
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="md:flex">
                        <div class="md:w-1/2">aaa</div>
                        <div class="md:w-1/2">{{ $sale->id }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>