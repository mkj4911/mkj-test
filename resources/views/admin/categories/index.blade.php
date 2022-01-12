<x-app-layout>
    <x-slot name="header">
          <div class="md:flex">
            プライマリカテゴリー一覧
            <x-flash-message status="session('status')" />
          </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl md:mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:p-6 bg-white border-b border-gray-200">     
                    <section class="text-gray-600 body-font">
                        <div class="container md:px-5 md:mx-auto mx-2">
                            <div class="flex justify-end my-4">
                                <button onclick="location.href='{{ route('admin.categories.create') }}'" class="text-white bg-gray-500 h-8 w-36 mr-8 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">新規登録する</button>
                            </div>
                            <div class="lg:w-3/3 w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                              <thead>
                                <tr>
                                  <th class="text-xs md:text-base md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 bg-gray-100 rounded-tl rounded-bl">プライマリカテゴリー名</th>
                                  <th class="text-xs md:text-base md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 bg-gray-100">並び順</th>
                                  <th class="text-xs md:text-base md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 bg-gray-100">作成日</th>
                                  <th class="text-xs md:text-base md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 bg-gray-100 rounded-tr rounded-br"></th>
                                  <th class="text-xs md:text-base md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 bg-gray-100 rounded-tr rounded-br"></th>
                                  <th class="text-xs md:text-base md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 bg-gray-100 rounded-tr rounded-br"></th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($primaries as $primary)
                                    <tr>
                                    <td class="text-sm md:text-base md:px-4 py-2 border-b-2">{{ $primary->name }}</td>
                                    <td class="text-sm md:text-base md:px-4 py-2 border-b-2">{{ $primary->sort_order }}</td>
                                    <td class="text-sm md:text-base md:px-4 py-2 border-b-2">{{ date_format($primary->created_at, 'Y-m-d')}}</td>
                                    <td class="text-sm md:text-base md:px-4 py-2 border-b-2">
                                        <button onclick="location.href='{{ route('admin.categories.edit', ['primary' => $primary->id]) }}'" class="text-xs md:text-sm px-2 text-white bg-gray-400 border-0 py-2 md:px-4 focus:outline-none hover:bg-gray-600 rounded">編集</button>
                                    </td>
                                    <td class="md:px-4 py-2 border-b-2">
                                      <button onclick="location.href='{{ route('admin.categories.subindex', ['primary' => $primary->id]) }}'" class="text-xs md:text-sm px-2 text-white bg-gray-400 border-0 py-2 md:px-4 focus:outline-none hover:bg-gray-600 rounded">セカンダリ</button>
                                   </td>
                                    <form id="delete_{{$primary->id}}" method="post" action="{{ route('admin.categories.destroy', ['primary' => $primary->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <td class="md:px-4 py-2 border-b-2">
                                            <a href="#" data-id="{{ $primary->id }}" onclick="deletePost(this)" class="text-xs md:text-sm px-2 text-white bg-red-400 border-0 py-2 md:px-4 focus:outline-none hover:bg-red-600 rounded">削除</a>
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
                    {{-- エロクアント
                    @foreach ($e_all as $e_owner)
                        {{ $e_owner->name}}
                        {{ $e_owner->created_at->diffForHumans() }}
                    @endforeach
                    <br>
                    クエリビルダ
                    @foreach ($q_get as $q_owner)
                        {{ $q_owner->name }}
                        {{ Carbon\Carbon::parse($q_owner->created_at)->diffForHumans() }}
                    @endforeach --}}
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