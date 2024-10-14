@extends('layouts.master')

@section('title')
    Assessment Detail Page
@endsection

@section('content')
    <div class="content">
        <div class="heading">
            <h1>{{ $assessment->title }}</h1>
            <button type="button" class="my-button edit-button" data-bs-toggle="modal"
                data-bs-target="#editAssessmentModal">Edit Assessment</button>
        </div>
        <p><span class="title">Instruction: </span> {{ $assessment->instruction }} </p>
        <p><span class="title">Number of required reviews: </span> {{ $assessment->numberOfReview }} </p>
        <p><span class="title">Due on: {{ \Carbon\Carbon::parse($assessment->dueDateTime)->format('Y-m-d') }}</span></p>
        <hr>

        <div class="peer-review-content">
            <h5>Enrolled Students</h5>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">sNumber</th>
                        <th scope="col">Name</th>
                        <th scope="col">Number of submitted reviews</th>
                        <th scope="col">Number of reviews received</th>
                        <th scope="col">Score</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($enrolledStudents as $enrolledStudent)
                        <tr>
                            <th scope="row">{{ ($enrolledStudents->currentPage() - 1) * $enrolledStudents->perPage() + $loop->index + 1 }}</th>
                            <td>
                                <a
                                    href="{{ url("$course->courseCode/assessments/$assessment->id/review-list/$enrolledStudent->sNumber") }}">
                                    {{ $enrolledStudent->sNumber }}
                                </a>
                            </td>
                            <td>
                                <a
                                    href="{{ url("$course->courseCode/assessments/$assessment->id/review-list/$enrolledStudent->sNumber") }}">
                                    {{ $enrolledStudent->name }}
                                </a>
                            </td>
                            <td>{{ $enrolledStudent->submittedReviewsCount }}</td>
                            <td>{{ $enrolledStudent->receivedReviewsCount }}</td>
                            <td>{{ $enrolledStudent->score }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td style="border: none" colspan="6">There are no students in this course yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $enrolledStudents->links() }}

            @if ($assessment->type == 'teacher-assign')
                <div class="teacher-assign-group">
                    <div class="heading">
                        <h5>Student Groups</h5>
                        @if($groups->isEmpty())
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                            data-bs-target="#assignStudentModal">Randomly Assign Student</button>
                        @endif
                    </div>
                    @forelse ($groups->groupBy('groupID') as $groupID => $groupMembers)
                        <h6>Group {{ $groupID }}</h6>
                        <ul class="group-list">
                            @foreach ($groupMembers as $member)
                                <li>{{ $member->name }} ({{ $member->sNumber }})</li>
                            @endforeach
                        </ul>
                    @empty
                        <p>No group has been formed yet.</p>
                    @endforelse
                </div>
            @endif
        </div>

        {{-- Back button --}}
        <a href="{{ url("$course->courseCode/assessments") }}"> <button class="btn btn-secondary"
                id="btn-secondary-back">Back
            </button>
        </a>

        {{-- Edit Assessment Model --}}
        <div class="modal fade" id="editAssessmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Assessment</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ url("$course->courseCode/assessments/$assessment->id") }}">
                            {{ csrf_field() }}
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Title</label>
                                @if ($errors->has('title'))
                                    <input type="text" name="title" class="form-control" id="title"
                                        value="{{ old('title') }}" placeholder="Enter assessment title">
                                    <div class="error">
                                        <p>{{ $errors->first('title') }}</p>
                                    </div>
                                @else
                                    <input type="text" name="title" class="form-control" id="title"
                                        value="{{ $assessment->title }}" placeholder="Enter assessment title">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="instruction">Instruction</label>
                                @if ($errors->has('instruction'))
                                    <textarea name="instruction" class="form-control" id="instruction" placeholder="Enter instruction" rows="5">{{ old('instruction') }}</textarea>
                                    <div class="error">
                                        <p>{{ $errors->first('instruction') }}</p>
                                    </div>
                                @else
                                    <textarea name="instruction" class="form-control" id="instruction" placeholder="Enter instruction" rows="5">{{ $assessment->instruction }}</textarea>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="numberOfReview">Number Of Reviews Required</label>
                                @if ($errors->has('numberOfReview'))
                                    <input type="number" class="form-control" name="numberOfReview" id="numberOfReview"
                                        value="{{ old('numberOfReview') }}">
                                    <div class="error">
                                        <p>{{ $errors->first('numberOfReview') }}</p>
                                    </div>
                                @else
                                    <input type="number" class="form-control" name="numberOfReview" id="numberOfReview"
                                        value="{{ $assessment->numberOfReview }}">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="maxScore">Max Score</label>
                                @if ($errors->has('maxScore'))
                                    <input type="number" class="form-control" name="maxScore" id="maxScore"
                                        value="{{ old('maxScore') }}">
                                    <div class="error">
                                        <p>{{ $errors->first('maxScore') }}</p>
                                    </div>
                                @else
                                    <input type="number" class="form-control" name="maxScore" id="maxScore"
                                        value="{{ $assessment->maxScore }}">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="dueDateTime">Due Date and Time</label>
                                @if ($errors->has('dueDateTime'))
                                    <input type="datetime-local" class="form-control" name="dueDateTime"
                                        id="dueDateTime" value="{{ old('dueDateTime') }}">
                                    <div class="error">
                                        <p>{{ $errors->first('dueDateTime') }}</p>
                                    </div>
                                @else
                                    <input type="datetime-local" class="form-control" name="dueDateTime"
                                        id="dueDateTime" value="{{ $assessment->dueDateTime }}">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control form-select" name="type" id="type">
                                    <option value="student-selected"
                                        {{ $assessment->type == 'student-selected' ? 'selected' : '' }}>Student-Selected
                                    </option>
                                    <option value="teacher-assign"
                                        {{ $assessment->type == 'teacher-assign' ? 'selected' : '' }}>Teacher-Assign
                                    </option>
                                </select>
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

        {{-- Assign Student Model --}}
        <div class="modal fade" id="assignStudentModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Course</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ url("assignStudent/$assessment->id") }}">
                            @csrf
                            <label for="numberOfStudent">Number of students in a group:</label>
                            <input type="number" name="numberOfStudent" id="numberOfStudent" required>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" value="Create" class="btn btn-primary">
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
        @if ($errors->any())
            var addModal = new bootstrap.Modal(document.getElementById('editAssessmentModal'));
            addModal.show();
        @endif
    </script>
@endsection
