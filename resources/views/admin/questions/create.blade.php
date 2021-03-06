@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Create a new question</h3>
            </div>
            <div class="panel-body">
                @include('admin.questions.form', [
                    'url' => route('admin.surveys.groups.questions.store', [
                        $survey->id,
                        $group->id,
                        $question->id,
                    ]),
                    'method' => 'post',
                    'button' => 'Create',
                ])
            </div>
        </div>
    </div>
@endsection
