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
<table style="margin-top: 50px;">
    <tr>
        <th style="text-align: center!important">ID</th>
        <th style="text-align: center!important">Group</th>
        <th style="text-align: center!important">SubGroup</th>
    </tr>
    @foreach($subgroups as $subgroup)
        <tr>
            <th style="text-align: center!important">{{$subgroup->id}}</th>
            <th style="text-align: center!important">{{$subgroup->group->name}}</th>
            <th style="text-align: center!important">{{$subgroup->name}}</th>
        </tr>
    @endforeach
</table>
<div style="border-top:1px solid black">
    @foreach($subgroups as $subgroup)   
        @foreach($subgroup->objects as $object)   
            <li>{{$object->name}}</li>   
        @endforeach
    @endforeach
</div>
<div style="border-top:1px solid black">
    @foreach($subgroups as $subgroup)       
        <li>{{$subgroup->object->name}}</li>   
    @endforeach
</div>



@endsection