@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if(count($notes))
                        Following are your note(s):
                        <ul>
                            @foreach($notes as $n)
                                <li class="col-md-10">{{$n->title}} <a href="{{url('/remove/'.$n->id)}}"><span class="glyphicon glyphicon-remove pull-right col-md-2"></span></a></li>
                            @endforeach
                        </ul>
                    @else
                        You do not have any note yet !
                    @endif
                </div>
            </div>
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">Add a new note</div>

                <div class="panel-body">
                    <form method="post" action="/store">
                        {{csrf_field()}}
                        <input type="text" name="title" placeholder="write a note" class="form-control" required>
                        <input type="submit" value="save" class="btn btn-primary" style="margin-top:10px">
                    </form>
                </div>

                @if(count($errors))
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="alert alert-danger">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
