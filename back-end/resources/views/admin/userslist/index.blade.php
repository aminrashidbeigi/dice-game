@extends('admin.layouts.master')

@section('content')

    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-customView_index-list') }}</div>
        </div>
        <div class="portlet-body row">
            @foreach ($users as $user)
                <div class="card col-md-3">
                    <img class="card-img-top" src="/uploads/avatars/{{ $user->avatar }}" alt="User Avatar" style="width: 100px; height: 100px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Played: {{ $user->played }}</li>
                        <li class="list-group-item">Score: {{ $user->score }}</li>
                        <li class="list-group-item">
                            @if($user->isOnline())
                                <p class="text-success">Online</p>
                            @else
                                <p class="text-muted">Offline</p>
                            @endif
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
	</div>

@endsection