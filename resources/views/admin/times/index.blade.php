<x-app-layout>
    <x-slot name="header">
          <div class="md:flex items-end">
            勤怠管理
            <x-flash-message status="session('status')" />
          </div>
          <div class="lg:flex lg:justify-around">
          <form method="get" action="{{ route('admin.times.index') }}">
                <div class="lg:flex items-center">
                    <select name="member" class="mb-2 lg:mb-0 lg:mr-4" id="">
                        <option value="0" @if(\Request::get('member') === '0') selected @endif>全て</option>
                      @foreach($members as $member)
                      <option value="{{ $member->id}}" @if(\Request::get('member') == $member->id) selected @endif >
                      {{ $member->name }}
                      </option>
                      @endforeach
                    </select>
                    <div class="flex space-x-4 items-center">
                      <div><input type="date" valu="" name="from" class="border border-gray-500 py-2 px-2"></div>
                      <div><input type="date" value="" name="until" class="border border-gray-500 py-2 px-2"></div>
                        <div><button class="text-white bg-gray-500 h-8 w-36 mx-4 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">検索する</button></div>
                    </div>
                </div>
        </div>
    </form>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-end mb-8 md:mb-4"><p class="text-2xl mr-8 my-2 items-end">{{ $day->format('Y-m-d') }}</p><output id="realtime" class="flex items-end text-4xl w-20 tracking-widest"></output></div>
                    <div class="flex items-end my-1"><p>検索期間：</p><p class="text-lg">{{ $from}}</p>@if(!empty($from))<p class="text-lg">～</p>@endif<p class="text-lg">{{ $until }}</p></div>
                    <table class="table-fixed w-full text-left whitespace-no-wrap">
                        <thead>
                          <tr>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-100 ">スタッフ名</th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-100">出勤時刻</th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-100">退勤時刻</th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-xs md:text-sm bg-gray-100">勤務時間</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($times as $time)
                                <tr>
                                <td class="md:px-4 py-2 border-b-2 text-sm">{{ $time->member->name }}</td>
                                @if ($time->punchIn)
                                <div class="flex"><td class="md:px-4 border-b-2 text-md font-semibold tracking-wide"><div class="text-xs text-gray-400">{{ date('Y-m-d', strtotime($time->punchIn)) }}</div>{{ date('H:i:s', strtotime($time->punchIn)) }}</td></div>
                                @else    
                                <td class="md:px-4 border-b-2 text-sm font-semibold text-red-700">打刻待機</td>
                                @endif
                                @if ($time->punchOut)
                                <div class="flex"><td class="md:px-4 border-b-2 text-md font-semibold tracking-wide"><div class="text-xs text-gray-400">{{ date('Y-m-d', strtotime($time->punchOut)) }}</div>{{ date('H:i:s', strtotime($time->punchOut)) }}</td></div>
                                @else    
                                <td class="md:px-4 border-b-2 text-sm font-semibold text-red-700">打刻待機</td>
                                @endif
                                @if ($time->workTime)
                                <td class="md:px-4 py-2 border-b-2 text-md font-semibold ">{{ $time->workTime }}</td>
                                @else    
                                <td class="md:px-4 py-2 border-b-2 text-sm font-semibold text-red-700">打刻待機</td>
                                @endif
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                     <script src="{{asset('/js/time.js')}}"></script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>