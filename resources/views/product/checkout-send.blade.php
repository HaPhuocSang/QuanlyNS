<p>Họ và tên: {{ $sentData['name'] }}</p>
<p>Email: {{ $sentData['email'] }}</p>
<p>Số điện thoại: {{ $sentData['phone'] }}</p>
<p>Thông tin đơn hàng</p>
<table style="border-collapse: collapse;border: 1px solid #ddd;">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá tiền</th>
            <th>Giá sau khi giảm</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i=1;
        @endphp
        @foreach($sentData['bill'] as $product)
            <tr>
                <td>{{$i}}</td>
                <td>{{$product['item']['name']}}</td>
                <td>{{$product['qty']}}</td>
                <td>{{$product['item']->unit_price}}</td>
                <td>{{$product['item']->promotion_price}}</td>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="text-align: right;">Tổng tiền: {{ $sentData['total']}}</td>
        </tr>
    </tfoot>
</table>
