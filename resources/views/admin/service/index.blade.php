@extends('templates.admin.master')
@section('main-content')
<div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0 bg-green">
              <h3 class="mb-0">Danh sách dịch vụ</h3>
              <a href="{{route('admin.service.add')}}" class="btn btn-sm float-right btn-white text-green">Thêm Mới</a>
            </div>
            @if(Session::has('msg'))
              <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
            @endif
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    
                    <th scope="col">Mã dịch vụ</th>
                    <th scope="col">Tên dịch vụ</th>
                    <th scope="col">Giá dịch vụ</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col"></th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach($listService as $item)
                  @php 
                    $id_service = $item->id_service;
                    $name_service = $item->name_service;
                    $price_service = $item->price_service;
                    if($item->status_service == 1){
                      $status_service = 'Hiện';
                      $online = "bg-success";
                      $status_text = "btn btn-success btn-sm";
                    }else{
                      $status_service = 'Ẩn';
                      $online = "bg-warning";
                      $status_text = "btn btn-warning btn-sm";
                    }
                    
                   
                    if(ucfirst($name_service) == "Điện"){
                      $text = "/chữ";
                    }else if(ucfirst($name_service) == "Nước"){
                      $text = "/m3";
                    }else if(ucfirst($name_service) == "Wifi"){
                      $text = "free";
                    }
                    else{
                      $text = "/Cái";
                    }
                  @endphp
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                       
                        <div class="media-body">
                          <span class="mb-0 text-sm">{{$id_service}}</span>
                        </div>
                      </div>
                    </th>
                    <td>
                      {{$name_service}}
                    </td>
                    <td>
                      @if(ucfirst($name_service) == "Wifi")
                        {{$text}}
                      @else
                        {{number_format($price_service,0,',','.')}} VND {{$text}}
                      @endif
                    </td>
                    <td>
                      <span class="badge badge-dot mr-4 statusService-{{$id_service}}">
                        <i class="{{$online}}"></i>
                        <label class="{{$status_text}}" onclick="statusService({{$id_service}}, {{$item->status_service}})">
                          {{$status_service}}
                        </label>
                      </span>
                    </td>
                  
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="{{route('admin.service.edit',[$id_service])}}">Sửa</a>
                          <a class="dropdown-item" href="{{route('admin.service.delete', [$id_service])}}">Xóa</a>
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
                  {{$listService->links()}}
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        function statusService(id_service,status_service){
          $.ajax({
          url:'{{route("admin.service.ajaxstatus")}}', 
          method:"POST",
          data:{
            "_token":'{{ csrf_token() }}',
            "id_service":id_service,
            "status_service":status_service
          },
          success: function(data){
              var status = '.statusService-'+id_service;
              $(status).html(data);
            //alert(data);
          }
        });
        }
      </script>
@endsection