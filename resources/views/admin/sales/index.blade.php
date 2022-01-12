<x-app-layout>
    <x-slot name="header">
        <div class="md:flex">
          販売履歴
          <x-flash-message status="session('status')" />
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full text-left whitespace-no-wrap">
                        <thead>
                          <tr>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-100 ">商品名</th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-100">単価</th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-100">数量</th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-100">合計金額</th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-100">販売日</th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-100">お客様名</th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-100">担当者名</th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-100">処理区分</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $sale)
                                <tr>
                                <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">{{ $sale->product_name }}</td>
                                <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">{{ number_format($sale->price) }}<span class="text-xs md:text-sm text-gray-700">円</span></td>
                                <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">{{ $sale->quantity }}個</td>
                                <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">{{ number_format($sale->quantity * $sale->price) }}<span class="text-xs md:text-sm text-gray-700">円</span></td>
                                <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">{{ date('Y-m-d', strtotime($sale->created_at)) }}</td>
                                <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">{{ $sale->user_name }}</td>
                                <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">{{ $sale->member_name }}</td>
                                {{-- <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">{{ $sale->processing }}</td> --}}
                                @if ($sale->processing === 0)
                                <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm font-semibold text-indigo-700">処理済</td>
                                @else    
                                <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm font-semibold text-red-700">未処理</td>
                                @endif
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>