@extends('layouts.app')
@section('scripts')
    <script type="text/javascript" src="{{ URL::asset('js/notificationread.js') }}"></script>
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 style="margin-top: 10px">
                            @if($notification->type == 'Warning')
                                <i style="color:red" class="fa fa-exclamation"></i>
                            @endif
                            {{ $notification->name }}
                        </h3>
                        <h5>Sent on {{ $notification->created_at }}.</h5>
                    </div>
                    <div class="panel-body">
                        {{ $notification->description }}
                    </div>
                    <div class="panel-body">
                        <a href="{!! route('notifications') !!}"><button type="button" class="btn btn-primary">Back to your notifications</button></a>
                        @if($notification->state == 'Read')
                            <p class="check-read" style="font-size: 10px; margin-top: 5px;">Read on: {{ $notification->updated_at }}</p>
                        @endif
                    </div>
                    
                </div>
          </div>
        </div>
    </div>
@endsection
