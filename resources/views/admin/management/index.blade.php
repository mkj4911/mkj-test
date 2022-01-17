<x-app-layout>
    <x-slot name="header">
            商品一覧
            <x-flash-message status="session('status')" />
            
                <form method="get" action="{{ route('admin.management.index') }}">
                  <div class="lg:flex lg:justify-around">
                      <div class="lg:flex items-end">
                          <select name="member" class="mb-2 lg:mb-0 lg:mr-4" id="">
                              <option value="0" @if(\Request::get('member') === '0') selected @endif>全て</option>
                            @foreach($members as $member)
                            <option value="{{ $member->id}}" @if(\Request::get('member') == $member->id) selected @endif >
                            {{ $member->name }}
                            </option>
                            @endforeach
                          </select>
                              <div class="flex space-x-2 items-center">
                                  <div><input name="keyword" class="border border-gray-500 py-2 px-2" placeholder="キーワードを入力"></div>
                                  <div><button class="text-white bg-gray-500 h-8 w-36 mx-4 ring-8 ring-gray-600 rounded-full hover:bg-gray-400 text-lg">検索する</button></div>
                              </div>
                      </div>
                    <div class="flex items-end">
                        <div>
                        <span class="text-sm">表示順</span><br>
                             <select name="search" class="mr-4" id="search">
                                <option value="{{ \Constant::SEARCH_ORDER['recommend']}}"
                                    @if(\Request::get('search') === \Constant::SEARCH_ORDER['recommend'] )
                                    selected
                                    @endif>更新日
                                </option>  
                                <option value="{{ \Constant::SEARCH_ORDER['deleted']}}"
                                    @if(\Request::get('search') === \Constant::SEARCH_ORDER['deleted'] )
                                    selected
                                    @endif>削除申請中
                                </option> 
                                <option value="{{ \Constant::SEARCH_ORDER['saleok']}}"
                                    @if(\Request::get('search') === \Constant::SEARCH_ORDER['saleok'] )
                                    selected
                                    @endif>販売中
                                </option> 
                                <option value="{{ \Constant::SEARCH_ORDER['saleng']}}"
                                    @if(\Request::get('search') === \Constant::SEARCH_ORDER['saleng'] )
                                    selected
                                    @endif>停止中
                                </option> 
                             </select>
                        </div>
                        <div>
                            <span class="text-sm">表示件数</span><br>
                            <select id="pagination" name="pagination">
                                <option value="50"
                                    @if(\Request::get('pagination') === '50')
                                    selected
                                    @endif>50件
                                </option>
                                <option value="100"
                                    @if(\Request::get('pagination') === '100')
                                    selected
                                    @endif>100件
                               </option>
                               <option value="250"
                                    @if(\Request::get('pagination') === '250')
                                    selected
                                    @endif>250件
                               </option>
                               </select>
                        </div>
                    </div>
                  </div>
                </form>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-wrap">
                         @foreach ($products as $product)
                            <div class="md:w-1/4 p-2 md:p-4">
                                <a href="{{ route('admin.management.show', ['item' => $product->id])}}"> 
                                <div class="border rounded-md p-2 md:p-4 hover:bg-gray-100 hover:shadow-lg"> 
                                    <div class="flex items-center justify-between">
                                    <div class="mb-4">
                                        @if ($product->is_selling)
                                          <span class="border rounded-full py-1 px-2 bg-indigo-400 text-white text-xs">販売中</span>
                                        @else    
                                          <span class="border rounded-full py-1 px-2 bg-red-400 text-white text-xs">停止中</span>
                                        @endif
                                    </div>
                                    <div><span>現在庫：</span>{{ $product->quantity }}</div>
                                    </div> 
                                    <div class=" hover:animate-pulse"><x-thumbnail filename="{{$product->filename ?? ''}}" type="products" /></div>
                                    <div class="mt-4">
                                        <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1"><span>担当者：</span>{{ $product->member_name }}</h3>
                                        <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1"><span>登録日：</span>{{ date_format($product->created_at, 'Y-m-d')}}</h2>
                                            @if ($product->deleted_at)
                                            <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1"><span>削除日：</span>{{ date_format($product->deleted_at, 'Y-m-d') }}</h2>
                                            @else 
                                            <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1"><span>削除日：</span></h2>
                                            @endif
                                        <h2 class="text-gray-900 title-font text-lg font-medium">{{ $product->name }}</h2>
                                        {{-- <p class="mt-1">{{ number_format($product->price) }}<span class="text-sm text-gray-700">円(税込)</span></p> --}}
                                    </div>
                                </div>
                                </a>
                            </div>
                         @endforeach
                    </div>
                    {{ $products->appends([
                        'sort' => \Request::get('sort'),
                        'pagination' => \Request::get('pagination')
                    ])->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        const select = document.getElementById('search')
        select.addEventListener('change', function(){
            this.form.submit()
        })
        const paginate = document.getElementById('pagination')
        paginate.addEventListener('change', function(){
            this.form.submit()
        })
    </script>
</x-app-layout>