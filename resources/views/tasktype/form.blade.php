<?php 
       /**
        * tasktype Form
        */
       ?>
       @if(isset($model))
           {{ Form::model($model, ['route' => ['tasktype.update', $model->id], 'method' => 'patch']) }}
       @else
           {{ Form::open(['route' => 'tasktype.store']) }}
       @endif

      
        <div class="form-group">
                    <?= Form::label('name', 'Name:') ?>
                    <?= Form::text('name', isset($model)?$model->name:'' , ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control'  ]) ?>
                    @error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>
	
                    
             
                       
                 <button type="submit" class="btn btn-primary-outline">{{isset($model)?'Update':'Add'}} tasktype</button>
               <?= Form::close() ?>
       