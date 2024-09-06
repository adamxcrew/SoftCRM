@extends('layouts.base')

@section('caption', 'Edit tasks')

@section('title', 'Edit tasks')

@section('lyric', 'lorem ipsum')

@section('content')
    @include('layouts.template.errors')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {{ Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'PUT']) }}
                            <div class="form-group">
                                {{ Form::label('name', 'Name') }}
                                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => App\Traits\Language::getMessage('messages.input_text')]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('duration', 'Duration') }}
                                {{ Form::text('duration', null, ['class' => 'form-control', 'placeholder' => App\Traits\Language::getMessage('messages.input_text')]) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('employee_id', 'Assign employee') }}
                                {{ Form::select('employee_id', $employees, null, ['class' => 'form-control', 'placeholder' => App\Traits\Language::getMessage('messages.input_text')])  }}
                            </div>
                        </div>

                        <div class="col-lg-12">
                            {{ Form::submit('Edit task', ['class' => 'btn btn-primary']) }}
                        </div>

                        {{ Form::close() }}

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>


@endsection
