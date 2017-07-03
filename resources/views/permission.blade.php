@extends('layouts.app')
<style>

</style>
@section('content')
@foreach($users as $user)
    <div style="width:100%; height:100px; border:solid 1px black;">
        <h3 style="float:left">{{$user->name}}</h3>
        <div class="form-group" id="form-group">
            <div class="col-md-2">
                <select id="object_id_{{$user->id}}" class="form-control" >
                    <option value=''>Object All</option>
                    @foreach($objects as $object)
                        <option value="{{$object->id}}">{{$object->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <a style="float:left" href="#" class="btn" onclick="attach('{{$user->id}}')">Save</a>
        @foreach($user->objects as $object)
            <div style="float:left; height:50px; width:auto; margin-left:20px; padding:10px; border:solid 1px black">{{$object->name}} 
                <a href="#" onclick="detach({{$object->id}},{{$user->id}})">X</a>
            </div>
        @endforeach
    </div>
@endforeach
<script type="text/javascript">
function attach(id){
    var object_id = document.getElementById("object_id_" +id).value;
    if(!object_id){
        alert('error');
        return '';
    }
    $.ajax({
        cache: false,
        type : 'GET',
        url: '/permission/attach/',
        dataType: 'json',
        data:{
            'object_id': object_id,
            'user_id': id,
        }, 
        success: function(connect) {
            location.reload();
        },
        error:function(){
            alert('error');
        }
    });

}
function detach(object_id, user_id){
   
    $.ajax({
        cache: false,
        type : 'GET',
        url: '/permission/detach/',
        dataType: 'json',
        data:{
            'object_id': object_id,
            'user_id': user_id,
        }, 
        success: function(connect) {
            location.reload();
        },
        error:function(){
            alert('error');
        }
    });
}

</script>
@endsection