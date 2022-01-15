<x-app-layout>
  <x-slot name="header">
        <div class="md:flex">
          勤怠管理
          <x-flash-message status="session('status')" />
        </div>
  </x-slot>

  <div class="py-4">
      <div class="mx-auto w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white">
                <div class="md:flex items-end mb-12 md:mb-4"><p class="text-2xl mr-4">{{$day}}</p><output id="realtime" class="text-3xl w-20 tracking-widest"></output></div>
                  @foreach ($itmes as $itme)
                  <div class="text-lg">{{ $itme->member->name }}さん</div>
                  <div class="attendance mt-4">
                    <table>
                      <tr class="flex items-end px-4"><td class="w-24 text-gray-700">出勤時刻：</td><td class="text-2xl tracking-widest">{{ date('H:i:s', strtotime($itme->punchIn ?? '00:00:00')) }}</td></tr>
                      <tr class="flex items-end px-4"><td class="w-24 text-gray-700">退勤時刻：</td><td class="text-2xl tracking-widest">{{ date('H:i:s', strtotime($itme->punchOut ?? '00:00:00')) }}</td></tr>
                      <tr class="flex items-end px-4"><td class="w-24 text-gray-700">勤務時間：</td><td class="text-2xl tracking-widest">{{$itme->workTime}}</td></tr>
                    </table>
                  </div>
                  @endforeach
              </div>
                <div class="flex justify-around my-8">
                    <form class="timestamp" action="{{ route('member.time.timein')}}" method="post">
                    @csrf
                      <button class="text-3xl text-white bg-gray-500 h-24 w-24 ring-8 ring-gray-600 rounded-full hover:bg-gray-400">出勤</button>
                    </form>
                    <form class="timestamp" action="{{ route('member.time.timeout')}}" method="post">
                    @csrf
                      <button class="text-3xl text-white bg-gray-500 h-24 w-24 ring-8 ring-gray-600 rounded-full hover:bg-gray-400">退勤</button>
                    </form>
                </div>
                <script src="{{asset('/js/time.js')}}"></script>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>