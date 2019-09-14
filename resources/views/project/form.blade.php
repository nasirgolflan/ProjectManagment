<?php 
       /**
        * project Form
        */
       ?>
       @if(isset($model))
           {{ Form::model($model, ['route' => ['project.update', $model->id], 'method' => 'patch']) }}
       @else
           {{ Form::open(['route' => 'project.store']) }}
       @endif

      
        <div class="form-group">
                    <?= Form::label('name', 'Name:') ?>
                    <?= Form::text('name', isset($model)?$model->name:'' , ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control'  ]) ?>
                    @error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>
	 <div class="form-group">
                    <?= Form::label('description', 'Description:') ?>
                    <?= Form::text('description', isset($model)?$model->description:'' , ['class' => $errors->has('description') ? 'form-control is-invalid' : 'form-control'  ]) ?>
                    @error('description')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>
	 <div class="form-group">
                    <?= Form::label('release_date', 'Release Date:') ?>
                    <?= Form::text('release_date', isset($model)?$model->release_date:'' , ['class' => $errors->has('release_date') ? 'form-control is-invalid' : 'form-control'  ]) ?>
                    @error('release_date')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>
	
                    
             
                       
                 <button type="submit" class="btn btn-primary-outline">{{isset($model)?'Update':'Add'}} project</button>
               <?= Form::close() ?>
       