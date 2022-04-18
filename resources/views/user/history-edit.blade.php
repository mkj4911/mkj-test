<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ $review->id }}

              <form method="post" action="{{ route('user.history.update', ['sale_id' => $review->id])}}">
                    @csrf
                  <div class="p-2 md:w-1/2 mx-auto">
                  <span class="star-rating">
                    <input type="radio" name="rating" value="1"><i></i>
                    <input type="radio" name="rating" value="2"><i></i>
                    <input type="radio" name="rating" value="3"><i></i>
                    <input type="radio" name="rating" value="4"><i></i>
                    <input type="radio" name="rating" value="5"><i></i>
                  </span>
                  </div>

                  <div class="p-2 md:w-1/2 mx-auto">
                            <div class="relative">
                              <label for="comment" class="leading-7 text-sm text-gray-600">評価</label>
                              <textarea id="comment" name="comment" rows="5" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                            </div>
                        </div>

                                          <div class="p-2 w-full flex justify-around mt-4">
                            <button type="button" onclick="location.href='{{ route('user.history.index') }}'" class="text-white bg-gray-300 h-8 w-36 ring-8 ring-gray-400 rounded-full hover:bg-gray-400 text-lg">戻る</button>
                            <button type="submit" class="text-white bg-gray-500 h-8 w-36 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">更新する</button>
                        </div>

                  </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>