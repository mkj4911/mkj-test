<x-app-layout>
    <x-slot name="header">
          <div class="md:flex">
            登録解除スタッフ一覧
            <x-flash-message status="session('status')" />
          </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:p-6 bg-white border-b border-gray-200">     
                    <section class="text-gray-600 body-font">
                        <div class="container md:px-5 md:mx-auto mx-2">
                            <div class="lg:w-3/3 w-full mx-auto overflow-auto">
                                <div class="flex justify-end mr-8">
                                <button type="button" onclick="location.href='{{ route('admin.members.index') }}'" class="text-white bg-gray-300 h-8 w-36 my-4 ring-8 ring-gray-400 rounded-full hover:bg-gray-400 text-lg">戻る</button>
                                </div> 
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                              <thead>
                                <tr>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">氏名</th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">解除した日</th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                </tr>
                              </thead>
                              <tbody>
                                @if(count($expiredMembers) > 0)
                                @foreach ($expiredMembers as $member)
                                    <tr>
                                    <td class="md:px-4 py-3">{{ $member->name }}</td>
                                    <td class="md:px-4 py-3">{{ $member->email }}</td>
                                    <td class="md:px-4 py-3">{{ $member->deleted_at->diffForHumans() }}</td>
                                    <form id="update_{{$member->id}}" method="post" action="{{ route('admin.expired-members.update', ['member' => $member->id]) }}">
                                        @csrf
                                        <td class="md:px-4 py-3 text-center">
                                            <a href="#" data-id="{{ $member->id }}" onclick="updatePost(this)" class="text-white bg-gray-400 border-0 py-2 px-4 focus:outline-none hover:bg-gray-600 rounded">復元</a>
                                        </td>
                                    </form>
                                    <form id="delete_{{$member->id}}" method="post" action="{{ route('admin.expired-members.destroy', ['member' => $member->id]) }}">
                                        @csrf
                                        <td class="md:px-4 py-3 text-center">
                                            <a href="#" data-id="{{ $member->id }}" onclick="deletePost(this)" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-600 rounded">削除</a>
                                        </td>
                                    </form>
                                    </tr>
                                @endforeach
                                @else
                                登録解除されているスタッフはいません。
                              　@endif
                              </tbody>
                            </table>
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
        function updatePost(e) {
        'use strict';
        if (confirm('復元しますか?')) {
        document.getElementById('update_' + e.dataset.id).submit();
        }
    }
        function deletePost(e) {
        'use strict';
        if (confirm('削除してもいいですか?')) {
        document.getElementById('delete_' + e.dataset.id).submit();
        }
    }
    </script>
</x-app-layout>