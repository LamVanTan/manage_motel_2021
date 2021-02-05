@extends('templates.admin.master')
@section('main-content')
<div class="row">
  <div class="col">
 <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0 btn btn-sm btn-primary">Thêm phòng</h3>
                </div>
                <div class="col-4 text-right">
                  @if(Session::has('msg'))
                    <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
                  @endif
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="{{route('admin.room.add')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="">Tên phòng</label>
                        <input type="text" class="form-control form-control-alternative" placeholder="Nhập phòng vào đây" name="name">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="">Giá phòng</label>
                        <input type="number" class="form-control form-control-alternative"  name="price" placeholder="Nhập giá vào đây" > 
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="">Khu vực</label>
                        <select name="floor" id="" class="form-control form-control-alternative">
                          <option value="" selected="" >-- chọn tầng phù hợp --</option>
                          @foreach($listFloor as $itemFloor)
                            <option value="{{$itemFloor->id_floor}}">{{$itemFloor->name_floor}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="">Loại phòng</label>
                        <select name="roomtype" id="" class="form-control form-control-alternative">
                          <option value="" selected="" >-- chọn loại phòng phù hợp --</option>
                          @foreach($listRoomType as $itemRoomType)
                           <option value="{{$itemRoomType->id_roomtype}}">{{$itemRoomType->name_roomtype}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="">Diện tích</label>
                        <input type="number" class="form-control form-control-alternative" placeholder="Nhập diện tích vào đây" name="area">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="">Số lượng người ở phù hợp</label>
                        <input type="number" class="form-control form-control-alternative"  name="quantity" placeholder="Nhập số lượng người ở vào đây" > 
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="">hình ảnh</label>
                        <input type="file" class="form-control form-control-alternative" multiple="multiple"  name="photos[]">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="">Trạng thái</label>
                      </div>
                      <input type="radio"  name="status" value="1" checked=""> Hiện 
                      <input type="radio"  name="status" value="0"> Ẩn
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <ul class="nav nav-tabs">
                        <li class="nav-item">
                          <a class="nav-link active" data-toggle="tab" href="#home">Dịch vụ </a>
                        </li>
                      </ul>
                      
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div class="tab-pane container active" id="home">
                          <div class="form-group">
                            <div class="row">
                              @foreach($listService as $itemService)
                                <div class="col-lg-2">
                                  <input type="checkbox" value="{{$itemService->id_service}}" name="service[]"> {{$itemService->name_service}}
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                 
                  <hr class="my-4" />
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="">Chỉ số điện ban đầu</label>
                        <input type="number" class="form-control form-control-alternative" placeholder="Nhập số điện ban đầu vào đây" name="soDien">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="">Chỉ số nước ban đầu</label>
                        <input type="number" class="form-control form-control-alternative"  name="soNuoc" placeholder="Nhập số nước ban đầu vào đây" > 
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="">Thông tin cụ thế phòng</label>
                        <textarea class="form-control" name="detail" id="" cols="30" rows="10"></textarea>
                      </div>
                    </div>
                  </div>
                  <hr class="my-4" />
                  <div class="col-lg-12">
                      <div class="form-group float-right">
                        <input type="reset" class="btn-sm btn-warning" value="Làm mới"> 
                        <input type="submit" class="btn-sm btn-success" value="Thêm mới">
                      </div>  
                    </div>
                  </div>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      @endsection