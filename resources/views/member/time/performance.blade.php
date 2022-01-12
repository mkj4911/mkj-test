<x-app-layout>
  <x-slot name="header">
        <div class="md:flex">
          勤怠実績
          <x-flash-message status="session('status')" />
        </div>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="main-title">Performance</h1>
                <div class="md:flex items-center mb-4">
                  <div class="flex">
                    <form class="flex items-end my-4" action="{{ route('member.time.performance') }}" method="post">
                      @csrf
                      <select name="year" class="year">
                        @for($i=2020; $i <= 2030; $i++)
                        <option>{{$i}}</option>
                        @endfor
                      </select>
                  
                      <p class="year">年</p>
                  
                      <select name="month" class="month">
                        @for($i=1; $i <= 12; $i++)
                        <option>{{$i}}</option>
                        @endfor
                      </select>
                  
                      <p class="month">月</p>
                    </div>
                    <div class="flex items-center my-4">
                      <input class="text-white bg-gray-500 h-8 w-28 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 mx-4" type="submit" value="選択">
                      <button type="button" onclick="location.href='{{ route('member.time.index') }}'" class="text-white bg-gray-500 h-8 w-28 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 mx-4">戻る</button>
                    </div>
                  </form>
                </div>
                
              <div class="container">
                <div class="attendance">
                  <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                      <tr>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">出勤</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">退勤</th>
                        {{-- <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">休憩開始</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">休憩終了</th> --}}
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">勤務時間</th>
                      </tr>
                    </thead>
                    @foreach ($items as $item)
                    <tbody>
                      <tr>
                        <td class="px-4 py-2">{{$item->punchIn}}</td>
                        <td class="px-4 py-2">{{$item->punchOut}}</td>
                        {{-- <td class="px-4 py-2">{{$item->breakIn}}</td>
                        <td class="px-4 py-2">{{$item->breakOut}}</td> --}}
                        <td class="px-4 py-2">{{$item->workTime}}</td>
                      </tr>
                    </tbody>
                    @endforeach
                  </table>
                </div>
            </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>