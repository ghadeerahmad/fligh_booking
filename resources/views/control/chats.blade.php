@extends('layouts.control')
@section('title','الرسائل')
@section('content')
<div class="container-fluid py-4">
<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>الرسائل </h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المستخدم</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تاريخ آخر رسالة</th>
                      
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $i=0;?>
                      @foreach($chats as $chat)
                      @if($i ==0 || $chat->user_id != $chats[$i-1]->user_id)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                              <img src="@if($chat->image != null) {{asset('storage/'.$chat->image)}}@else {{asset('assets/img/placeholder.png')}}@endif" class="circle-img">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><a href="{{url('control/chat',$chat->user_id)}}">{{$chat->name}}</a></h6>
                            <span style="font-size: 12px;color:grey">{{$chat->message}}</span>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$chat->created_at}}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                      <form method="POST"  action="{{url('/control/deleteProduct',$chat->user_id)}}">
            @csrf
            {{ method_field('DELETE') }}
                                <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> حذف</button></td>
</form> 
   
                      </td>
                    </tr>
                    @endif
                    <?php $i++;?>
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