<?php

       Form::macro('SearchField', function($name)
       {
         //echo "<pre>";print_r($_GET);exit;
         $var=isset($_GET[$name])?$_GET[$name]:"";
         $return ='
         <form method="get">
         <div class="input-group">';
         if(isset($_GET)){
           foreach($_GET as $k=>$v){
             $return .='<input type="hidden" name="'.$k.'" value="'.$v.'">';
           }
         }
         $return .='<input type="text" value="'.$var.'" class="form-control" name="'.$name.'" placeholder="Search '.$name.' "> 
           </div> </form>';
         return $return;
       });
       
       ?>
       
       @extends('layouts.app')
       
       @section('content')
       <div class="row">
       <div class="col-sm-12">
       @if(session()->get('success'))
           <div class="alert alert-success">
             {{ session()->get('success') }}  
           </div>
       @endif
       
       <div class="container">
       
       </div>
       
           <h1 class="display-3">tasktype</h1>  
                       <a href="{{ route('tasktype.create')}}" class="btn btn-primary">Create New Record</a>
                      
         <table class="table table-striped">
           
           
           <tbody>
               @foreach($model as $tasktype)
               <tr>
               <td>{{$tasktype->id}}</td>
							<td>{{$tasktype->name}}</td>

                   <td>
                       <a href="{{ route('tasktype.edit',$tasktype->id)}}" class="btn btn-primary">Edit</a>
                   </td>
                   <td>
                       <form action="{{ route('tasktype.destroy', $tasktype->id)}}" method="post">
                         @csrf
                         @method('DELETE')
                         <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                       </form>
                   </td>
               </tr>
               @endforeach
                       
           </tbody>
         </table>
         {{ $model->links() }} 
        
       <div>
       </div>
       
       @endsection
       
       