<x-app-layout>
    <x-slot name="header">
          <div class="md:flex">
            スタッフ一覧
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
                                <button onclick="location.href='{{ route('admin.members.create') }}'" class="text-white bg-gray-500 h-8 w-36 mr-8 mx-4 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">新規登録する</button>
                                <button onclick="location.href='{{ route('admin.expired-members.index') }}'" class="text-white bg-red-500 h-8 w-36 mr-8 mx-4 ring-8 ring-red-600 rounded-full hover:bg-red-400 text-lg">解除スタッフ一覧</button>
                            </div>
                            <div class="lg:w-3/3 w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                              <thead>
                                <tr>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">氏名</th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">登録日</th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($members as $member)
                                    <tr>
                                    <td class="md:px-4 py-2 border-b-2">{{ $member->name }}</td>
                                    <td class="md:px-4 py-2 border-b-2">{{ $member->email }}</td>
                                    <td class="md:px-4 py-2 border-b-2">{{ $member->created_at->diffForHumans() }}</td>
                                    <td class="md:px-4 py-2 border-b-2">
                                        <button onclick="location.href='{{ route('admin.members.edit', ['member' => $member->id]) }}'" class="text-white bg-gray-400 border-0 py-2 px-4 focus:outline-none hover:bg-gray-600 rounded">編集</button>
                                    </td>
                                    <form id="delete_{{$member->id}}" method="post" action="{{ route('admin.members.destroy', ['member' => $member->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <td class="px-4 py-2 border-b-2">
                                            <a href="#" data-id="{{ $member->id }}" onclick="deletePost(this)" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-600 rounded">登録解除</a>
                                        </td>
                                    </form>
                                    </tr>
                                @endforeach
                              </tbody>
                            </table>
                            {{ $members->links() }}
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
        if (confirm('登録を解除してもいいですか?')) {
        document.getElementById('delete_' + e.dataset.id).submit();
        }
    }
    </script>
</x-app-layout>