@extends('layouts.master')

@section('title')
    Home Page
@endsection

@section('content')
    <div class="content">
        <h1>Review Leaderboard</h1>
        <h6>Here is the list of top reviewers who contributue useful reviews to other students:</h6>

        <ul class="list-group list-group-flush">
            @foreach ($topReviewers as $reviewer)
                <li class="list-group-item">
                    <i class="fa-solid fa-crown"></i>
                    <span class="reviewer-name">{{ $reviewer->sNumber }} - {{ $reviewer->name }}</span>
                    @switch($loop->index)
                        @case(0)
                            <span class="badge rounded-pill text-bg-light">Diamond Badge</span>
                        @break

                        @case(1)
                            <span class="badge rounded-pill text-bg-warning">Gold Badge</span>
                        @break

                        @case(2)
                            <span class="badge rounded-pill text-bg-secondary">Silver Badge</span>
                        @break

                        @case(3)
                            <span class="badge-bronze">Bronze Badge</span>
                        @break

                        @case(4)
                            <span class="badge-copper">Copper Badge</span>
                        @break
                    @endswitch
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
