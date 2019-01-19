@extends('admin.layouts.master')

@section('content')

    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-customView_index-list') }}</div>
        </div>
        <div class="portlet-body">
            @foreach($comments as $comment)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>{{ $comment->user->name }}</strong> <span class="text-muted">{{ $comment->created_at }}</span>
                            </div>
                            <div class="panel-body">
                                {{ $comment->body }}
                            </div><!-- /panel-body -->
                            {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'POST', 'route' => array('comment.accept', $comment->id))) !!}
                            {!! Form::submit('Accept', array('class' => 'btn btn-success')) !!}
                            {!! Form::close() !!}

                            {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'POST', 'route' => array('comment.reject', $comment->id))) !!}
                            {!! Form::submit('Reject', array('class' => 'btn btn-danger')) !!}
                            {!! Form::close() !!}

                        </div><!-- /panel panel-default -->
                    </div><!-- /col-sm-5 -->
                </div>
            @endforeach
	</div>

@endsection