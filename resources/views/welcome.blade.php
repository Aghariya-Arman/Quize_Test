<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}

    <style>
        html {
            box-sizing: border-box;
        }

        html,
        body {
            position: relative;
            height: 105%;
        }

        body {
            /* background: #a8c0ff; */
            font-family: 'Comfortaa', cursive;
            /* color: #fff; */
            /* user-select: none; */
            margin: 0;
            padding: 0;
            counter-reset: points;
        }

        a {
            text-decoration: none;
            color: blue;
            border: 2px solid black;
            border-radius: 10px;
            background-color: white;
            padding: 15px;
        }

        section {
            /* background: #a8c0ff; */
            /* background: -webkit-linear-gradient(to right, #3f2b96, #a8c0ff);
            background: linear-gradient(to right, #3f2b96, #a8c0ff); */
            padding-top: 50px;
            overflow-y: hidden;
        }

        main {
            background: rgba(91, 89, 95, 0.12);
            border-radius: 10px;
            padding: 5px 20px 50px;
            width: 95%;
            max-width: 500px;
            margin: 0 auto 214px;
        }

        .text-container {
            text-align: center;
        }

        .quiz-options {
            margin: 60px 0;
        }

        [type=radio] {
            border: 0;
            height: 0.0625rem;
            width: 0.0625rem;
            position: absolute;
        }

        label {
            display: flex;
            align-items: center;
            border-radius: 5px;
            /* background: rgba(255, 5, 5, 0.72); */
            /* background: white; */
            margin-bottom: 15px;
            padding: 6px 0;
            position: relative;
            width: 100%;
            color: #000;
        }

        label .alphabet {
            border-radius: 5px;
            border: solid 1px #000;
            padding: .4rem .5rem .4rem;
            width: 2.3rem;
            margin: 0 1.3rem 0 .7rem;
            display: flex;
            justify-content: center;
            color: #000;
        }

        label .icon {
            height: auto;
            position: absolute;
            left: 92%;
            top: 12px;
        }

        /* input[type="radio"]:checked+label {
            border: 2px solid black;
            background-color: white;
            transform: scaleY(1.5);
            transition: 1.5s
        } */
    </style>
</head>

