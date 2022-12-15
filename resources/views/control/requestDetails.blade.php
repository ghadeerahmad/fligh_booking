@extends('layouts.control')
@section('title','التفاصيل')
@section('content')
<h1>التفاصيل</h1>
<div class="form-box">
    <div class="row">
        <div class="col-md-6">
            <p>تاريخ الميلاد: {{$details->birthday}}</p>
            <p>البنك: {{$details->bank}}</p>
            <p>الدراسة: {{$details->education}}</p>
            <p>الجنس: @if($details->gender == 0){{'ذكر'}}@else{{'لا'}}@endif</p>
            <p>متزوج: @if($details->married == 0){{'نعم'}}@else{{'لا'}}@endif</p>
            <p>نوع الحساب: {{$details->account_type}}</p>
            <p>جواز سفر آخر: {{$details->other_passport}}</p>
            <p>أماكن إقامة أخرى: {{$details->other_resdince}}</p>
            <p></p>
        </div>
        <div class="col-md-6">
            <p>العمل: {{$details->work}}</p>
            @if($details->destination != null)<p>الوجهة: {{$details->destination}}</p>@endif
            @if($details->age != null)<p>العمر: {{$details->age}}</p>@endif
            @if($details->staying_time != null)<p>وقت الإقامة: {{$details->staying_time}}</p>@endif
            @if($details->diseases != null)<p>الأمراض: {{$details->diseases}}</p>@endif
        </div>
    </div>
    <a type="button" href="{{url('/control/chat',$details->user_id)}}" class="btn btn-primary">إرسال رسالة</a>
</div>
@endsection 