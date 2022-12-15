@extends('layouts.control')
@section('title','طلبات النقل')
@section('content')
<div class="container-fluid py-4">
<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>طلبات النقل </h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الاسم</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المطار</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الوجهة</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">التاريخ</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الوقت</th>
                      <th class="text-secondary opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($car as $cr)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><a href="{{url('/control/car',$cr->id)}}">{{$cr->user->name}}</a></h6>
                          </div>
                        </div>
                      </td>
                      
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$cr->airport}}</h6>
                          </div>
                        </div>
                      </td>
                      
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$cr->destination}}</h6>
                          </div>
                        </div>
                      </td>
                      
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$cr->date}}</h6>
                          </div>
                        </div>
                      </td>
                      
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$cr->time}}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                      <form method="POST"  action="{{url('/control/car/delete',$cr->id)}}">
            @csrf
            {{ method_field('DELETE') }}
                                <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> حذف</button></td>
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