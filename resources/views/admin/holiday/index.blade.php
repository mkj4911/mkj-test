<x-app-layout>
	<x-slot name="header">
		  <div class="md:flex">
			休日設定
			<x-flash-message status="session('status')" />
		  </div>
	</x-slot>
	
	<div class="container mx-auto">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
				<div class="flex item-center justify-between">
				  <div class="text-lg w-60">{{ $calendar->getTitle() }}</div>
				  <form method="post" action="{{ route('admin.holiday.update', ['holiday' => $setting->id])}}">
					@csrf
				</div>
				<div class="md:flex">
				<div class="md:w-1/2 py-2 mt-4">
					<table class="table table-borderd">
						<tr>
							<th>月曜日</th>
							<td class="px-8">
								<input class="px-2 h-5 w-5" type="radio" name="flag_mon" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenMonday()) ? 'checked' : '' }} id="flag_mon_open" />
								<label class="px-2" for="flag_mon_open">営業日</label>
								<input class="px-2 h-5 w-5 ml-4" type="radio" name="flag_mon" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseMonday()) ? 'checked' : '' }} id="flag_mon_close" />
								<label class="px-2" for="flag_mon_close">休み</label>
							</td>
						</tr>
						<tr>
							<th>火曜日</th>
							<td class="px-8">
								<input class="px-2 h-5 w-5" type="radio" name="flag_tue" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenTuesday()) ? 'checked' : '' }} id="flag_tue_open" />
								<label class="px-2" for="flag_tue_open">営業日</label>
								<input class="px-2 h-5 w-5 ml-4" type="radio" name="flag_tue" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseTuesday()) ? 'checked' : '' }} id="flag_tue_close" />
								<label class="px-2" for="flag_tue_close">休み</label>
							</td>
						</tr>
						<tr>
							<th>水曜日</th>
							<td class="px-8">
								<input class="px-2 h-5 w-5" type="radio" name="flag_wed" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenWednesday()) ? 'checked' : '' }} id="flag_wed_open" />
								<label class="px-2" for="flag_wed_open">営業日</label>
								<input class="px-2 h-5 w-5 ml-4" type="radio" name="flag_wed" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseWednesday()) ? 'checked' : '' }} id="flag_wed_close" />
								<label class="px-2" for="flag_wed_close">休み</label>
							</td>
						</tr>
						<tr>
							<th>木曜日</th>
							<td class="px-8">
								<input class="px-2 h-5 w-5" type="radio" name="flag_thu" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenThursday()) ? 'checked' : '' }} id="flag_thu_open" />
								<label class="px-2" for="flag_thu_open">営業日</label>
								<input class="px-2 h-5 w-5 ml-4" type="radio" name="flag_thu" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseThursday()) ? 'checked' : '' }} id="flag_thu_close" />
								<label class="px-2" for="flag_thu_close">休み</label>
							</td>
						</tr>
						<tr>
							<th>金曜日</th>
							<td class="px-8">
								<input class="px-2 h-5 w-5" type="radio" name="flag_fri" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenFriday()) ? 'checked' : '' }} id="flag_fri_open" />
								<label class="px-2" for="flag_fri_open">営業日</label>
								<input class="px-2 h-5 w-5 ml-4" type="radio" name="flag_fri" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseFriday()) ? 'checked' : '' }} id="flag_fri_close" />
								<label class="px-2" for="flag_fri_close">休み</label>
							</td>
						</tr>
						<tr>
							<th>土曜日</th>
							<td class="px-8">
								<input class="px-2 h-5 w-5" type="radio" name="flag_sat" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenSaturday()) ? 'checked' : '' }} id="flag_sat_open" />
								<label class="px-2" for="flag_sat_open">営業日</label>
								<input class="px-2 h-5 w-5 ml-4" type="radio" name="flag_sat" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseSaturday()) ? 'checked' : '' }} id="flag_sat_close" />
								<label class="px-2" for="flag_sat_close">休み</label>
							</td>
						</tr>
						<tr>
							<th>日曜日</th>
							<td class="px-8">
								<input class="px-2 h-5 w-5" type="radio" name="flag_sun" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenSunday()) ? 'checked' : '' }} id="flag_sun_open" />
								<label class="px-2" for="flag_sun_open">営業日</label>
								<input class="px-2 h-5 w-5 ml-4" type="radio" name="flag_sun" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseSunday()) ? 'checked' : '' }} id="flag_sun_close" />
								<label class="px-2" for="flag_sun_close">休み</label>
							</td>
						</tr>
						<tr>
							<th>祝日</th>
							<td class="px-8">
								<input class="px-2 h-5 w-5" type="radio" name="flag_holiday" value="{{ $FLAG_OPEN }}" {{ ($setting->isOpenHoliday()) ? 'checked' : '' }} id="flag_holiday_open" />
								<label class="px-2" for="flag_holiday_open">営業日</label>
								<input class="px-2 h-5 w-5 ml-4" type="radio" name="flag_holiday" value="{{ $FLAG_CLOSE }}" {{ ($setting->isCloseHoliday()) ? 'checked' : '' }} id="flag_holiday_close" />
								<label class="px-2" for="flag_holiday_close">休み</label>
							</td>
						</tr>
					</table>
					<div class="flex justify-around my-8">
						<button type="button" onclick="location.href='{{ route('admin.shops.index') }}'" class="text-white bg-gray-300 h-8 w-36 mr-8 ring-8 ring-gray-400 rounded-full hover:bg-gray-400 text-lg">戻る</button>
						<button type="submit" class="text-white bg-gray-500 h-8 w-36 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">更新する</button>
					</div>
				</div>
					<div class="md:w-1/2 py-2 mt-4">
						{!! $calendar->render() !!}
						<div class="flex justify-end items-center"><span class="text-pink-300 text-2xl">■</span><span>は休日！！</span></div>	
					</div>
				</div>
				</form>
	            </div>
            </div>
        </div>
	</div>
</div>
</x-app-layout>