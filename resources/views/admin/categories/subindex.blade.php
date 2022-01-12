<x-app-layout>
    <x-slot name="header">
          <div class="md:flex">
            セカンダリカテゴリー一覧
            <x-flash-message status="session('status')" />
          </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl md:mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:p-6 bg-white border-b border-gray-200">     
                    <section class="text-gray-600 body-font">
                      <div class="my-2 mx-4 text-2xl"><span class="text-sm text-gray-700">プライマリカテゴリー名：</span>{{$primary->name}}</div>
                        <div class="container md:px-5 md:mx-auto mx-2">
                            <form method="post" action="{{ route('admin.categories.substore', ['primary' => $primary->id]) }}">
                              @csrf
                            <div class="md:flex items-center">
                              <div class="p-2">
                                <div class="flex flex-col mx-4">
                                  <label for="name" class="leading-7 text-sm text-gray-600">セカンダリカテゴリー名</label>
                                  <input type="text" id="name" name="name" value="{{ old('name') }}" required class="bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                              </div>
                              <div class="p-2">
                                <div class="flex flex-col mx-4">
                                  <label for="sort_order" class="leading-7 text-sm text-gray-600">並び順</label>
                                  <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order') }}" required class="bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                              </div>
                              <div class="p-2">
                                <div class="flex flex-col">
                                  {{-- <label for="primary_category_id" class="leading-7 text-sm text-gray-600">現在の在庫</label> --}}
                                  <input type="hidden" id="primary_category_id" name="primary_category_id" value="{{ $primary->id }}">
                                </div>
                              </div>
                              <div class="p-2 mx-auto justify-around my-4">
                                <button type="button" onclick="location.href='{{ route('admin.categories.index') }}'" class="mx-4 text-white bg-gray-300 h-8 w-36 ring-8 ring-gray-400 rounded-full hover:bg-gray-400 text-lg">戻る</button>
                                <button type="submit" class="mx-4 text-white bg-gray-500 h-8 w-36 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">登録する</button>
                              </div>
                             </div>
                            </form>
                            <div class="lg:w-3/3 w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                              <thead>
                                <tr>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">カテゴリー名</th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">並び順</th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">作成日</th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($primaries as $secondary)
                                    <tr>
                                    <td class="md:px-4 py-3">{{ $secondary->name }}</td>
                                    <td class="md:px-4 py-3">{{ $secondary->sort_order }}</td>
                                    <td class="md:px-4 py-3">{{ date_format($secondary->created_at, 'Y-m-d')}}</td>
                                    <form id="delete_{{$secondary->id}}" method="post" action="{{ route('admin.categories.subdestroy', ['secondary' => $secondary->id]) }}">
                                      @csrf
                                      @method('delete')
                                      <td class="px-4 py-3">
                                          <a href="#" data-id="{{ $secondary->id }}" onclick="deletePost(this)" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-600 rounded">削除</a>
                                      </td>
                                  </form>
                                    </tr>
                                @endforeach
                              </tbody>
                            </table>
                            {{ $primaries->links() }}
                          </div> 
                        </div>
                      </section>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deletePost(e) {
        'use strict';
        if (confirm('本当に削除してもいいですか?')) {
        document.getElementById('delete_' + e.dataset.id).submit();
        }
    }
    </script>
</x-app-layout>