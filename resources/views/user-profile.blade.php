@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <!-- <div class="card-header d-flex justify-content-end align-items-end" style="background-color:#1d1dff; height:200px;">
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-globe"></i></a>
                        <a href="#"><i class="bi bi-github"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div> -->
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <img src="https://laravbucket.s3.ap-southeast-2.amazonaws.com/images/q1EhT1vf4eLwpYjyY6Ok5z4RvZV4RJxnZtedrCjc.jpg" alt="Profile picture" class="rounded-circle me-3" style="width: 150px;">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h3 class="mb-0">{{ ucfirst($user->firstname) }} {{ $user->last_name }}</h3>
                                <div class="dropdown ms-auto position-absolute end-0">
                                    <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="#">Copy</a></li>
                                        <li><a class="dropdown-item" href="#">Print</a></li>
                                        <li><a class="dropdown-item" href="#">Download</a></li>
                                    </ul>
                                </div>
                            </div>

                            <p class="mb-1 fw-bold"><i class="bi bi-laptop-fill" style="color:#1d1dff"></i> {{ ucfirst($user->expertise) }}, {{ $user->experience }} years experience</p>
                            <p class="mb-1 fw-bold"><i class="bi bi-book-fill" style="color:#1d1dff"></i> {{ $user->education }}</p>
                            <p class="mb-1"><i class="bi bi-geo-alt-fill" style="color:#1d1dff"></i> {{ $user->address }}</p>
                            <div class="btn-group mb-3" role="group">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color:#1d1dff"><i class="bi bi-chat-dots"></i> Message</button>
                                <button type="button" class="btn btn-secondary" style="background-color:#1d1dff"><i class="bi bi-heart"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Send message to <b>{{ ucfirst($user->firstname) }}</b></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <textarea class="form-control" rows="5" cols="10">Hi {{ ucfirst($user->firstname) }}, I came across your profile and I'm impressed. I'd like to discuss my project with you. Please let me know if you're available for a new project. Thanks
                                
                            </textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" style="background-color:#1d1dff">Send Message</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-title mt-3" style="margin-left:15px;">
                    <h4>About</h4>
                </div>
                <div class="card-body">
                    <p class="lead">{{ $user->about }}</p>
                </div>
            </div>


            <div class="card mt-5">
                <div class="card-title mt-3" style="margin-left:15px;">
                    <h4>Skills</h4>
                    <p>The number behind the skill indicates years of experience</p>
                </div>
                <div class="card-body">
                    <!-- <button type="button" class="btn btn-dark me-2 mb-1 position-relative" style="background-color:#1d1dff;border:#1d1dff;">
  PHP<span class="position-absolute top-0 end-10 bg-white rounded-circle text-dark fw-bold px-2 py-1" style="font-size: 0.8em; margin-top: -0.8em; margin-right: -0.5em;">5</span>
</button> -->
                    @foreach($user->skills as $skill)

                    <button type="button" class="btn btn-dark me-2 mb-1" style="background-color:#1d1dff;color:#fff;border:#1d1dff;font-size:medium">
                        {{ $skill->name }}
                        <span class="badge bg-info rounded-pill">{{ $skill->year }}</span>
                    </button>

                    @endforeach
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-title mt-3" style="margin-left:15px;">
                    <div class="d-flex justify-content-between">
                        <h4>Available Days and Hours</h4>
                        <span class="lead" style="margin-right: 10px;">{{ $user->availableHours }} hours/week</span>

                    </div>
                    <div class="mt-3 lead">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="monday" id="monday" value="Monday" title="Monday" {{in_array('Monday',$days)?'checked':''}}>
                            <label class="form-check-label lead" for="monday">Monday</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tuesday" id="tuesday" value="Tuesday" title="Tuesday" {{in_array('Tuesday',$days)?'checked':''}}>
                            <label class="form-check-label lead" for="tuesday">Tuesday</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="wednesday" id="wednesday" value="Wednesday" title="Wednesday" {{in_array('Wednesday',$days)?'checked':''}}>
                            <label class="form-check-label lead" for="wednesday">Wednesday</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="thursday" id="thursday" value="Thursday" title="Thursday" {{in_array('Thursday',$days)?'checked':''}}>
                            <label class="form-check-label" for="thursday">Thursday</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="friday" id="friday" value="Friday" title="Friday" {{in_array('Friday',$days)?'checked':''}}>
                            <label class="form-check-label" for="friday">Friday</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="saturday" id="saturday" value="Saturday" title="Saturday" {{in_array('Saturday',$days)?'checked':''}}>
                            <label class="form-check-label" for="saturday">Saturday</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sunday" id="sunday" value="Sunday" title="Sunday" {{in_array('Sunday',$days)?'checked':''}}>
                            <label class="form-check-label" for="sunday">Sunday</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-title mt-3" style="margin-left:15px;">
                    <h4>Work</h4>
                </div>
                <div class="card-body">
                    <p class="lead"><span class="fw-bold" style="font-size:large;">Work Preference:</span> {{ $user->workPreference }}</p>
                    <p class="lead"><span class="fw-bold" style="font-size:large;">Work Type:</span> {{ $user->workType }}</p>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-title mt-3" style="margin-left:15px;">
                    <h4>Employment history</h4>
                    {{$user}}
                    @foreach($user->employments as $employment)
                        {{ $employment->job_title}}
                    @endforeach
                </div>
                <div class="card-body">
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

<style>
    .social-icons a {
        color: #fff;
        margin-left: 10px;
    }
</style>