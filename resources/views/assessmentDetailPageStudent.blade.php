@extends('layouts.master')

@section('title')
    Assessment Detail Page
@endsection

@section('content')
    <div class="content">
        <h1>{{ $assessment->title }}</h1>
        <p><span class="title">Instruction: </span> {{ $assessment->instruction }} </p>
        <p><span class="title">Number of required reviews: </span> {{ $assessment->numberOfReview }} </p>
        <p><span class="title">Due on: {{ \Carbon\Carbon::parse($assessment->dueDateTime)->format('Y-m-d') }}</span></p>
        <hr>

        <div class="peer-review-content">
            <h5>Your Peer Review</h5>
            @if ($assessment->type == 'student-selected')
                <div class="peer-review-content-details">
                    <div class="peer-review-confirmation">
                        <p>You have submitted {{ $count }}/{{ $assessment->numberOfReview }} peer review.</p>
                        @if ($count == $assessment->numberOfReview)
                            <i id="tick-icon" class="fa-solid fa-check"></i>
                        @endif
                    </div>
                    @forelse ($reviews as $review)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title h6">Reviewee:
                                    {{ $review->revieweeID . ' - ' . $review->reviewee->name }}</h5>
                                <p class="card-text">{{ $review->reviewText }}</p>
                            </div>
                        </div>
                    @empty
                    @endforelse
                    @if ($count < $assessment->numberOfReview)
                        <button type="button" class="my-button add-button" data-bs-toggle="modal"
                            data-bs-target="#addPeerReviewModal"><i class="fa-solid fa-plus"></i>Add Peer Review</button>
                    @endif
                </div>
            @else
                <div class="peer-review-content-details">
                    <div class="peer-review-confirmation">
                        <p>You have submitted {{ $count }}/{{ $assessment->numberOfReview }} peer review.</p>
                        @if ($count == $assessment->numberOfReview)
                            <i id="tick-icon" class="fa-solid fa-check"></i>
                        @endif
                    </div>
                    @forelse ($reviews as $review)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title h6">Reviewee:
                                    {{ $review->revieweeID . ' - ' . $review->reviewee->name }}</h5>
                                <p class="card-text">{{ $review->reviewText }}</p>
                            </div>
                        </div>
                    @empty
                    @endforelse

                    {{-- If the user have not submmit enough reviews, so add review button --}}
                    @if ($count < $assessment->numberOfReview)
                        @forelse ($groupMembers as $member)
                            @if (!$member->hasReviewed)
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title h6">Reviewee:
                                            {{ $member->sNumber . ' - ' . $member->name }}</h5>
                                        <!-- Check if the user has already reviewed this member -->
                                        <button type="button" class="my-button add-button" data-bs-toggle="modal"
                                            data-bs-target="#addGroupPeerReviewModal"
                                            data-member-id="{{ $member->sNumber }}" onclick="takeMemberSNumber(this)">
                                            <i class="fa-solid fa-plus"></i>Add Peer Review
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @empty
                        @endforelse
                    @endif
                </div>
            @endif
        </div>

        {{-- Rate Review Model --}}
        <div class="modal fade" id="rateReviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Rate The Review</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="ratingForm" method="post" action="{{ url('/saveFeedback') }}" onsubmit="updateURL()">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-4" for="star-rating-group">Rating</label>
                                <div class="star-rating col-8" id="star-rating-group">
                                    <input type="radio" id="star5" name="rating" value="5">
                                    <label for="star5" class="star">&#9733;</label>
                                    <input type="radio" id="star4" name="rating" value="4">
                                    <label for="star4" class="star">&#9733;</label>
                                    <input type="radio" id="star3" name="rating" value="3">
                                    <label for="star3" class="star">&#9733;</label>
                                    <input type="radio" id="star2" name="rating" value="2">
                                    <label for="star2" class="star">&#9733;</label>
                                    <input type="radio" id="star1" name="rating" value="1">
                                    <label for="star1" class="star">&#9733;</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="feedback">Feedback</label>
                                <textarea name="feedback" id="feedback" rows="5" class="form-control"
                                    placeholder="Enter your feedback (Optional)"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="peer-review-received-content">
            <h5 id="received-peer-review-heading">Received Peer Review</h5>
            <div class="peer-review-content-details">
                @forelse ($receivedReviews as $receivedReview)
                    <div class="card">
                        <div class="card-body received-review">
                            <div>
                                <h5 class="card-title h6">Reviewer:
                                    {{ $receivedReview->reviewerID . ' - ' . $receivedReview->reviewer->name }}</h5>
                                <p class="card-text">{{ $receivedReview->reviewText }}</p>
                            </div>
                            <div>
                                <h6 id="rate-review-question">Is this review useful?</h6>
                                <button type="button" class="my-button rate-review-button" data-bs-toggle="modal"
                                    data-reviewee-id="{{ $receivedReview->reviewerID }}"
                                    data-bs-target="#rateReviewModal" onclick="takeRevieweeSNumber(this)">Rate This
                                    Review</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>You have not received any peer reviews yet.</p>
                @endforelse
            </div>
        </div>

        {{-- Add Peer Review Model --}}
        <div class="modal fade" id="addPeerReviewModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Peer Review</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post"
                            action="{{ url("courses/$course->courseCode/assessments/{$assessment->id}/peerReview") }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="revieweeID">Select Reviewee</label>
                                <select name="revieweeID" class="form-control form-select" id="revieweeID">
                                    <option value="" disabled selected>Select a student</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->sNumber }}">{{ $student->sNumber }} -
                                            {{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="reviewText">Review Text</label>
                                <textarea name="reviewText" class="form-control" id="reviewText" rows="5"
                                    placeholder="Enter your review (at least 5 words)"></textarea>
                                @if ($errors->has('reviewText'))
                                    <div class="error">
                                        <p>{{ $errors->first('reviewText') }}</p>
                                    </div>
                                @endif

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add Group Peer Review Model --}}
        <div class="modal fade" id="addGroupPeerReviewModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Peer Review</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post"
                            action="{{ url("courses/$course->courseCode/assessments/{$assessment->id}/peerReview") }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="revieweeID" value="" id="memberID">

                            <div class="form-group">
                                <label for="reviewText">Review Text</label>
                                <textarea name="reviewText" class="form-control" id="reviewText" rows="5"
                                    placeholder="Enter your review (at least 5 words)"></textarea>
                                @if ($errors->has('reviewText'))
                                    <div class="error">
                                        <p>{{ $errors->first('reviewText') }}</p>
                                    </div>
                                @endif

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let revieweeID = '';
        let memberID = '';

        function takeRevieweeSNumber(button) {
            revieweeID = button.getAttribute('data-reviewee-id');
        }

        function takeMemberSNumber(button) {
            memberID = button.getAttribute('data-member-id');
            document.getElementById('memberID').value = memberID;
        }

        function updateURL() {
            var form = document.getElementById('ratingForm');
            form.action = "{{ url('/saveFeedback') }}" + "/" + revieweeID;
        }
        @if ($errors->any())
            var addModal = new bootstrap.Modal(document.getElementById('addPeerReviewModal'));
            addModal.show();
        @endif
    </script>
@endsection
