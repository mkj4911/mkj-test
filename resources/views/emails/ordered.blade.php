<p class="mb-2">{{ $product['memberName'] }}さんの商品が注文されました。<p><br>
<p class="mb-4">販売管理画面を確認してください。<p>    

    
    <div class="mb-4">商品情報</div>
    <ul class="mb-4">
        <li>商品名：{{ $product['name'] }}</li>
        <li>商品金額：{{ number_format($product['price']) }}円</li>
        <li>商品数：{{ $product['quantity'] }}</li>
        <li>合計金額：{{ number_format($product['price']*$product['quantity']) }}円</li>
    </ul>   
    
    <div class="mb-4">購入者情報</div>
    <ul>
        <li>{{ $user->name }}様</li>
    </ul>