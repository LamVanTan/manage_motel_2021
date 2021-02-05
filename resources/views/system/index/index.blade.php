@extends('templates.system.master')
@section('main-content')
   <div class="row">
         <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="row">
              <div class="col-xl-12">
              <select name="year" id="year" class="btn btn-sm float-left">
                @for($i = 2018; $i<=2029; $i++)
                    <option @if($i == $year) selected  @endif  value="{{$i}}"> {{$i}}</option>
                @endfor
              </select>
              <input type="submit" onclick="getYear()" value="Tìm kiếm" class="float-left btn-sm btn btn-success">
              </div>
            </div>
            <div id="doanhThu">
              @include('system.index.revenue')
            </div>
        </div>
        
        <div class="col-xl-4">
          
          <div class="row">
            <div class="col-xl-12">
              <input type="submit" onclick="getYearOrder()"  value="Tìm kiếm" class="float-right btn-sm btn btn-success ml-1">
              <select name="year" id="yearOrder" class="btn btn-sm float-right">
                @for($i = 2018; $i<=2029; $i++)
                    <option @if($i == $year) selected  @endif  value="{{$i}}"> {{$i}}</option>
                @endfor
              </select>
            </div>
          </div>
          <div id="datPhong">
            @include('system.index.totalregister')
          </div>
        </div>
      </div>
<script>
    function getYear(){
        var year = $('#year').val();
        //alert(year);
            $.ajax({
                url:'{{route("system.index.revenueAjax")}}', 
                method:"POST",
                data:{
                    "_token":'{{ csrf_token() }}',
                    "year":year
                },
                success: function(data){
                    
                    $("#doanhThu").html(data);
                    //window.location.reload();
                
                }
            });     
    }

    function getYearOrder(){
        var year = $('#yearOrder').val();
    //alert(year);
        $.ajax({
            url:'{{route("system.index.yearOrderAjax")}}', 
            method:"POST",
            data:{
                "_token":'{{ csrf_token() }}',
                "year":year
            },
            success: function(data){
                
                $("#datPhong").html(data);
                //window.location.reload();
              
            }
        });     
    }

    </script>
     
@endsection