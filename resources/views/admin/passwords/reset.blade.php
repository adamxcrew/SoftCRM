@extends('layouts.base')

@section('caption', 'Password change')

@section('title', 'Password change')

@section('content')
    @include('layouts.template.errors')

    <!-- /. ROW  -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        {{ Form::open(['route' => 'password.reset.process']) }}
                        <div class="col-lg-12">
                            <div class="form-group input-row">
                                {{ Form::label('old_password', 'Old password') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                                    {{ Form::text('old_password', null, ['class' => 'form-control', 'placeholder' => App\Traits\Language::getMessage('messages.input_text')]) }}
                                </div>
                            </div>
                            <div class="form-group input-row">
                                {{ Form::label('new_password', 'New password') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                                    {{ Form::text('new_password', null, ['class' => 'form-control', 'placeholder' => App\Traits\Language::getMessage('messages.input_text')]) }}
                                </div>
                            </div>
                            <div class="form-group input-row">
                                {{ Form::label('confirm_password', 'Repeat new password') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                                    {{ Form::text('confirm_password', null, ['class' => 'form-control', 'placeholder' => App\Traits\Language::getMessage('messages.input_text')]) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 validate_form">
                            {{ Form::submit('Change password', ['class' => 'btn btn-primary']) }}
                        </div>
                    {{ Form::close() }}
                    <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
@endsection
