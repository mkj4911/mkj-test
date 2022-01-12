<x-app-layout>
  <x-slot name="header">
        <div class="md:flex">
          スタッフ情報編集
          <x-flash-message status="session('status')" />
        </div>
  </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                        <div class="container md:px-5 mx-auto">
                          <div class="flex flex-col text-center w-full mb-12">
                            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">スタッフ情報編集</h1>
                          </div>
                          <div class="lg:w-1/2 md:w-2/3 mx-auto">
                          <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="post" action="{{ route('admin.members.update', ['member' => $member->id]) }}">
                              @method('PUT')
                              @csrf
                            <div class="-m-2">
                              <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                  <label for="name" class="leading-7 text-sm text-gray-600">氏名</label>
                                  <input type="text" id="name" name="name" value="{{ $member->name }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                              </div>
                              <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                  <label for="email" class="leading-7 text-sm text-gray-600">メールアドレス</label>
                                  <input type="email" id="email" name="email" value="{{ $member->email }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                              </div>
                              <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                  <label for="password" class="leading-7 text-sm text-gray-600">パスワード</label>
                                  <input type="password" id="password" name="password" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                              </div>
                              <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                  <label for="password_confirmation" class="leading-7 text-sm text-gray-600">パスワード確認</label>
                                  <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                              </div>
                              <div class="p-2 w-full flex justify-around mt-4">
                                <button type="button" onclick="location.href='{{ route('admin.members.index') }}'" class="text-white bg-gray-300 h-8 w-36 ring-8 ring-gray-400 rounded-full hover:bg-gray-400 text-lg">戻る</button>
                                <button type="submit" class="text-white bg-gray-500 h-8 w-36 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">更新する</button>
                              </div>
                             </div>
                            </form>
                        </div>
                      </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>