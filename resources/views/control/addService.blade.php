@extends('layouts.control')
@section('title','إضافة خدمة')
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
    <h3 class="text-center">إضافة خدمة</h3>
    <form method="POST" action="{{url('/control/services/add',$cate->id)}}" enctype="multipart/form-data">
        @csrf
        @error('error')
        <div class="alert alert-danger">{{$message}}</div>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success">{{session()->get('success')}}</div>
        @endif
        <div class="row">
            <div class="col-md-4" style="overflow: hidden;">
                <img src="{{asset('assets/img/placeholder.png')}}" width="100%" id="image">
                <input type="file" name="image" onchange="preview_image(event)">
            </div>
            <div class="col-md-8">
            <div class="form-group">
            <label class="control-label">الاسم العربي</label>
            <input type="text" class="form-control" name="ar_name">
            @error('ar_name')
            <p style="color: red;">{{$message}}</p>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label">الاسم باللغة الانجليزية</label>
            <input type="text" class="form-control" name="en_name">
            @error('en_name')
            <p style="color: red;">{{$message}}</p>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label">الوصف</label>
            <textarea class="form-control" name="des" style="min-height: 100px;"></textarea>
            @error('des')
            <p style="color: red;">{{$message}}</p>
            @endif
        </div>
            </div>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">إضافة</button>
        </div>
    </form>
</div>
@endsection