<x-app-layout>
    <x-slot name="header">
          <div class="md:flex">
            スタッフ一覧
            <x-flash-message status="session('status')" />
          </div>
    </x-slot>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-2 bg-white border-b border-gray-200">
                  <div class="flex justify-end my-4">
                      <button onclick="location.href='{{ route('admin.members.create') }}'" class="text-white bg-gray-500 h-8 w-36 mr-8 mx-4 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">新規登録する</button>
                  </div>
                  <div class="flex flex-wrap justify-around md:justify-start">
                       @foreach ($members as $member)
                          <div class="md:w-1/3 w-full p-2 md:p-4">
                              <a href="#" onclick="location.href='{{ route('admin.members.edit', ['member' => $member->id]) }}'">
                              <div class="border rounded-md p-2 md:px-4 hover:bg-gray-200 hover:shadow-lg">
                                  <div class="flex items-center"> 
                                      <div class="w-1/3 mr-2">
                                          @if (empty($member->filename))
                                          <img class="mx-auto w-24 h-24 object-cover rounded-full"  src="{{ asset('images/no_face.jpg') }}">
                                          @else
                                          <img class="mx-auto w-24 h-20 rounded-md" src="{{ asset('storage/members/' . $member->filename )}}">
                                          @endif  
                                      </div>
                                  <div class="w-2/3 mt-4 flex">
                                      <div class="">
                                          <h3 class="text-gray-500 text-sm tracking-widest title-font mb-1"><span class="text-xs">氏名：</span><br>{{ $member->name }}</h3>
                                          <h3 class="text-gray-500 text-sm tracking-widest title-font mb-1"><span class="text-xs">メールアドレス：</span><br>{{ $member->email }}</h3>
                                      </div>
                                  </div>
                                  </div>
                              </div>
                              </a>
                          </div>
                       @endforeach
                  </div>
                  {{ $members->links() }}
              </div>
          </div>
      </div>
  </div>
</x-app-layout>