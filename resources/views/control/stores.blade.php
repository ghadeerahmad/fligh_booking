@extends('layouts.control')
@section('title',' المتاجر')
@section('content')
<div class="container-fluid py-4">
<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6> المتاجر @if(isset($cate))<a type="button" class="btn btn-primary" href="{{url('/control/addStore',$cate->id)}}"><i class="fa fa-plus"></i> إضافة متجر</a>@endif</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">اسم المتجر</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المالك</th>
                      <th class="text-secondary opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($stores as $store)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                              <img src="@if($store->image != null) {{asset('storage/'.$store->image)}}@else {{asset('assets/img/placeholder.png')}}@endif" class="circle-img">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><a href="{{url('control/products',$store->id)}}">{{$store->ar_name}}</a></h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><a href="#">{{$store->user->name}}</a></h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <a href="{{url('/control/updateStore',$store->id)}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          تعديل
                        </a> 
                      </td>
                      <td class="align-middle">
                      <form method="POST"  action="{{url('/control/deleteStore',$store->id)}}">
            @csrf
            {{ method_field('DELETE') }}
                                <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> حذف</button>
</form> 
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection