@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="page-header">
                    <h2>Todo Detail</h2>
                </div>
                <div class="card">
                    <div class="card-header">{{$todo->title}}</div>

                    <div class="card-body">
                        {{$todo->description}}
                    </div>
                </div>
                <div class="card-footer">
                    @can('update', $todo)
                        <a href="/tasks/{{$todo->id}}/edit" class="btn btn-warning">Edit Todo</a>
                    @endcan

                        @can('delete', $todo)
                            <form style="float:right" method="POST" action="/todo/{{$todo->id}}">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        @endcan
                </div>
            </div>
        </div>

    </div>
@endsection
