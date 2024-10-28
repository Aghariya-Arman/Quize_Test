@extends('panel.layout.app')


@section('content')
    <!-- Modal -->
    <div class="modal fade" id="editmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editmodalLabel">Update Question</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update') }}" method="POST">
                        @csrf
                        <input type="hidden" id="que_id" name="que_id">
                        <div class="mb-3">
                            <label for="yourName" class="form-label">Question Title </label>
                            <input type="text" name="question" id="quetitle" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="yourEmail" class="form-label">Option 1</label>
                            <input type="text" class="form-control" id="option1" name="option1">
                        </div>
                        <div class="mb-3">
                            <label for="yourEmail" class="form-label">Option 2</label>
                            <input type="text" class="form-control" id="option2" name="option2">
                        </div>
                        <div class="mb-3">
                            <label for="yourEmail" class="form-label">Option 3</label>
                            <input type="text" class="form-control" id="option3" name="option3">
                        </div>
                        <div class="mb-3">
                            <label for="yourEmail" class="form-label">Option 4</label>
                            <input type="text" class="form-control" id="option4" name="option4">
                        </div>
                        <div class="mb-3">
                            <label for="yourPassword" class="form-label">Select Category</label>
                            <select name="answer" id="answer" class="form-control">
                                <option value="">select Ans</option>
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                            </select>
                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="row d-flex">
        <div class="col">
            <h1>All Question</h1>
        </div>

        <div class="col">
            <a href="{{ route('addquestion') }}" class=" col-md-4 btn btn-primary float-end ">Add Question</a>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <table class="table">

                            @include('panel.message')
                            <thead>

                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Q-title</th>
                                    <th scope="col">Option1</th>
                                    <th scope="col">Option2</th>
                                    <th scope="col">Option3</th>
                                    <th scope="col">Option4</th>
                                    <th scope="col">Coreect Ans</th>
                                    <th scope="col">Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        <td>{{ $question->id }}</td>
                                        <td>{{ $question->question }}</td>
                                        <td>{{ $question->option1 }}</td>
                                        <td>{{ $question->option2 }}</td>
                                        <td>{{ $question->option3 }}</td>
                                        <td>{{ $question->option4 }}</td>
                                        <td>{{ $question->correctAnswer }}</td>

                                        <td><button class="btn editbtn btn-warning"
                                                value="{{ $question->id }}">Update</button>
                                            <a href="{{ route('delete', $question->id) }}"class="btn btn-danger">Delete</a>
                                        </td>
                                        {{-- <td><button
                                                class="btn btn-{{ $post->status ? 'success' : 'warning' }}">{{ $post->status ? 'approve' : 'pending' }}</button>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        $(document).on('click', '.editbtn', function() {
            var id = $(this).val();

            $('#editmodal').modal('show');

            $.ajax({
                type: "GET",
                url: "/edit-que/" + id,
                success: function(response) {
                    console.log(response.question);
                    $('#quetitle').val(response.question.question);
                    $('#option1').val(response.question.option1);
                    $('#option2').val(response.question.option2);
                    $('#option3').val(response.question.option3);
                    $('#option4').val(response.question.option4);
                    $('#que_id').val(response.question.id);


                    // category update code
                    $('#answer').find('option').removeAttr('selected');
                    // Find the option that matches the category_id and mark it as selected
                    $('#answer option').each(function() {
                        if ($(this).val() == response.question.correctAnswer) {
                            $(this).attr('selected', 'selected');
                        }
                    });
                }
            });
        });
    });
</script>
