@extends('layouts.app')

@section('content')


<div class="container mt-5">
    <h1 class="text-center mb-5">Event Form</h1>
    <div class="row justify-content-center">

        <div class="col-md-10">
            <form>
                <div class="mb-3">
                    <label for="eventName" class="form-label">Name of Event</label>
                    <input type="text" class="form-control" id="eventName" name="eventName">
                </div>
                <div class="mb-3">
                    <label for="eventDescription" class="form-label">Body or Description</label>
                    <textarea class="form-control" id="eventDescription" name="eventDescription" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="eventLocation" class="form-label">Location</label>
                    <input type="text" class="form-control" id="eventLocation" name="eventLocation">
                </div>
                <div class="mb-3">
                    <label for="eventDate" class="form-label">Date</label>
                    <input type="date" class="form-control" id="eventDate" name="eventDate">
                </div>
                <div class="mb-3">
                    <label for="eventTime" class="form-label">Time</label>
                    <input type="time" class="form-control" id="eventTime" name="eventTime">
                </div>

                <!-- Speaker Fields -->
                <hr>
                <h2 class="text-center mb-4">Speaker Information</h2>
                <div class="speaker-fields-container">
                    <div class="speaker-fields">
                        <div class="mb-3">
                            <label for="speakerName" class="form-label">Name of Speaker</label>
                            <input type="text" class="form-control" id="speakerName" name="speakerName[]">
                        </div>
                        <div class="mb-3">
                            <label for="speakerAbout" class="form-label">About Speaker</label>
                            <textarea class="form-control" id="speakerAbout" name="speakerAbout[]" rows="3"></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="speakerTwitter" class="form-label">Twitter</label>
                                <input type="text" class="form-control" id="speakerTwitter" name="speakerTwitter[]">
                            </div>
                            <div class="col">
                                <label for="speakerLinkedIn" class="form-label">LinkedIn</label>
                                <input type="text" class="form-control" id="speakerLinkedIn" name="speakerLinkedIn[]">
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-primary mt-3" id="addSpeakerBtn">Add More</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<script>
    // Get the container element and the "Add More" button
const container = document.querySelector('.speaker-fields-container');
const addSpeakerBtn = document.querySelector('#addSpeakerBtn');

// Add a click event listener to the "Add More" button
addSpeakerBtn.addEventListener('click', () => {
    // Get the current number of speaker fields
    const currentCount = container.querySelectorAll('.speaker-fields').length;
    
    // If the current count is less than 10, add a new speaker field
    if (currentCount < 10) {
        // Clone the first speaker field
        const newSpeakerFields = container.querySelector('.speaker-fields').cloneNode(true);
        
        // Clear the values of the new speaker fields
        newSpeakerFields.querySelectorAll('input, textarea').forEach(field => {
            field.value = '';
        });
        
        // Append the new speaker fields to the container
        container.appendChild(newSpeakerFields);
    } else {
        // If the current count is 10, disable the "Add More" button
        addSpeakerBtn.disabled = true;
    }
});

</script>

@endsection