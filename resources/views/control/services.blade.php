@extends('layouts.control')
@section('title','الخدمات')
@section('content')
<div class="container-fluid py-4">
<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>الخدمات <a type="button" class="btn btn-primary" href="{{url('/control/services/add',$cate->id)}}"><i class="fa fa-plus"></i> إضافة خدمة</a></h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">اسم الخدمة</th>
                      <th class="text-secondary opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($services as $service)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                              <img src="@if($service->image != null){{asset('storage/'.$service->image)}}@else{{asset('assets/img/placeholder.png')}}@endif" class="circle-img"/>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-center"><a href="{{url('/control/services',$service->id)}}">{{$service->ar_name}}</a></h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <a href="{{url('/control/services/update',$service->id)}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          تعديل
                        </a> 
                      </td>
                      <td class="align-middle">
                      <form method="POST"  action="{{url('/control/services/delete',$service->id)}}">
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