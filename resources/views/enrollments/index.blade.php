@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Enrollments
@endsection
@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Done!</h4>
                        {{ session('message') }}
                    </div>
                @endif

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create enrollment</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>

                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        {{--@if (Session::has('message'))--}}
                        {{--<div class="alert alert-success alert-dismissible">--}}
                            {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
                            {{--<h4><i class="icon fa fa-check"></i> Done!</h4>--}}
                            {{--{{ session('message') }}--}}
                        {{--</div>--}}
                        {{--@endif--}}

                        <form role="form" action="/enrollments" method="post" id="createEnrollment">
                            <!-- text input -->
                            {{ csrf_field() }}

                            <input type="hidden" name="validated" value="1">
                            <input type="hidden" name="finished" value="1">
                            <input type="hidden" name="study_id" value="1">
                            <input type="hidden" name="course_id" value="1">
                            <input type="hidden" name="classroom_id" value="1">

                            @php
                                $warning="";
                                if ($errors->has('name')) {
                                    $warning="has-warning";
                                }
                            @endphp

                                <div class="form-group {{ $warning }}">
                                    <label class="control-label" for="inputWarning"><i class="fa fa-bell-o"></i>Name</label>
                                    <input type="text" class="form-control" id="inputWarning" placeholder="Name" name="name" value="{{old('name')}}">
                                    @foreach ($errors->get('name') as $message)
                                        <span class="help-block"> {{ $message }}</span>
                                    @endforeach
                                </div>

                        </form>
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-primary" onclick="document.getElementById('createEnrollment').submit();" type="submit">Create</button>
                    </div>
                </div>

                {{--edit form--}}
                <div class="box box-default" style="display: none">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update enrollment</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>

                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        {{--@if (Session::has('message'))--}}
                            {{--<div class="alert alert-success alert-dismissible">--}}
                                {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
                                {{--<h4><i class="icon fa fa-check"></i> Done!</h4>--}}
                                {{--{{ session('message') }}--}}
                            {{--</div>--}}
                        {{--@endif--}}

                        {{--{{$id=2}}--}}

                        <form role="form" action="/enrollments/3" method="post" id="updateEnrollment">
                            <!-- text input -->
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="validated" value="1">
                            <input type="hidden" name="finished" value="1">
                            <input type="hidden" name="study_id" value="1">
                            <input type="hidden" name="course_id" value="1">
                            <input type="hidden" name="classroom_id" value="1">

                            @php
                                $warning="";
                                if ($errors->has('name')) {
                                    $warning="has-warning";
                                }
                            @endphp

                            <div class="form-group @{{ current}}">
                                <label class="control-label" for="inputWarning"><i class="fa fa-pencil"></i>Name</label>
                                {{--<input type="text" class="form-control" id="inputWarning" placeholder="Id" name="id" value="{{old('id')}}">--}}
                                <input type="text" class="form-control" id="inputWarning" placeholder="Name" name="name" value="{{old('name')}}">
                                @foreach ($errors->get('name') as $message)
                                    <span class="help-block"> {{ $message }}</span>
                                @endforeach
                            </div>

                        </form>
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-primary" onclick="document.getElementById('updateEnrollment').submit();" type="submit">Update</button>
                    </div>
                </div>

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">enrollments</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Actions</th>
                                {{--<th>Validated</th>--}}
                                {{--<th>Finished</th>--}}
                                {{--<th>Study_id</th>--}}
                                {{--<th>Course_id</th>--}}
                                {{--<th>Classroom_id</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($enrollments as $enrollment)
                                <tr>
                                    <td> {{ $enrollment->id  }} </td>
                                    <td> {{ $enrollment->name }} </td>
                                    <td>
                                        <form action="/enrollments/{{$enrollment->id}}" method=POST>
                                            {{ csrf_field() }}
                                            <button class="btn btn-danger" name="_method" value="DELETE" ><i class="fa fa-fw fa-trash"></i></button>
                                        </form>
                                            <button class="btn btn-primary" onclick="document.getElementById('updateEnrollment').submit();" type="submit"><i class="fa fa-fw fa-edit"></i></button>
                                    </td>
                                    {{--<td> {{ $enrollment->validated }} </td>--}}
                                    {{--<td> {{ $enrollment->finished }} </td>--}}
                                    {{--<td> {{ $enrollment->study_id }} </td>--}}
                                    {{--<td> {{ $enrollment->course_id }} </td>--}}
                                    {{--<td> {{ $enrollment->classroom_id }} </td>--}}
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