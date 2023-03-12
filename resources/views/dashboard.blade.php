@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item disabled" aria-disabled="true">Home</li>
                <li class="list-group-item"> <a href="/user/profile/{{auth()->user()->slug}}/edit">Profile</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            Hello, Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga dolore, id quo sed nemo ut quisquam repellendus similique iste debitis aperiam eius nostrum dolor ipsa soluta dolorum quia dignissimos. Impedit.
        </div>
    </div>
</div>
@endsection