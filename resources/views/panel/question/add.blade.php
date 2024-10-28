@extends('panel.layout.app')


@section('content')
    <div class="pagetitle">
        <h1 class="text-center">Add Question</h1>
    </div>
    <section class="section ">
        {{-- <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center"> --}}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8  col-md-8 d-flex flex-column align-items-center justify-content-center">
                    @include('panel.message')
                    <div class="card mb-3">
                        <div class="card-body py-5">
                            <form class="row g-3 needs-validation" novalidate action="{{ route('submitque') }}"
                                method="POST">
                                @csrf
                                {{-- <input type="hidden" value="{{ Auth::user()->id }}" name="user_id"> --}}
                                <div class="col-12">
                                    <label for="yourName" class="form-label">Question Title </label>
                                    <input type="text" name="question" class="form-control" value="" id="yourName"
                                        required>
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-12">
                                    <label for="yourEmail" class="form-label">Option 1</label>
                                    <input type="text" class="form-control" name="option1">
                                    <span class="text-danger">
                                        @error('option1')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-12">
                                    <label for="yourEmail" class="form-label">Option 2</label>
                                    <input type="text" class="form-control" name="option2">
                                    <span class="text-danger">
                                        @error('option2')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-12">
                                    <label for="yourEmail" class="form-label">Option 3</label>
                                    <input type="text" class="form-control" name="option3">
                                    <span class="text-danger">
                                        @error('option3')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-12">
                                    <label for="yourEmail" class="form-label">Option 4</label>
                                    <input type="text" class="form-control" name="option4">
                                    <span class="text-danger">
                                        @error('option4')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Select Category</label>
                                    <select name="answer" id="" class="form-control">
                                        <option value="">select Ans</option>
                                        <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>

                                    </select>
                                </div>
                                <div class="row py-3">
                                    <button class=" col-3 btn btn-primary m-auto" type="submit">Add Question</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
