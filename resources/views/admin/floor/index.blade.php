@extends('templates.admin.master')
@section('main-content')
<div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0 bg-green">
              <h3 class="mb-0">Danh sách tầng</h3>
              <a href="{{route('admin.floor.add')}}" class="btn btn-sm float-right btn-white text-green">Thêm Mới</a>
            </div>
            @if(Session::has('msg'))
              <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
            @endif
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Mã tầng</th>
                    <th scope="col">Tên tầng</th>
                    <th scope="col">Trạng thái </th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($listFloor as $item)
                  @php 
                    $Id_floor = $item->id_floor;
                    $name_floor = $item->name_floor;
                    if($item->status_floor == 1){
                      $status_floor = 'Hiện';
                      $online = "bg-success";
                      $status_text = "btn btn-success btn-sm";
                    }else{
                      $status_floor = 'Ẩn';
                      $online = "bg-warning";
                      $status_text = "btn btn-warning btn-sm";
                    }
                  @endphp
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="mb-0 text-sm">{{$Id_floor}}</span>
                        </div>
                      </div>
                    </th>
                    <td>
                      {{$name_floor}}
                    </td>
                    <td>
                      <span class="badge badge-dot mr-4 statusFloor-{{$Id_floor}}">
                        <i class="{{$online}}"></i> 
                        <label class="{{$status_text}}" onclick=" statusFloor({{$Id_floor}},{{$item->status_floor}})">
                          {{$status_floor}}
                        </label>
                      </span>
                    </td>
                  
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="{{route('admin.floor.edit',[$Id_floor])}}">Sửa</a>
                          <a class="dropdown-item" href="{{route('admin.floor.delete',[$Id_floor])}}">Xóa</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  
                  
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  {{$listFloor->links()}}
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript">
        function statusFloor(Id_floor,status_floor){
          $.ajax({
          url:'{{route("admin.floor.ajaxStatus")}}', 
          method:"POST",
          data:{
            "_token":'{{ csrf_token() }}',
            "Id_floor":Id_floor,
            "status_floor":status_floor
          },
          success: function(data){
              var status = '.statusFloor-'+Id_floor;
              $(status).html(data);
            //alert(data);
          }
        });
        }
      </script>
@endsection