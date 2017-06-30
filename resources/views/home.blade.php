@extends('layouts.app')
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    height:40px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
@section('content')
<a href="#" onclick="add_user()"><button>ADD USER</button></a>
<table style="margin-top: 50px;">
    <tr>
        <th style="text-align: center!important">ID</th>
        <th style="text-align: center!important">Name</th>
        <th style="text-align: center!important">Username</th>
        <th style="text-align: center!important">Edit</th>
        <th style="text-align: center!important">Delete</th>
    </tr>
    @foreach($users as $user)
        <tr>
            <th style="text-align: center!important">{{$user->id}}</th>
            <th style="text-align: center!important">{{$user->name}}</th>
            <th style="text-align: center!important">{{$user->username}}</th>
            <th style="text-align: center!important">Edit</th>
            <th style="text-align: center!important">Delete</th>
        </tr>
    @endforeach
</table>
@endsection
<div id="popup" style="display: none; width:100%; height:100%; position: absolute; background-color: black; z-index:1; opacity: 0.3;"></div>
<div id="form" style="display: none; width:50%; height:500px; position: absolute; background-color: white; z-index:2; margin-top: 50px; margin-left:25%">
    <div style="width:100%; height:40px;">
        <strong style="float:right; margin-right: 10px;">
            <a href="#" onclick="close_popup()">X</a>
        </strong>
    </div>
    <form style="width:100%; margin-top: 10px;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token" />
        <div class="form-group">
            <label class="col-md-4 control-label">Name</label>
            <div class="col-md-6">
                <input type="text" name="name" id="name" class="form-control" value=''>
            </div>
        </div><br><br><br>
        <div class="form-group">
            <label class="col-md-4 control-label">E mail</label>
            <div class="col-md-6">
                <input type="email" name="email" id="email" class="form-control" value=''>
            </div>
        </div><br><br><br>
        <div class="form-group">
            <label class="col-md-4 control-label">Username</label>
            <div class="col-md-6">
                <input type="text" name="username" id="username" class="form-control" value=''>
            </div>
        </div><br> <br>
        <div class="form-group">
            <label class="col-md-4 control-label">Password</label>
            <div class="col-md-6">
                <input type="password" name="password" id="password" class="form-control" value=''>
            </div>
        </div><br><br> 
        <div class="form-group">
            <label class="col-md-4 control-label">Password Confirm</label>
            <div class="col-md-6">
                <input type="password" name="password_confirm" id="password_confirm" class="form-control" value=''>
            </div>
        </div><br><br>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <a class="btn btn-primary" onclick="form_save()">Ընդունել</a>
                <a href="#" class="btn btn-danger" onclick="close_popup()">Մերժել</a>
            </div>
        </div><hr> 
    </form>
</div>
<script type="text/javascript">

function add_user(){
    document.getElementById("popup").style.display = "block";
    document.getElementById("form").style.display = "block";
}

function close_popup(){
    document.getElementById("popup").style.display = "none";
    document.getElementById("form").style.display = "none";
}

function form_save(){
    var token = document.getElementById("token").value;
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var password_confirm = document.getElementById("password_confirm").value;
    if(password !== password_confirm){
        alert('error');
        return '';
    }
    $.ajax({
            cache: false,
            type : 'POST',
            url: '/user/save',
            dataType: 'json',
            data: {
                '_token': token,
                'name': name,
                'email': email,
                'username': username,
                'password': password,
            },
            success:function(result){
                if(result.succes == 'true'){
                    location.reload();
                }else{
                    alert(error);
                }
                
            }
    });
}

</script>
