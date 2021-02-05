@extends('templates.admin.master')
@section('main-content')
<div class="row">
  <div class="col">
 <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0 btn btn-sm btn-primary">Thêm dịch vụ</h3>
                </div>
                <div class="col-4 text-right">
                  
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="{{route('admin.service.add')}}" method="POST">
                @csrf
                
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Tên dịch vụ</label>
                        <input type="text" class="form-control form-control-alternative" placeholder="Nhập dịch vụ vào đây" name="name_service">
                        
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Giá dịch vụ</label>
                        <input type="number" class="form-control form-control-alternative"  name="price" placeholder="Nhập giá vào đây" > 
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Trạng thái</label>
                      </div>
                      <input type="radio"  name="status" value="1" checked=""> Hiện 
                      <input type="radio"  name="status" value="0"> Ẩn
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