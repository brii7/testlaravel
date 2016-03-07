@extends('layouts.app')

@section('content')
    <div id="container-replymsg">

        <div id="sidebar-replymsg">
            <li><span class="important">I suck at designing</span></li>
            <li><a href="{!! route('messages') !!}">Messages</a></li>
            <li><a href="{!! route('messages.create') !!}">Create message</a></li>
        </div>

        <div id="body-replymsg" class="col-md-6">
            <h2 class="border-bottom-separator">{!! $thread->subject !!}</h2>
            @foreach($thread->messages as $message)
                <div style="margin-top: 20px;" class="media">
                    <!--<a class="pull-left" href="#">
                        <img src="//www.gravatar.com/avatar/{!! md5($message->user->email) !!}?s=64" alt="{!! $message->user->name !!}" class="img-circle">
                    </a> -->
                    <div class="media-body">
                        <h5 style="font-size: 15px;" class="media-heading"><strong>{!! $message->user->name !!}</strong></h5>
                        <p>{!! $message->body !!}</p>
                        <div class="text-muted"><small>Sent {!! $message->created_at->diffForHumans() !!}</small></div>
                    </div>
                </div>
            @endforeach

            <h3>Reply</h3>
            {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
                    <!-- Message Form Input -->
            <div class="form-group">
                {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
            </div>

            <!-- @if($users->count() > 0)
                    <div class="checkbox">
                        @foreach($users as $user)
                    <label title="{!! $user->name !!}"><input type="checkbox" name="recipients[]" value="{!! $user->id !!}">{!! $user->name !!}</label>
                    @endforeach
                    </div>
                    @endif -->

            <!-- Submit Form Input -->
            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop