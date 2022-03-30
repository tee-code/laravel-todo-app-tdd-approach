@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="page-header">
                    <h2>All Todos</h2>
                </div>
                @foreach($todos as $todo)
                    <div class="card">
                        <div class="card-header">{{$todo->title}}</div>

                        <div class="card-body">
                            {{$todo->description}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
