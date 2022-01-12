<x-app-layout>
  <x-slot name="header">
        <div class="md:flex">
          勤怠管理
          {{-- <x-flash-message status="session('status')" /> --}}
        </div>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                <div class="md:flex items-end h-20 mb-12 md:mb-4"><p class="text-lg mr-4">{{$day}}</p><output id="realtime" class="text-3xl w-20"></output><x-flash-message status="session('status')" /></div>
                <div class="container">
                  @foreach ($itmes as $itme)
                  <div class="attendance">
                    <p class="name">{{$itme->user_name}}</p>
                    <table>
                      <tr class="flex items-end px-4"><td class="w-20 text-gray-700">出勤</td><td class="text-2xl">{{$itme->punchIn}}</td></tr>
                      {{-- <tr class="flex items-end px-4"><td class="w-20 text-gray-700">休憩開始</td><td class="text-2xl">{{$itme->breakIn}}</td></tr>
                      <tr class="flex items-end px-4"><td class="w-20 text-gray-700">休憩終了</td><td class="text-2xl">{{$itme->breakOut}}</td></tr> --}}
                      <tr class="flex items-end px-4"><td class="w-20 text-gray-700">退勤</td><td class="text-2xl">{{$itme->punchOut}}</td></tr>
                      <tr class="flex items-end px-4"><td class="w-20 text-gray-700">勤務時間</td><td class="text-2xl">{{$itme->workTime}}</td></tr>
                    </table>
                  </div>
                  @endforeach
                </div>
              </div>
                {{-- <p>{{session('message')}}</p> --}}
                

                <div class="md:flex mt-8">
                  <div class="flex justify-around md:w-1/2 mb-8">
                    <form class="timestamp" action="{{ route('member.time.timein')}}" method="post">
                    @csrf
                      <button class="text-3xl text-white bg-gray-500 h-24 w-24 ring-8 ring-gray-600 rounded-full hover:bg-gray-400">出勤</button>
                    </form>
                    <form class="timestamp" action="{{ route('member.time.timeout')}}" method="post">
                    @csrf
                      <button class="text-3xl text-white bg-gray-500 h-24 w-24 ring-8 ring-gray-600 rounded-full hover:bg-gray-400">退勤</button>
                    </form>
                  </div>
                  <div class="flex justify-around items-end md:w-1/2 mb-8">
                    <a onclick="location.href='{{ route('member.time.performance') }}'">
                      <button class="text-white bg-gray-500 h-8 w-28 ring-8 ring-gray-600 rounded-full hover:bg-gray-400">勤怠実績</button>
                    </a>
                    
                    <a onclick="location.href='{{ route('member.time.daily') }}'">
                      <button class="text-white bg-gray-500 h-8 w-28 ring-8 ring-gray-600 rounded-full hover:bg-gray-400">日次勤怠</button>
                    </a>
                  </div>
                
                {{-- <a onclick="location.href='{{ route('member.time.index') }}'">
                  <button class="text-white bg-gray-500 h-8 w-20 ring-8 ring-gray-600 rounded-full hover:bg-gray-400">戻る</button>
                </a> --}}
                <script src="{{asset('/js/time.js')}}"></script>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>