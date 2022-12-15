@extends('layouts.control')
@section('title','تعديل متجر')
@section('css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
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
<div class="form-box col-md-10">
    <h3 class="text-center">تعديل متجر</h3>
    <form method="POST" action="{{url('/control/updateStore',$store->id)}}" enctype="multipart/form-data">
        @csrf
        @error('error')
        <div class="alert alert-danger" role="alert">{{$message}}</div>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">{{session()->get('success')}}</div>
        @endif
        <div class="row"><div class="col-md-4">
            <img src="@if($store->image != null){{asset('storage/'.$store->image)}}@else{{asset('assets/img/placeholder.png')}}@endif" width="100%" id="image">
            <input type="file" name="image" onchange="preview_image(event)">
        </div>
        <div class="col-md-8">
        <div class="form-group">
            <label class="control-label">الاسم بالعربي</label>
            <input type="text" name="ar_name" class="form-control" value="{{$store->ar_name}}">
            @error('ar_name')
            <p style="color: red;">{{$message}}</p>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label">الاسم بالانجليزية</label>
            <input type="text" name="en_name" class="form-control" value="{{$store->en_name}}">
            @error('en_name')
            <p style="color: red;">{{$message}}</p>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label">مالك المتجر</label>
            <select id="user_id" name="user_id" class="form-control" data-live-search="true" data-live-search-style="begins" required>
                
                @foreach($users as $user)
                <option value="{{$user->id}}" @if($store->user->id == $user->id){{'selected'}}@endif>{{$user->name}}</option>
                @endforeach
            </select>
            @error('user_id')
            <p style="color: red;">{{$message}}</p>
            @endif
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div>
        </div></div>
    </form>
</div>
@endsection
@section('js')
<script>
    $('.selectpicker').selectpicker();
</script>
@endsection