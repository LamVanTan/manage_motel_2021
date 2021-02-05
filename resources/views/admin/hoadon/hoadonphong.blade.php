<!DOCTYPE html>
<html lang="en">
<head>
  <title>Hoá đơn điện nước</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: DejaVu Sans;
        }
        h3{
            font-family: DejaVu Sans;
            margin-bottom: 40px;
        }
        #customers {
        border-collapse: collapse;
        width: 100%;
        margin-top: 30px;
        }

        #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        color: black;
        }
        .left{
            
            float:left;
        }
        .right{
            
            float:right;
        }
        .clear{
            clear: both;
        }
        
    </style>
</head>
<body>
    <h3 style="text-align: center">Hoá Đơn Thanh Toán Tiền Phòng</h3>
    <div >
        <div class="left">
            <b>Địa chỉ: </b>{{$data['diaChiAdmin']}}
        </div>
        <div class="clear"></div>
    </div>
    <div >
        <div class="left">
            <b>Tên nhân viên: </b>{{$data['nameAdmin']}}
        </div>
        <div class="right">
            <b>Ngày thanh toán: </b>{{$data['ngayThanhToan']}}
        </div>
        <div class="clear"></div>
    </div>
    <div>
        <div class="left">
            <b>Phòng: </b>{{$data['phong']}}
        </div>
        <div class="right">
            <b>Tầng: </b>{{$data['tang']}}
        </div>
        <div class="clear"></div>
    </div>
    <div >
        <div class="left">
            <b>Giá Phòng: </b>{{number_format($data['giaPhongHienTai'],0,',','.')}} VND
        </div>
        <div class="clear"></div>
    </div>
    <div >
        <div class="left">
            <b>Tiền cọc: </b>{{number_format($data['tienCoc'],0,',','.')}} VND
        </div>
        <div class="right">
            <b>Tiền phải trả: </b>{{number_format($data['tienPhaiTra'],0,',','.')}} VND
        </div>
        <div class="clear"></div>
    </div>

    <table id="customers">
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Giá Tiền</th>
        </tr>
        
        @php $dem = 1; @endphp
        @foreach($data['dichVu'] as $item)
        @if($item->name_service == "Điện" || $item->name_service == "Nước")
        @php $dem = 1;  @endphp
        @else
        @php $giaPhong = $data['giaPhongHienTai'] - $item->price_service; @endphp
        <tr>
            <td>{{$dem}}</td>
            <td>{{$item->name_service}}</td>
            <td>{{number_format($item->price_service,0,',','.')}} VND</td>
        </tr>
        @endif
        @php $dem++; @endphp
        @endforeach
        <tr>
            <td>1</td>
            <td>Giá phòng chưa kèm thiết bị vật dụng</td>
            <td>{{number_format($giaPhong,0,',','.')}} VND</td>
        </tr>
    </table>
    <div >
        <div class="left">
            <b style="font-size:13px">Lưu ý *:<br> 
                - Giá Điện, Nước sẽ được thanh toán theo chỉ số sử dụng của từng phòng <br>
                - Thiết bị được thêm vào sẽ có thêm phụ phí khác nhau của từng thiết bị.<br>
                <span style="color:red;font-size:13px">(Mong bạn kiểm tra thông tin trước khi thanh toán).</span>
            </b>
        </div>
        
        <div class="clear"></div>
    </div>
  
</body>
</html>