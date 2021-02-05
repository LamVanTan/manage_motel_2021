@extends('templates.motel.master')
@section('main-content')
        <div class="content mt-5">
            <div class="container">
              <div class="row align-items-center">
                <div class="col-md-12 contents">
                <div class="form-block">
                <div class="mb-4">
                    <h3 style="text-align: center">Nạp tiền vào tài khoản để sử dụng các dịch vụ quản lý</h3>
                    <div id="thongBao" style="text-align: center">
                      @if(Session::has('msg'))
                        <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
                      @endif
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="">
                            <h3 style="font-size: 17px">Các mệnh giá tiền</h3>
                            <input type="radio" name="racharge" onchange="moneyRecharge()" value="50000" checked> 50.000 vnđ<br>
                            <input type="radio" name="racharge" onchange="moneyRecharge()"  value="100000"> 100.000 vnđ<br>
                            <input type="radio" name="racharge" onchange="moneyRecharge()" value="500000"> 500.000 vnđ<br>
                            <input type="radio" name="racharge" onchange="moneyRecharge()" value="1000000"> 1.000.000 vnđ<br>
                            <input type="radio" name="racharge" onchange="moneyRecharge()" value="2000000"> 2.000.000 vnđ<br>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row"  id="vnpay">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <h3 style="font-size: 17px">Các cổng thanh toán</h3>
                        <form action="{{ route('motel.room.payment') }}" method="POST" >
                            @csrf
                            <input type="hidden" name="order_type" value="Nạp tiền tài khoản">
                            <input type="hidden" name="order_id" value="{{ date('YmdHis') }}">
                            <input type="hidden" name="amount" value="50000" class="vnpay">
                            <input type="hidden" name="order_desc" value="Nạp tiền tài khoản">
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
                  <div class="col-md-4 "><a href="{{route('motel.index.index')}}" class="float-right"><i class="fas fa-arrow-left"></i> Trang chủ </a></div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4"><a href="{{route('admin.index.index')}}">Trang quản lý <i class="fas fa-arrow-right"></i></a></div>
                </div>
                </div>
                </div>
              </div>
            </div>
          </div>
<script src="https://www.paypal.com/sdk/js?client-id=AbEO67zfcwSprGjNUPms3P_xFokLKGStSyJmV7tVYReM3pUlRMwPcaq-D926UAL5UFZjs5gmge22QA98"> </script>
<script type="text/javascript">
  function moneyRecharge(){
    var selected = $("input[type='radio'][name='racharge']:checked");
    
    if (selected.length > 0) {
      var selected = selected.val();
      $('.vnpay').val(selected);
      var price = (selected/23000).toFixed(2);
      return price;
    }        
  }
    paypal.Buttons({
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: moneyRecharge(),
            currency: 'USD',
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
          var money = $("input[type='radio'][name='racharge']:checked").val();
          
          $.ajax({
            url:"{{ route('motel.room.recharge') }}", 
            method:"POST", // phương thức gửi dữ liệu.
            data:{
              "_token":'{{ csrf_token() }}',
              "money":money,
            },
            success:function(data){ //dữ liệu nhận về
             
                $('#thongBao').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là countryList
            }
         });
                 
      });
    }
  }).render('#paypal-button-container');

  

  
</script>
@endsection