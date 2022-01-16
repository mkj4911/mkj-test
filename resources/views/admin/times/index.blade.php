<x-app-layout>
    <x-slot name="header">
        <div class="md:flex">
          勤怠管理
          <x-flash-message status="session('status')" />
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-end mb-8 md:mb-4"><p class="text-2xl mr-8 my-2 items-end">{{ $day->format('Y-m-d') }}</p><output id="realtime" class="flex items-end text-4xl w-20 tracking-widest"></output></div>
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