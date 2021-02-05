@extends('templates.motel.master')
@section('main-content')
        <div class="content mt-5">
            <div class="container">
              <div class="row align-items-center">
                
                <div class="col-md-12 contents">
                  
                  <div class="form-block">
                  <div class="mb-4">
                    <div id="thongbao" style="text-align: center">
                      @if(Session::has('msg'))
                            <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
                      @endif
                    </div>
                        <h3 style="text-align: center">Thanh toán để sử dụng phần mềm</h3>
                        <p class="mb-2" style="text-align: center">Thanh toán để được trải nghiệm một trong những phần mềm tốt nhất hiện nay</p>
                        <p class="mb-4" style="text-align: center">Giá dịch vụ là {{number_format($giaTienTaiKhoanQuanLy->giaTien,0,',','.')}} vnđ/tháng</p>
                      </div>
                     
                        <div class="row mb-2">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="">
                                  <h3 style="font-size: 17px">Thời gian sử dụng phần mềm</h3>
                                    <select onchange="month_price()" id="month" name="month" id="" class="form-control" style="border:1px solid lightgray;">
                                        <option value="1" selected="" >1 Tháng</option>
                                        <option value="3">3 Tháng</option>
                                        <option value="6">6 Tháng</option>
                                        <option value="9">9 Tháng</option>
                                        <option value="12">12 Tháng</option>
                                      </select>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="">
                                  <h3 style="font-size: 17px">Giá sử dụng phần mềm</h3>
                                    <input type="text" class="form-control" id="price" value=" {{number_format($giaTienTaiKhoanQuanLy->giaTien,0,',','.')}} vnđ" name="price" style="border:1px solid lightgray;" readonly>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                          </div>
                      
                    <div class="row"  id="vnpay">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                          <h3 style="font-size: 17px">Các cổng thanh toán</h3>
                            <form action="{{route('motel.auth.payment')}}" method="POST" >
                                @csrf
                                @php
                                 if(isset($addUser)){
                                   $idUser = $addUser;
                                 }else{
                                  $idUser = 1;
                                 }
                                @endphp
                                <input type="hidden" name="order_type" value="Thanh toán hóa đơn">
                                <input type="hidden" name="order_id" value="{{$idUser}}">
                                <input type="hidden" name="amount" value="199000" class="vnpay">
                                <input type="hidden" name="order_desc" value="Thanh toán đơn hàng">
                                <input type="hidden" name="bank_code" value="">
                                <input type="hidden" name="language" value="vn">
                                <button type="submit" class="btn btn-block py-1 font-weight-bold border mb-3" id="vnpay">
                                    <span class="text-danger">VN</span><span class="text-info">PAY</span>
                                </button>
                             </form>
                            <div id="paypal-button-container" class="paypal"></div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 "></div>
                      <div class="col-md-4"></div>
                      <div class="col-md-4"><a href="{{route('motel.auth.login')}}" class="float-right"><i class="fas fa-sign-in-alt"></i> Đăng nhập </a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

<script src="https://www.paypal.com/sdk/js?client-id=AbEO67zfcwSprGjNUPms3P_xFokLKGStSyJmV7tVYReM3pUlRMwPcaq-D926UAL5UFZjs5gmge22QA98"> </script>
<script type="text/javascript">
    function price(){
      var price = $("#price").val();
      var price = price.split(' ')[1];
      var price1 = price.replace(/\D/gm,"");
      var price = (price1/23000).toFixed(2);
      return price;
    }
    paypal.Buttons({
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: price(),
            currency: 'USD',
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        var price = $("#price").val();
        var price = price.split(' ')[1];
        var price = price.replace(/\D/gm,"");
        var month = $('#month').val();  
        $.ajax({
            url:'{{route("motel.auth.paymentRegisterAjax")}}', 
            method:"POST",
            data:{
                "_token":'{{ csrf_token() }}',
                "idUser":{{$idUser}},
                "price": price,
                "month": month
            },
            success:function(data){
                $('#thongbao').html(data);    
            }
        });
      });
    }
  }).render('#paypal-button-container');

  function month_price(){
      var month = $('#month').val();    
      $.ajax({
          url:'{{route("motel.auth.priceApp")}}', 
          method:"POST",
          data:{
              "_token":'{{ csrf_token() }}',
              "month":month,
              "priceApp": {{$giaTienTaiKhoanQuanLy->giaTien}}
          },
          success:function(data){
              $('#price').val(data);   
              var price = $("#price").val();
              var price = price.split(' ')[1];
              var price1 = price.replace(/\D/gm,"");
              $('.vnpay').val(price1);
          }
      });
      
  }
</script>
@endsection