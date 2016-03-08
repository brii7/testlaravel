@extends('layouts.app')

@section('content')

@if (count($assignments) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            Current Assignments
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">

                <thead>
                    <th>Assignment Name</th>
                </thead>

                <tbody>
                @foreach ($assignments as $assignment)
                    <tr>

                        <td class="table-text">
                            <div>{{ $assignment->name }}</div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection