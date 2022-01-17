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
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-100">販売日</th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-100">処理区分</th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-100"></th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-100"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $sale)
                                <tr>
                                <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">{{ $sale->product_name }}</td>
                                <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">{{ number_format($sale->price) }}<span class="text-xs md:text-sm text-gray-700">円</span></td>
                                <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">{{ $sale->quantity }}個</td>
                                <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">{{ date('Y-m-d', strtotime($sale->created_at)) }}</td>
                                @if ($sale->processing === 0)
                                <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm font-semibold text-indigo-700">処理済</td>
                                @else    
                                <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm font-semibold text-red-700">未処理</td>
                                @endif
                                <td class="md:px-4 py-2 border-b-2 text-xs md:text-sm">
                                    <button onclick="location.href='{{ route('member.sales.edit', ['sale' => $sale->id]) }}'" class="text-xs md:text-sm text-white bg-gray-400 border-0 py-2 px-4 focus:outline-none hover:bg-gray-600 rounded">販売処理</button>
                                </td>
                                <form id="delete_{{$sale->id}}" method="post" action="{{ route('member.sales.destroy', ['sale' => $sale->id]) }}">
                                    @csrf
                                    <td class="px-4 py-3 border-b-2">
                                        <a href="#" data-id="{{ $sale->id }}" onclick="deletePost(this)" class="text-xs md:text-sm text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-600 rounded">販売キャンセル</a>
                                    </td>
                                </form>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deletePost(e) {
        'use strict';
        if (confirm('販売をキャンセルしてもいいですか?')) {
        document.getElementById('delete_' + e.dataset.id).submit();
        }
    }
    </script>
</x-app-layout>