@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong>Update Todo</strong></div>

                    <div class="card-body">
                        <form method="POST" action="/tasks/{{$todo->id}}">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter a title for your task" value="{{$todo->title}}">
                            </div>
                            <div class="form-group">
                                    <textarea class="form-control" name="description" placeholder="Provide a description for your task" rows="8">{{$todo->description}}
                                    </textarea>
                            </div>
                            <button class="btn btn-primary" type="Submit" >Edit Todo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