<body>

    <!-- QUIZ ONE -->
    <section class="section-1" id="section-1">
        <main>
            <div class="bg-light col-4 mb-5 py-2 border border-3 border-dark"
                style="margin-left: 125px;border-radius:20px">
                <h1 class="text-center timer " id="timer">00:00</h1>
            </div>
            <div class="text-container">
                <h2>Journal Knowledge Quiz</h2>
                <form action="" method="POST">
                    @csrf
                    @foreach ($questions as $que)
                        <p>QUESTION {{ $questions->currentPage() }} OF {{ $questions->total() }}</p>
                        <h4>{{ $questions->currentPage() }} &nbsp; <b>{{ $que->question }}</b></h4>
                        <input type="hidden" class="interval" value="{{ $que->time }}">
                        <input type="hidden" class="q_id" value="{{ $que->id }}" name="q_id">

                        <div class="quiz-options" data-question-id="{{ $que->id }}">

                            <div class="option" id="op">
                                <input type="radio" value="a" class="input-radio" id="one-a" name="answer"
                                    required>
                                <label class="radio-label" for="one-a">
                                    <span class="alphabet">A</span> {{ $que->option1 }}
                                </label>
                            </div>
                            <div class="option" id="op">
                                <input type="radio" value="b" class="input-radio" id="one-b" name="answer"
                                    required>
                                <label class="radio-label" for="one-b">
                                    <span class="alphabet">B</span> {{ $que->option2 }}
                                </label>
                            </div>
                            <div class="option" id="op">
                                <input type="radio" value="c" class="input-radio" id="one-c" name="answer"
                                    required>
                                <label class="radio-label" for="one-c">
                                    <span class="alphabet">C</span> {{ $que->option3 }}
                                </label>
                            </div>
                            <div class="option" id="op">
                                <input type="radio" value="d" class="input-radio" id="one-d" name="answer"
                                    required>
                                <label class="radio-label" for="one-d">
                                    <span class="alphabet">D</span> {{ $que->option4 }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                    @if ($questions->hasMorepages())
                        <a href="{{ $questions->nextPageUrl() }}" id="nextButton">Next</a>
                    @else
                        <a href="{{ route('finalans') }}" class="btn btn-primary">Submit</a>
                    @endif


                </form>

        </main>

    </section>
</body>
{{-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script> --}}
{{-- <script>
    var time = document.querySelector('.interval').value;
    // console.log(time);
    var x = setInterval(function() {
        // document.getElementById("timer").innerHTML = "00:" + (time < 10 ? "0" + time : time);
        // time--;
        document.getElementById("timer").innerHTML = "00:" + time;
        time = time - 1;
        if (time < 0) {
            clearInterval(x);
            // alert('Question Time Out');

            // Check if an answer is selected
            var selectedAnswer = $('input[name="answer"]:checked').val();
            if (selectedAnswer) {
                submitAnswer(selectedAnswer);
            }

            var url = " {{ $questions->hasMorepages() ? $questions->nextPageUrl() : route('finalans') }}";
            window.location.href = url;
        }
    }, 1000);

    function submitAnswer(selectedAnswer) {
        // var selectvalue = $(this).val();
        var questionId = $(this).closest('.quiz-options').data('question-id');
        // var selectvalue = $('input[name="answer"]:checked').val();
        // console.log(selectvalue);
        // console.log(questionId);

        var data = {
            questionid: questionId,
            answer: selectedAnswer,
        }
        $.ajax({
            type: "GET",
            url: "{{ route('checkans') }}",
            data: data,
            success: function(response) {
                // console.log(response);
                var selectedOption = $('input[name="answer"]:checked').closest(
                    '.option');
                if (response.correct) {
                    selectedOption.css('background-color', '#93ff33',
                        'border:2px solid black');
                } else {
                    selectedOption.css('background-color', '#ff4233 ');
                }
                $('input[name="answer"]').not(':checked').attr('disabled', true);
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
            }
        });
    }

    $(document).ready(function() {

        $('input[type="radio"]').click(function() {
            var selectedAnswer = $(this).val();
            submitAnswer(selectedAnswer);
        });


        $('#nextButton').click(function(event) {
            if (!$('input[name="answer"]:checked').val()) {
                event.preventDefault();
            }
        });

        // $('input[type="radio"]').click(function() {


        // });

    });
</script> --}}

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script>
    var time = document.querySelector('.interval').value;
    // console.log(time);
    var x = setInterval(function() {
        document.getElementById("timer").innerHTML = "00:" + time;
        time = time - 1;
        if (time < 0) {

            var id = document.querySelector('.q_id').value;
            var data = {
                qid: id,
            }
            // console.log(id);
            $.ajax({
                type: "GET",
                url: "{{ route('skipquestion') }}",
                data: data,
                success: function(response) {
                    // console.log(response);
                    if (response.status == 'success') {
                        alert('correct answer ->  ' + response.correct +
                            'clicked ok to next question');

                        setTimeout(function() {

                        }, 100);
                    }
                }
            });

            clearInterval(x);
            var url = " {{ $questions->hasMorepages() ? $questions->nextPageUrl() : route('finalans') }}";
            window.location.href = url;
        }
    }, 1000);

    $(document).ready(function() {
        $('#nextButton').click(function(event) {
            if (!$('input[name="answer"]:checked').val()) {
                event.preventDefault();
            }
        });

        $('input[type="radio"]').change(function() {

            var selectvalue = $(this).val();
            //var questionId = $(this).closest('.quiz-options').data('question-id');
            var questionId = $('input[name="q_id"]').val();
            //var selectvalue = $('input[name="answer"]:checked').val();
            // console.log(selectvalue);
            //console.log(questionId);

            var data = {
                questionid: questionId,
                answer: selectvalue,
            }
            $.ajax({
                type: "GET",
                url: "{{ route('checkans') }}",
                data: data,
                success: function(response) {
                    // console.log(response);
                    var selectedOption = $('input[name="answer"]:checked').closest(
                        '.option');
                    if (response.correct) {
                        selectedOption.css('background-color', '#93ff33',
                            'border:2px solid black');
                    } else {
                        selectedOption.css('background-color', '#ff4233 ');
                    }
                    $('input[name="answer"]').not(':checked').attr('disabled', true);
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + error);
                }
            });
        });

    });
</script>

</html>
