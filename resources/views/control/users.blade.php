@extends('layouts.control')
@section('title','المستخدمين')
@section('content')
<div class="container-fluid py-4">
<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>المستخدمين </h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الاسم</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تاريخ التسجيل</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($users as $user)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                              <img src="@if($user->image != null) {{asset('storage/'.$user->image)}}@else {{asset('assets/img/placeholder.png')}}@endif" class="circle-img">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><a href="#">{{$user->name}}</a></h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$user->created_at}}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                      <form method="POST"  action="{{url('/control/users/delete',$user->id)}}">
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