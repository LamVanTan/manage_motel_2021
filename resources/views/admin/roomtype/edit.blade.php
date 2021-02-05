@extends('templates.admin.master')
@section('main-content')
<div class="row">
  <div class="col">
 <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0 btn btn-md btn-primary">Sửa loại phòng</h3>
                </div>
                <div class="col-4 text-right">
                  
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="{{route('admin.roomtype.edit',[$itemRoomType->id_roomtype])}}" method="POST">
                @csrf
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Tên loại phòng</label>
                        <input type="text" value="{{$itemRoomType->name_roomtype}}" class="form-control form-control-alternative" placeholder="Nhập loại phòng vào đây" name="roomtype">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Trạng thái</label>
                      </div>
                      <input type="radio"  name="status" value="1" @if($itemRoomType->status_roomtype == 1) checked="" @endif> Hiện 
                      <input type="radio"  name="status" value="0" @if($itemRoomType->status_roomtype == 0) checked="" @endif> Ẩn
                    </div>
                  </div>
                  <hr class="my-4" />
                  <div class="col-lg-12">
                      <div class="form-group float-right">
                        <input type="reset" class="btn-sm btn-warning" value="Làm mới">
                        <input type="submit" class="btn-sm btn-success" value="Cập nhập">
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