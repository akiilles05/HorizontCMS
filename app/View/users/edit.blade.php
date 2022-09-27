@extends('layout')

@section('content')
<div class='container main-container'>

  <h2>{{trans('user.edit_user')}}</h2>

<form role='form' action="{{admin_link('user-update',$user->id)}}" method='POST' enctype='multipart/form-data'>
        {{ csrf_field() }}

    <div class="row">
      <div class="col-sm-12 col-md-8 ">
      <div class='form-group' >
        <label for='title'>{{trans('user.create_name')}}:</label>
        <input type='hidden' class='form-control' id='title' name='id' value='{{ $user->id }}' >
        <input type='text' class='form-control' id='title' name='name' value='{{$user->name}}' required>
      </div>

      <div class='form-group' >
        <label for='title'>{{trans('user.create_username')}}:</label>
        <input type='text' class='form-control' id='title' name='username' value='{{$user->username}}' required>
      </div>

        @if($user->is($current_user))
          <div class='form-group' >
            <label for='title'>{{trans('user.create_password')}}:</label>
            <input type='password' class='form-control' id='title' name='password'  required>
          </div>

          <div class='form-group' >
            <label for='title'>{{trans('user.create_password_again')}}:</label>
            <input type='password' class='form-control' id='title' name='password2'  required>
          </div>
        @endif

      <div class='form-group' >
        <label for='title'>{{trans('user.create_email')}}:</label>
        <input type='email' class='form-control' id='title' name='email' value='{{$user->email}}' required>
      </div>

      <div class='form-group' >
        <label for='sel1'>{{trans('user.create_select_rank')}}:</label>
        <select class='form-select' name='role_id' id='sel1'>
          
          @foreach($user_roles as $each)
            @if($each->permission<=$current_user->role->permission)
            <option value="{{ $each->id }}" {{ ($each->is($user->role) ? "selected":"") }}>{{ $each->name }}</option>
            @endif
          @endforeach

        </select>
      </div>

    </div>

    <div class="col-md-4 col-sm-12">
      <button type='button' class='btn btn-link mb-5 w-100' data-bs-toggle='modal' data-bs-target='#modal-xl-{{ $user->id }}'>
        <img src='{{ $user->getThumb() }}' class='img img-thumbnail' width='320' >
      </button>

      <div class='form-group' >
        <label for='file'>{{trans('actions.upload_image')}}:</label>
        <input name='up_file' accept='image/*' id='input-2' type='file' class='file' multiple='true' data-show-upload='false' data-show-caption='true'>
      </div>

    </div>

    <div class='form-group' > 
        <button id='submit-btn' type='submit' class='btn btn-lg btn-primary'>{{trans('actions.update')}}</button>
    </div>
     
    </div>

  </form>


<?php 

    Bootstrap::image_details($user->id,$user->getImage());

?>

<script type="text/javascript">
window.onload = function () {
  document.getElementById("password").onchange = validatePassword;
  document.getElementById("password2").onchange = validatePassword;
}
function validatePassword(){
var pass2=document.getElementById("password2").value;
var pass1=document.getElementById("password").value;
if(pass1!=pass2)
  document.getElementById("password2").setCustomValidity("{{trans('user.pws_not_equal')}");
else
  document.getElementById("password2").setCustomValidity('');  
//empty string means no validation error
}
</script>


</div>
@endsection