@extends('templates.admin.master')
@section('main-content')
<div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0 bg-green">
              <h3 class="mb-0">Danh sách loại phòng</h3>
              <a href="{{route('admin.roomtype.add')}}" class="btn btn-sm float-right btn-white text-green">Thêm Mới</a>
            </div>
            @if(Session::has('msg'))
              <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
            @endif
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Mã loại phòng</th>
                    <th scope="col">Tên loại phòng</th>
                    <th scope="col">Trạng thái </th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($listRoomType as $item)
                  @php 
                    $id_roomtype = $item->id_roomtype;
                    $name_roomtype = $item->name_roomtype;
                    if($item->status_roomtype == 1){
                      $status_roomtype = 'Hiện';
                      $online = "bg-success";
                      $status_text = "btn btn-success btn-sm";
                    }else{
                      $status_roomtype = 'Ẩn';
                      $online = "bg-warning";
                      $status_text = "btn btn-warning btn-sm";
                    }
                  @endphp
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="mb-0 text-sm">{{$id_roomtype}}</span>
                        </div>
                      </div>
                    </th>
                    <td>
                      {{$name_roomtype}}
                    </td>
                    <td>
                      <span class="badge badge-dot mr-4 statusRoomType-{{$id_roomtype}}">
                        <i class="{{$online}}"></i> 
                        <label class="{{$status_text}}" onclick="statusRoomType({{$id_roomtype}},{{$item->status_roomtype}})">
                          {{$status_roomtype}}
                        </label>
                      </span>
                    </td>
                  
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="{{route('admin.roomtype.edit', [$id_roomtype])}}">Sửa</a>
                          <a class="dropdown-item" href="{{route('admin.roomtype.delete', [$id_roomtype])}}">Xóa</a>
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
                  {{$listRoomType->links()}}
                  
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript">
        function statusRoomType(id_RoomType,status_RoomType){
          $.ajax({
          url:'{{route("admin.roomtype.ajaxstatus")}}', 
          method:"POST",
          data:{
            "_token":'{{ csrf_token() }}',
            "id_RoomType":id_RoomType,
            "status_RoomType":status_RoomType
          },
          success: function(data){
              var status = '.statusRoomType-'+id_RoomType;
              $(status).html(data);
            //alert(data);
          }
        });
        }
      </script>
@endsection