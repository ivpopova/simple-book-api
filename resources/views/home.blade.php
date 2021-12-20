@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <h1>Books Dashboard</h1>
                <div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="conteiner">
                        @foreach($books as $book)
                            <div class="card">
                                <div class="card-header">
                                    Title: {{$book->title}}
                                </div>
                                <div class="card-body">
                                    <p>IMG</p>
                                    <p>By {{$book->author->name}}</p>
                                    <p>Description: {{$book->description}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
