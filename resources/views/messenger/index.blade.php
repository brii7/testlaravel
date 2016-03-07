@extends('layouts.app')

@section('content')
    @if (Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            {!! Session::get('error_message') !!}
        </div>
    @endif
    <div id="container-replymsg">
        <div id="sidebar-replymsg">
            <li><span class="important">I suck at designing</span></li>
            <li><a href="{!! route('messages') !!}">Messages</a></li>
            <li><a href="{!! route('messages.create') !!}">Create message</a></li>
        </div>

        <div id="body-replymsg" class="col-md-6">
            <h3>Messages</h3>
            @if($threads->count() > 0)
                @foreach($threads as $thread)
                    <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                    <div id="message-box" class="media alert {!!$class!!}">
                        <h4 class="media-heading">{!! link_to('messages/' . $thread->id, $thread->subject) !!}</h4>
                        <!-- <p>{!! $thread->latestMessage->body !!}</p> -->
                        <p><small><strong>From:</strong> {!! $thread->creator()->name !!}</small></p>
                       <!-- <p><small><strong>Participants:</strong> {!! $thread->participantsString(Auth::id()) !!}</small></p> -->
                    </div>
                @endforeach
            @else
                <p>You have no messages.</p>
            @endif
        </div>
    </div>
@stop