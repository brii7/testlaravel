@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')


        <form action="" method="POST" id="form" class="form-horizontal">
            {!! csrf_field() !!}
            <div class="form-horizontal">
                <h3><strong>Notification for: </strong> {{ $user->name }}</h3>
            </div>

            <div class="form-group">
                <label for="not-user" class="col-sm-3 control-label">User ID: </label>
                <div class="col-sm-6">
                    <input type="number" name="not-user" id="not-user" class="form-control" value="{{ $user->id }}">
                </div>
            </div>
            <div class="form-group">
                <label for="not-name" class="col-sm-3 control-label">Name: </label>
                <div class="col-sm-6">
                    <input type="text" name="not-name" id="not-name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="not-desc" class="col-sm-3 control-label">Description: </label>
                <div class="col-sm-6">
                    <input type="text" name="not-desc" id="not-desc" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="not-type" class="col-sm-3 control-label">Type: </label>
                <select name="not-type" form="form">
                    <option value="Warning">Warning</option>
                    <option value="Advice">Advice</option>
                    <option value="Inactivity">Inactivity</option>
                </select>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-bell-o"></i> Notify User
                    </button>
                </div>
            </div>
        </form>
    </div>


@endsection