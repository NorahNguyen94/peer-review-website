@extends('layouts.master')

@section('title')
    Home Page
@endsection

@section('content')
    <div class="content">
        <div class="course-info">
            <h1>My Courses</h1>
            @if(session('role') == 'teacher')
            <button type="button" class="my-button add-button" data-bs-toggle="modal" data-bs-target="#uploadFileModal">Upload
                Course File</button>
            @endif
        </div>
        <ul class="list-group list-group-flush">
            @forelse ($courses as $course)
                @php
                    // Generate random RGB values to color icons
                    $r = rand(0, 255);
                    $g = rand(0, 255);
                    $b = rand(0, 255);
                @endphp
                <li class="list-group-item course-list">
                    <i class="fa-solid fa-square"
                        style="color: rgb({{ $r }}, {{ $g }}, {{ $b }})"></i>

                    <a href="{{ url("$course->courseCode/assessments") }}">
                        {{ $course->courseCode }} - {{ $course->courseName }}
                    </a>
                </li>
            @empty
                <p>You are not enrolled in any courses</p>
            @endforelse
        </ul>

        {{-- Upload File Model --}}
        <div class="modal fade" id="uploadFileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Course</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ url('/addCourse') }}" enctype="multipart/form-data">
                            @csrf
                            <label for="courseFile">Upload Course File:</label>
                            <input type="file" name="courseFile" id="courseFile" required>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" value="Upload" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
