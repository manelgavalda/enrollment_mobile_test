@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Enrollments
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Enrollments</div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Validated</th>
                                <th>Finished</th>
                                <th>Study id</th>
                                <th>Course id</th>
                                <th>Classroom id</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($enrollments as $enrollment)
                                <tr>
                                    <td>{{$enrollment->id}}</td>
                                    <td>{{$enrollment->name}}</td>
                                    <td>{{$enrollment->validated}}</td>
                                    <td>{{$enrollment->finished}}</td>
                                    <td>{{$enrollment->study_id}}</td>
                                    <td>{{$enrollment->course_id}}</td>
                                    <td>{{$enrollment->classroom_id}}</td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
