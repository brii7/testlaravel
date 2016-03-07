@extends('layouts.app')
@include('common.errors')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                    <!-- New Task Form -->
                    <div class="panel-heading">
                        <form action="{{ url('task') }}" method="POST" class="form-horizontal">
                            {!! csrf_field() !!}

                                    <!-- Task Name -->
                            <div class="form-group">
                                <label for="task-name" class="col-sm-3 control-label">Add Global Task (Assignment)</label>

                                <div class="col-sm-6">
                                    <input type="text" name="name" id="task-name" class="form-control">
                                </div>
                            </div>

                            <!-- Add Task Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-plus"></i> Add Assignment
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-heading">Users List</div>

                    <table class="table table-responsive">
                        <tr>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Registration date</th>
                            <th>Total tasks</th>
                            <th>Unfinished tasks</th>

                        </tr>

                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->tasks()->count() }}</td>
                                <td>{{ $user->unfinishedtasks()->count() }}</td>
                                <td>
                                    <a href="{{ url('users/notify/'.$user->id) }}">
                                    <button class="btn btn-danger">
                                        <i class="fa fa-exclamation"></i> Notify User
                                    </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
