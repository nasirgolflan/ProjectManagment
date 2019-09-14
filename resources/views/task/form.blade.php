<?php 
       /**
        * task Form
        */
       ?>
       @if(isset($model))
           {{ Form::model($model, ['route' => ['task.update', $model->id], 'method' => 'patch']) }}
       @else
           {{ Form::open(['route' => 'task.store']) }}
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
                    <?= Form::label('start_date', 'Start Date:') ?>
                    <?= Form::text('start_date', isset($model)?$model->start_date:'' , ['class' => $errors->has('start_date') ? 'form-control is-invalid' : 'form-control'  ]) ?>
                    @error('start_date')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>
	 <div class="form-group">
                    <?= Form::label('end_date', 'End Date:') ?>
                    <?= Form::text('end_date', isset($model)?$model->end_date:'' , ['class' => $errors->has('end_date') ? 'form-control is-invalid' : 'form-control'  ]) ?>
                    @error('end_date')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>
	 <div class="form-group">
                    <?= Form::label('project_id', 'Project Id:') ?>
                    <?= Form::text('project_id', isset($model)?$model->project_id:'' , ['class' => $errors->has('project_id') ? 'form-control is-invalid' : 'form-control'  ]) ?>
                    @error('project_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>
	 <div class="form-group">
                    <?= Form::label('user_id', 'User Id:') ?>
                    <?= Form::text('user_id', isset($model)?$model->user_id:'' , ['class' => $errors->has('user_id') ? 'form-control is-invalid' : 'form-control'  ]) ?>
                    @error('user_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>
	 <div class="form-group">
                    <?= Form::label('task_type_id', 'Task Type Id:') ?>
                    <?= Form::text('task_type_id', isset($model)?$model->task_type_id:'' , ['class' => $errors->has('task_type_id') ? 'form-control is-invalid' : 'form-control'  ]) ?>
                    @error('task_type_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>
	 <div class="form-group">
                    <?= Form::label('status', 'Status:') ?>
                    <?= Form::text('status', isset($model)?$model->status:'' , ['class' => $errors->has('status') ? 'form-control is-invalid' : 'form-control'  ]) ?>
                    @error('status')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>
	
                    
             
                       
                 <button type="submit" class="btn btn-primary-outline">{{isset($model)?'Update':'Add'}} task</button>
               <?= Form::close() ?>
       