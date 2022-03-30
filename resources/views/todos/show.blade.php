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
            </div>
        </div>
    </div>
@endsection
