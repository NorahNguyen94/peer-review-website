@extends('layouts.master')

@section('title')
    Assessment Detail Page
@endsection

@section('content')
    <div class="content">
        <h1>Peer Review of {{ $user->sNumber }} - {{ $user->name }} </h1>
        <h3>{{ $assessment->title }}</h3>
        <hr>

        <div class="score">
            <form method="post" action="{{ url("$courseCode/assessments/$assessment->id/review-list/$user->sNumber") }}">
                @csrf
                <label for="score" class="h6">Score</label>
                @if ($scoreUser && $scoreUser->pivot && $scoreUser->pivot->score != null)
                    <input type="number" name=score id="score" value="{{ $scoreUser->pivot->score }}">
                    /{{ $assessment->maxScore }}
                @else
                    <input type="number" name=score id="score"> /{{ $assessment->maxScore }}
                @endif
                <button class="btn btn-outline-success" type="submit" id="score-submit-button">Save</button>
                <div>
                    @if ($errors->has('score'))
                        <p class="error">{{ $errors->first('score') }}</p>
                    @endif
                </div>
            </form>

        </div>

        <div class="peer-review-content">
            <h5 id="received-peer-review-heading">Made Peer Review</h5>
            <div class="peer-review-content-details">
                @forelse ($reviews as $review)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title h6">Reviewee:
                                {{ $review->revieweeID . ' - ' . $review->reviewee->name }}</h5>
                            <p class="card-text">{{ $review->reviewText }}</p>
                        </div>
                    </div>
                @empty
                    <p>{{ $user->name }} has not made any peer reviews.</p>
                @endforelse
            </div>
        </div>

        <div class="peer-review-received-content">
            <h5 id="received-peer-review-heading">Received Peer Review</h5>
            <div class="peer-review-content-details">
                @forelse ($receivedReviews as $receivedReview)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title h6">Reviewer:
                                {{ $receivedReview->reviewerID . ' - ' . $receivedReview->reviewer->name }}</h5>
                            <p class="card-text">{{ $receivedReview->reviewText }}</p>
                        </div>
                    </div>
                @empty
                    <p>{{ $user->name }} has not received any peer reviews yet.</p>
                @endforelse
            </div>
        </div>

        <a href="{{ url("courses/$courseCode/assessments/$assessment->id/peerReview") }}">
            <button class="btn btn-secondary" id="btn-secondary-back">Back</button>
        </a>
    </div>
@endsection
