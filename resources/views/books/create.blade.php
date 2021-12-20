@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <div class="row">
                   <div>
                    <h1>Create Book</h1>
                    </div>
                    <div class="form">
                        <form action="submit-book" class="form" method="post">
                            {{ csrf_field() }}
                            <div class=" @if($errors->has('title')) has-error @endif">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title">
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            </div>
                            <div class="@if($errors->has('description')) has-error @endif">
                                <label>Description</label>
                                <textarea class="form-control" name="description" cols="3" rows="5"></textarea>
                                <span class="text-danger">{{ $errors->first('content') }}</span>
                            </div>
                            <div>
                                <label for="authors">Choose an author:</label>

                                <select name="author_id" id="author_id">
                                @foreach($authors as $author)
                                  <option value={{$author->id}}>{{$author->name}}</option>
                                @endforeach
                            </div>
                            <div>
                                <label>Cover img</label>
                                <input type="file" name="cover" accept=".png, .jpeg">
                            </div>
                            <div>
                                <button class="btn btn-primary">Publish</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
