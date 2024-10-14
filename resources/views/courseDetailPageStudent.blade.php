@extends('layouts.master')

@section('title')
    Course Detail Page
@endsection

@section('content')
    <div class="content">
        <h1>{{ $course->courseCode }} - {{ $course->courseName }}</h1>
        <h5>Teacher:
            @foreach ($teachers as $teacher)
                {{ $loop->last ? $teacher->name . '.' : $teacher->name . ',' }}
            @endforeach
        </h5>
        <div class="course-info">
            <h6>Here is the list of assessments for this course:</h6>
        </div>

        <ul class="list-group list-group-flush course-list">
            @forelse ($assessments as $assessment)
                <li class="list-group-item assessment-list">
                    <div>
                        <i class="fa-regular fa-star"></i>
                        <a
                            href="{{ url("courses/$course->courseCode/assessments/{$assessment->id}/peerReview") }}">{{ $assessment->title }}</a>
                    </div>
                    <div id="dueDateMessage">
                        Due on {{ \Carbon\Carbon::parse($assessment->dueDateTime)->format('Y-m-d') }}
                    </div>
                </li>
            @empty
                <p>There have not been any assessments for this course yet</p>
            @endforelse
        </ul>
    </div>
@endsection
