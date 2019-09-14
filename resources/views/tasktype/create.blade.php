@extends('layouts.app')

       @section('content')
       <div class="row">
        <div class="col-sm-8 offset-sm-2">
           <h1 class="display-3">{{isset($model)?'Edit':'Add'}} a tasktype</h1>
         <div>
        
           @include('tasktype.form')
         </div>
       </div>
       </div>
       @endsection