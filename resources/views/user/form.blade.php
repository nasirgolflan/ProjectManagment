<?php 
       /**
        * user Form
        */
       ?>
       @if(isset($model))
           {{ Form::model($model, ['route' => ['user.update', $model->id], 'method' => 'patch']) }}
       @else
           {{ Form::open(['route' => 'user.store']) }}
       @endif

      
        <div class="form-group">
                    <?= Form::label('name', 'Name:') ?>
                    <?= Form::text('name', isset($model)?$model->name:'' , ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control'  ]) ?>
                    @error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>
	 <div class="form-group">
                    <?= Form::label('email', 'Email:') ?>
                    <?= Form::text('email', isset($model)?$model->email:'' , ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control'  ]) ?>
                    @error('email')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>
	 <div class="form-group">
                    <?= Form::label('password', 'Password:') ?>
                    <?= Form::text('password', isset($model)?$model->password:'' , ['class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control'  ]) ?>
                    @error('password')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>
	
                    
             
                       
                 <button type="submit" class="btn btn-primary-outline">{{isset($model)?'Update':'Add'}} user</button>
               <?= Form::close() ?>
       