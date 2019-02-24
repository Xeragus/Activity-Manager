@extends('layouts.non-user-layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Started at</th>
                        <th scope="col">Finished at</th>
                        <th scope="col">Time spent</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($activities as $activity)
                        <tr>
                            <td>{{$activity->getDescription()}}</td>
                            <td>{{$activity->getStartedAt()}}</td>
                            <td>{{$activity->getFinishedAt()}}</td>
                            <td>{{$activity->getTimeSpent()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection