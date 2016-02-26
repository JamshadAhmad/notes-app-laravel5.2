@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    This is application's default page. Go to <a href="{{url('notes')}}">Notes</a> to see you notes.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
