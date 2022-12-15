@extends('layouts.control')
@section('title','الخدمات')
@section('content')
<div class="container-fluid py-4">
<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>الخدمات </h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الفئة</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الخدمة</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تاريخ الطلب</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($requests as $request)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><a href="{{url('/control/serviceRequests',$request->id)}}">{{$request->cate_name}}</a></h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><a href="{{url('/control/serviceRequests',$request->id)}}">{{$request->servic_name}}</a></h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$request->created_at}}</h6>
                          </div>
                        </div>
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
      {!! $requests->links() !!} 
</div>
@endsection