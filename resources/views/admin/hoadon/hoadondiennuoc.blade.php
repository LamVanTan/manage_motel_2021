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
            width: 45%;
            float:left;
        }
        .right{
            width: 45%;
            float:right;
        }
        .clear{
            clear: both;
        }
    </style>
</head>
<body>
    <h3 style="text-align: center">Hoá Đơn Thanh Toán Điện Nước</h3>
    <div >
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
            <b>Tên nhân viên: </b>{{$data['fullName']}}
        </div>
        <div class="right">
            <b>Địa chỉ: </b>{{$data['diaChi']}}
        </div>
        <div class="clear"></div>
    </div>

    <div >
        <div class="left">
            <b>Ngày thanh toán: </b>{{$data['ngayThanhToan']}}
        </div>
        <div class="right">
            <b>Người nhận: </b>{{$data['nguoiNhan']}}
        </div>
        <div class="clear"></div>
    </div>

    <table id="customers">
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Chỉ số ban đầu</th>
            <th>Chỉ số hiện tại</th>
            <th>Chỉ số Cuối</th>
            <th>Đơn giá</th>
            <th>Thanh tiền</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Điện</td>
            <td>{{$data['soDienCu']}}</td>
            <td>{{$data['soDienHienTai']}}</td>
            <td>{{$data['soDienCuoi']}}</td>
            <td>{{number_format($data['giaDien'],0,',','.')}} VND</td>
            <td>{{number_format($data['tongTienDien'],0,',','.')}} VND</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Nước</td>
            <td>{{$data['soNuocCu']}}</td>
            <td>{{$data['soNuocHienTai']}}</td>
            <td>{{$data['soNuocCuoi']}}</td>
            <td>{{number_format($data['giaNuoc'],0,',','.')}} VND</td>
            <td>{{number_format($data['tongTienNuoc'],0,',','.')}} VND</td>
        </tr>
        <tr>
            <td colspan="5">Tổng tiền</td>
            <td colspan="2">{{number_format($data['tongTienThanhToan'],0,',','.')}} VND</td>
        </tr>
    </table>
  
</body>
</html>