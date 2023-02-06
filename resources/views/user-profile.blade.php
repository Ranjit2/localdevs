@extends('layouts.app')

@section('content')
<div class="hero">
    <img width="100" style="margin-top:250px;border:2px solid #fff;margin-left:80px;border-radius:100%;" src="https://cdn.mentorcruise.com/cache/9e1b98bebbcda19a4c84c14b5a9413f9/eb9cffd8024c7c9f/3cb7aa75e64409151d1d6bfc1455ab58.jpg">
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h1> {{ $user->firstname }}{{ $user->last_name }}</h1>
            <h3> Software Enginner </h3>
            <p> {{ $user->availableDays }}/week, {{ $user->availableHours }}/week</p>
            <p> Work preference: {{ $user->workPreference }} </p>
            <p> Experience: {{ $user->workPreference}} </p>
            <p> Work type: {{ $user->workType }} </p>
            <a href="/user/profile/{{auth()->id()}}/edit">Edit profile</a>
        </div>
        <div class="col-md-4">
            <h1>Skills</h1>
            @foreach($user->skills->take(3) as $skill)
            <span class="btn btn-secondary">{{ $skill->name }}</span>
            @endforeach
            <a href="#skills">+{{$user->skills->count()}} More skills</a>
        
        </div>
        <div class="col-md-4">
           <button class="btn btn-success mt-5">Say hello to {{ $user->firstname }}</button>
        </div>
    </div>
    <hr>
    <b>{{ $user->about }} Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam minus perspiciatis eum repudiandae, sunt sequi. Molestiae architecto facere excepturi quaerat? Eos dolorum enim sequi tempora sed, eius similique laudantium suscipit?</b>
    <hr>
    <div id="skills">
        @foreach($user->skills as $skill)
            <span class="btn btn-secondary">{{ $skill->name }}</span>
        @endforeach
    </div>
</div>
@endsection
<style>
    body {
        margin: 0;
        padding: 0;
    }

    .hero {
        background-color: rgb(28, 61, 122);
        margin-top: -21px;
        height: 300px;
        color: #fff;
        font-size: 18px;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }
</style>