<x-app-layout>
  <x-slot name="header">
        <div class="md:flex">
          勤怠管理
          <x-flash-message status="session('status')" />
        </div>
  </x-slot>

  <div class="py-4">
      <div class="mx-auto sm:max-w-4xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="md:flex">
             <div class="md:w-1/2">
              @foreach ($members as $member)
                <form method="post" action="{{ route('member.time.update')}}" enctype="multipart/form-data">
                  @csrf
                    <div class="text-lg mb-4">{{ $member->name }}さん</div>
                  @if (empty($member->filename))
                    <img class="mx-auto w-40 h-40 mb-2 object-cover rounded-full"  src="{{ asset('images/no_face.jpg') }}">
                  @else
                    <img class="mx-auto w-60 h-40 mb-2 rounded-md" src="{{ asset('storage/members/' . $member->filename )}}">
                  @endif 
                <div class="p-2 w-2/3 mx-auto">
                      <div class="relative mb-2">
                        <label for="image" class="leading-7 text-sm text-gray-600">画像変更</label>
                        <input type="file" id="image" name="image" accept="image/png,image/jpeg,image/jpg" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      </div>
                </div>
                    <div class="flex justify-around my-4"><button type="submit" class="text-white bg-gray-500 h-8 w-36 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">更新する</button></div>
                </form>    
              @endforeach
            </div>
            <div class="md:w-1/2">
                  <div class="p-6 bg-white">
                    <div class="flex items-end mb-12 md:mb-4"><p class="text-2xl mr-4">{{$day}}</p><output id="realtime" class="text-3xl w-20 tracking-widest"></output></div>
                  </div>
                  @foreach ($itmes as $itme)
                    <div class="attendance mt-4">
                      <table>
                        <tr class="flex items-center px-4"><td class="w-24 text-gray-700">出勤時刻：</td><td class="text-2xl tracking-widest">{{ date('H:i:s', strtotime($itme->punchIn ?? '00:00:00')) }}</td><td class="ml-2 text-md text-gray-700">{{ date('Y-m-d', strtotime($itme->punchIn ?? '00:00:00')) }}</td></tr>
                        <tr class="flex items-center px-4"><td class="w-24 text-gray-700">退勤時刻：</td><td class="text-2xl tracking-widest">{{ date('H:i:s', strtotime($itme->punchOut ?? '00:00:00')) }}</td><td class="ml-2 text-md text-gray-700">{{ date('Y-m-d', strtotime($itme->punchOut ?? '00:00:00')) }}</td></tr>
                        <tr class="flex items-center px-4"><td class="w-24 text-gray-700">勤務時間：</td><td class="text-2xl tracking-widest">{{$itme->workTime}}</td></tr>
                      </table>
                    </div>
                  @endforeach  
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
            </div>   
          </div>
        </div>
      </div>
    </div>
  <script src="{{asset('/js/time.js')}}"></script>
</x-app-layout>