@extends('admin.layouts.master')

@section('content')


@if ($games ->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                <thead>
                    <tr>
                        <th>Maximum Score</th>
                        <th>User</th>
                        <th>Number Of Dice</th>
                        <th>Playing</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($games as $row)
                        <tr>
                            <td>{{ $row->maximum_score }}</td>
                            <td>{{ $row->user->name }}</td>
                            <td>{{ $row->dice_number }}</td>
                            <td>
                                <input type="button" value="Playing" class="btn btn-success">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{--{!! Form::open(['route' => 'game.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}--}}
                {{--<input type="hidden" id="send" name="toDelete">--}}
            {{--{!! Form::close() !!}--}}
        </div>
	</div>
@else
    {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
@endif

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $('#delete').click(function () {
                if (window.confirm('{{ trans('quickadmin::templates.templates-view_index-are_you_sure') }}')) {
                    var send = $('#send');
                    var mass = $('.mass').is(":checked");
                    if (mass == true) {
                        send.val('mass');
                    } else {
                        var toDelete = [];
                        $('.single').each(function () {
                            if ($(this).is(":checked")) {
                                toDelete.push($(this).data('id'));
                            }
                        });
                        send.val(JSON.stringify(toDelete));
                    }
                    $('#massDelete').submit();
                }
            });
        });
    </script>
@stop