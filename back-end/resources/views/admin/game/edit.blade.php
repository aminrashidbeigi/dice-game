@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_edit-edit') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::model($game, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('game.update', $game->id))) !!}
config('quickadmin.route')
<div class="form-group">
    {!! Form::label('maximum_score', 'Maximum Score*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('maximum_score', old('maximum_score',$game->maximum_score), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('current_score', 'Current Score', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('current_score', old('current_score',$game->current_score), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('dice_number', 'Number Of Dice', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10 d-inline-flex">
        {!! Form::radio('dice_number', '1', true) !!} <p>1</p>
        {!! Form::radio('dice_number', '2', false) !!} <p>2</p>
        {!! Form::radio('dice_number', '3', false) !!} <p>3</p>
        {!! Form::radio('dice_number', '4', false) !!} <p>4</p>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('game.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection