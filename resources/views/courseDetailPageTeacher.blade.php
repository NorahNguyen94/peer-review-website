@extends('layouts.master')

@section('title')
    Course Detail Page
@endsection

@section('content')
    <div class="content">
        <h1>{{ $course->courseCode }} - {{ $course->courseName }}</h1>
        <div class="course-info">
            <h6>Here is the list of assessments for this course:</h6>
            <button type="button" class="my-button add-button" data-bs-toggle="modal" data-bs-target="#addAssessmentModal"><i
                    class="fa-solid fa-plus"></i>Add Assessment</button>
        </div>

        {{-- Add Assessment Model --}}
        <div class="modal fade" id="addAssessmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Assessment</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ url("$course->courseCode/assessments") }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="Enter assessment title">
                                @if ($errors->has('title'))
                                    <div class="error">
                                        <p>{{ $errors->first('title') }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="instruction">Instruction</label>
                                <textarea name="instruction" class="form-control" id="instruction" placeholder="Enter instruction" rows="5"></textarea>
                                @if ($errors->has('instruction'))
                                    <div class="error">
                                        <p>{{ $errors->first('instruction') }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="numberOfReview">Number Of Reviews Required</label>
                                <input type="number" class="form-control" name="numberOfReview" id="numberOfReview">
                                @if ($errors->has('numberOfReview'))
                                    <div class="error">
                                        <p>{{ $errors->first('numberOfReview') }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="maxScore">Max Score</label>
                                <input type="number" class="form-control" name="maxScore" id="maxScore">
                                @if ($errors->has('maxScore'))
                                    <div class="error">
                                        <p>{{ $errors->first('maxScore') }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="dueDateTime">Due Date and Time</label>
                                <input type="datetime-local" class="form-control" name="dueDateTime" id="dueDateTime">
                                @if ($errors->has('dueDateTime'))
                                    <div class="error">
                                        <p>{{ $errors->first('dueDateTime') }}</p>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control form-select" name="type" id="type">
                                    <option value="student-selected">Student-Selected</option>
                                    <option value="teacher-assign">Teacher-Assign</option>
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

        <table class="table course-list-table">
            <tbody>
                @forelse ($assessments as $assessment)
                    <tr>
                        <td>
                            <i class="fa-regular fa-star"></i>
                            <a
                                href="{{ url("courses/$course->courseCode/assessments/{$assessment->id}/peerReview") }}">{{ $assessment->title }}</a>
                        </td>
                        <td id="dueDateMessage">
                            Due on {{ \Carbon\Carbon::parse($assessment->dueDateTime)->format('Y-m-d') }}
                        </td>
                        <td><a href="{{ url("$course->courseCode/assessments/$assessment->id/edit") }}">
                                <i id="edit-icon" class="fa-solid fa-pen-to-square"></i></a></td>
                    </tr>
                @empty
                    <p>There have not been any assessments for this course yet</p>
                @endforelse
            </tbody>
        </table>

        <div class="enrolled-students-list">
            <div class="course-info">
                <h6>List of enrolled students:</h6>
                <button type="button" class="my-button add-button" data-bs-toggle="modal"
                    data-bs-target="#enrollStudentModal"><i class="fa-solid fa-plus"></i>Enroll Student</button>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">sNumber</th>
                        <th scope="col">Name</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($enrolledStudents as $enrolledStudent)
                        <tr>
                            <th scope="row">{{ ($enrolledStudents->currentPage() - 1) * $enrolledStudents->perPage() + $loop->index + 1 }}</th>
                            <td>{{ $enrolledStudent->sNumber }}</td>
                            <td>{{ $enrolledStudent->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td style="border: none" colspan="3">There are no students in this course yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $enrolledStudents->links() }}
        </div>
    </div>

    {{-- Enroll Student Model --}}
    <div class="modal fade" id="enrollStudentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Student To The Course</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="enrollForm" method="post" action="{{ url($course->courseCode . '/enroll') }}"
                        onsubmit="updateURL()">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="sNumber">Select student to enroll</label>
                            <select class="form-control form-select" name="sNumber" id="sNumber">
                                @foreach ($students as $student)
                                    <option value="{{ $student->sNumber }}">{{ $student->sNumber }} -
                                        {{ $student->name }}</option>
                                @endforeach
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
@endsection

@section('script')
    <script>
        function updateURL() {
            var sNumber = document.getElementById('sNumber').value;
            var form = document.getElementById('enrollForm');
            form.action = "{{ url($course->courseCode . '/enroll') }}" + "/" + sNumber;
        }

        @if (isset($edit))
            var editModal = new bootstrap.Modal(document.getElementById('editAssessmentModal'));
            editModal.show();
        @endif

        @if ($errors->any() && !isset($edit))
            var addModal = new bootstrap.Modal(document.getElementById('addAssessmentModal'));
            addModal.show();
        @endif
    </script>
@endsection
