@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="page-header">
                    <h2>All Todos</h2>
                </div>
                @foreach($todos as $todo)
                    <div class="card my-3">
                        <div class="card-header bg-danger text-white">

                            <span>{{$todo->title}}</span>
                            <a class="float-end text-white" href="{{ route("todos.show", $todo->id) }}">
                                <i class="bi-eye"></i>
                            </a>

                        </div>

                        <div class="card-body">
                            {{$todo->description}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
