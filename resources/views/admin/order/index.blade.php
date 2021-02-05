@extends('templates.admin.master')
@section('main-content')
<div class="row">
  <div class="col">
    <div class="card shadow">
      <div class="card-header border-0 bg-green">
        <div class="row">
          <div class="col-lg-4">
            <h3 class="mb-0">Danh sách đơn đặt phòng</h3>
          </div>
          <div class="col-lg-8">
         
            <div class="row float-right">
            <div class="col-lg-5">
              <div class="form-group">
                <h5 style="display: inline">Từ Ngày</h5>
                <input type="date"  class="form-control form-control-sm form-control-alternative date_start" >
              </div>
            </div>
            <div class="col-lg-5">
              <div class="form-group">
                <h5 style="display: inline">Đến Ngày</h5>
                <input type="date" class="form-control form-control-sm form-control-alternative date_end" >
              </div>
            </div>
            <div class="col-lg-2">
              <div class="form-group">
                
                <input type="submit" onclick="searchDate()" class="mt-4 btn-sm btn btn-danger" value="Tìm Kiếm">
              </div>
            </div>

            </div>
          
          </div>
        </div>
     
      </div>
      @if(Session::has('msg'))
        <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
      @endif
      <div class="dateSearch">
          @include('admin.order.tableOrder')
    </div>
      <div class="card-footer py-4">
        <nav aria-label="...">
          <ul class="pagination justify-content-end mb-0">
            {{$listOrderRoom->links()}}
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>
   <style>
     b{
       font-size: 14px !important;
     }
   </style>
      <script>
        function searchDate(){
          var date_start = $('.date_start').val();
          var date_end = $('.date_end').val();
          $.ajax({
            url:'{{route("admin.order.searchDate")}}', 
            method:"POST",
            data:{
              "_token":'{{ csrf_token() }}',
              "date_start":date_start,
              "date_end":date_end
            },
            success: function(data){
                var status = '.dateSearch';
                $(status).html(data);
              
            }
          });

        }

        function showDetailOrder(id_order){
          var modalShow = "#order-"+id_order;
          var closeRoom = '#closeX-'+id_order;
          $(modalShow).show(600,function(){
            $(closeRoom).click(function(){
              $(modalShow).hide(600);
            });
          });
        }

        function changeStatus(idOrder,status){
          $.ajax({
            url:'{{route("admin.order.ajaxstatus")}}', 
            method:"POST",
            data:{
              "_token":'{{ csrf_token() }}',
              "idOrder":idOrder,
              "status":status
            },
            success: function(data){
                var status = '.statusOrder-'+idOrder;
                $(status).html(data);
              //alert(data);
            }
          });
        }

  

        function message(){
          swal("", "Chức năng này không hoạt động!", "warning");
        }
      </script>
@endsection