@extends('layouts.control')
@section('title','تعديل خدمة')
@section('css')

<script type='text/javascript'>
    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
@section('content')
<div class="form-box col-md-8 shadow-blur">
    <h3 class="text-center">تعديل خدمة</h3>
    <form method="POST" action="{{url('/control/services/update',$service->id)}}" enctype="multipart/form-data">
        @csrf
        @error('error')
        <div class="alert alert-danger">{{$message}}</div>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success">{{session()->get('success')}}</div>
        @endif
        <div class="row">
            <div class="col-md-4" style="overflow: hidden;">
                <img src="@if($service->image != null){{asset('storage/'.$service->image)}}@else{{asset('assets/img/placeholder.png')}}@endif" width="100%" id="image">
                <input type="file" name="image" onchange="preview_image(event)">
            </div>
            <div class="col-md-8">
            <div class="form-group">
            <label class="control-label">الاسم العربي</label>
            <input type="text" class="form-control" name="ar_name" value="{{$service->ar_name}}">
            @error('ar_name')
            <p style="color: red;">{{$message}}</p>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label">الاسم باللغة الانجليزية</label>
            <input type="text" class="form-control" name="en_name" value="{{$service->en_name}}">
            @error('en_name')
            <p style="color: red;">{{$message}}</p>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label">الوصف</label>
            <textarea class="form-control" name="des" style="min-height: 100px;">{{$service->des}}</textarea>
            @error('des')
            <p style="color: red;">{{$message}}</p>
            @endif
        </div>
            </div>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">تعديل</button>
        </div>
    </form>
</div>
@endsection