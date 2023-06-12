@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <message-component user={{auth()->id()}}></message-component>
    </div>
</div>
@endsection