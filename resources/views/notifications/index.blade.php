@extends('layouts.app')

@section('content')

    <div class="container">
    <div class="row">
    <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        @if (count($notifications) > 0)

            <div class="panel-heading">
                <h3>You have {{ $unread }} unread notifications.</h3>
                @if($warnings == 1)
                    <h4>{{ $warnings }} of which is a warning.</h4>
                @else
                    <h4>{{ $warnings }} of which are warnings.</h4>
                @endif
            </div>
            <div class="panel-body">
                <ul>
                    <!-- First dislay unread -->
                    @foreach ($notifications as $notification)
                            @if($notification->state == 'Unread')
                                    @if($notification->type == 'Warning')
                                            <li class="notification alert-danger">
                                            <i class="fa fa-bell" style="color: black"></i>
                                    @elseif($notification->type == 'Advice')
                                            <li class="notification alert-info">
                                            <i class="fa fa-bell" style="color: black"></i>
                                    @elseif($notification->type == 'Inactivity')
                                            <li class="notification alert-warning">
                                            <i class="fa fa-bell" style="color: black"></i>

                                    @endif
                                            <a href="{{ url('notifications/'.$notification->id) }}">{{ $notification->name }}</a>
                                            </li>
                            @endif
                    @endforeach
                    @foreach ($notifications as $notification)
                        @if($notification->state == 'Read')
                            <li class="notification">
                                <i class="fa fa-bell-slash"></i>
                                <a href="{{ url('notifications/'.$notification->id) }}">{{ $notification->name }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <a href="{!! url('notifications/readAll') !!}"><button type="button" class="btn btn-primary">Mark all as read</button></a>
            </div>
        @else
            <div class="panel-body">
                <p>You have no notifications.</p>
            </div>
        @endif
    </div>
    </div>
    </div>
    </div>
@endsection