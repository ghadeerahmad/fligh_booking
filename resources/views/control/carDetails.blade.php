@extends('layouts.control')
@section('title','التفاصيل')
@section('content')
<h1>التفاصيل</h1>
<div class="form-box">
            <p>الاسم: {{$details->user->name}}</p>
            <p>المطار: {{$details->airport}}</p>
            <p>الوجهة: {{$details->destination}}</p>
            <p>التاريخ: {{$details->date}}</p>
            <p>الوقت: {{$details->time}}</p>
            <p></p>
        </div>
    <a type="button" href="{{url('/control/chat',$details->user_id)}}" class="btn btn-primary">إرسال رسالة</a>
</div>
@endsection 