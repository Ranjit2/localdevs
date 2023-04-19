@extends('layouts.app')

@section('content')
<div class="container">
<h2 class="mt-4">Developers meetup</h2>
<a href="/create-devs-talks">Create</a>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col-md-4">
            <div class="card text-white bg-dark">
                <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text">This is some sample content for the card. Replace it with your own content.</p>
                </div>
                <div class="card-footer">
                    <div class="">
                        <a href="#" class="card-link text-dark text-decoration-none">View <i class="bi bi-arrow-right"></i></a>
                        <span class="text-dark">18 April</span>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-dark">
                <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text">This is some sample content for the card. Replace it with your own content.</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="card-link text-dark text-decoration-none">View <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-dark">
                <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text">This is some sample content for the card. Replace it with your own content.</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="card-link text-dark text-decoration-none">View <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-dark">
                <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text">This is some sample content for the card. Replace it with your own content.</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="card-link text-dark text-decoration-none">View <i class="bi bi-arrow-right"></i></a>
                    18 April
                </div>
            </div>
        </div>
    </div>
</div>

@endsection