@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong>Add a new todo</strong></div>

                    <div class="card-body">
                        <form method="POST" action="/todos/create">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter a title for your todo">
                            </div>
                            <div class="form-group">
                                    <textarea class="form-control" name="description" placeholder="Provide a description for your todo" rows="8">
                                    </textarea>
                            </div>
                            <button class="btn btn-primary" type="Submit" >Add Todo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
