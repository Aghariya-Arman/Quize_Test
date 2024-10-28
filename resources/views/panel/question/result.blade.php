<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Congratulations Page Design By WebJourney - Html Template </title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .congratulation-wrapper {
            max-width: 550px;
            margin-inline: auto;
            -webkit-box-shadow: 0 0 20px #f3f3f3;
            box-shadow: 0 0 20px #f3f3f3;
            padding: 30px 20px;
            background-color: #fff;
            border-radius: 10px;
        }

        .congratulation-contents.center-text .congratulation-contents-icon {
            margin-inline: auto;
        }

        .congratulation-contents-icon {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            height: 100px;
            width: 100px;
            background-color: #65c18c;
            color: #fff;
            font-size: 50px;
            border-radius: 50%;
            margin-bottom: 30px;
        }

        .congratulation-contents-title {
            font-size: 32px;
            line-height: 36px;
            margin: -6px 0 0;
        }

        .congratulation-contents-para {
            font-size: 16px;
            line-height: 24px;
            margin-top: 15px;
        }

        .btn-wrapper {
            display: block;
        }

        .cmn-btn.btn-bg-1 {
            background: #6176f6;
            color: #fff;
            border: 2px solid transparent;
            border-radius: 3px;
            text-decoration: none;
            padding: 5px;
        }

        .correct {
            background-color: #93ff33;

        }

        .incorrect {
            background-color: #ff6565;
        }

        .skipped {
            background-color: rgb(22, 53, 191);
            color: white;
        }
    </style>
</head>

<body>

    <div class="congratulation-area text-center mt-5">
        <div class="container">
            <div class="congratulation-wrapper">
                <div class="congratulation-contents center-text">
                    <div class="congratulation-contents-icon">
                        <i class="fas fa-check"></i>
                    </div>


                    @if ($correctAns == 0)
                        <h3 class="congratulation-contents-title"> better luck For next time.! </h3>
                    @elseif ($correctAns < 5)
                        <h3 class="congratulation-contents-title"> Make Practice...! </h3>
                    @else
                        <h3 class="congratulation-contents-title"> Congratulation...! </h3>
                    @endif
                    <h5>Your score is {{ $correctAns }}/{{ $allquestions->count() }}</h5>
                    <div class="btn-wrapper mt-4">
                        <a href="{{ route('homepage') }}" class="cmn-btn btn-bg-1">Play Again Quiz.... </a>
                    </div>
                    <div class="btn-wrapper mt-4">
                        <h4>All Instruction</h4>
                        <p><strong>Correct:-</strong> <i class="fa fa-check-circle text-success fs-4"
                                aria-hidden="true"></i>
                        </p>
                        <p><strong>Wrong:-</strong> <i class="fa-solid fa-circle-xmark text-danger fs-4"></i>
                        </p>
                        <p><strong>Skipped:-</strong> <i class="fa fa-check-circle text-primary fs-4"
                                aria-hidden="true"></i>
                        </p>

                    </div>

                    @php
                        Session::forget('correctAnswer');
                        Session::forget('answerall');
                        Session::forget('skipquestion');
                    @endphp
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-4 m-auto shadow">
            <h3 class="text-center mb-5">All Correct Answer</h3>

            @foreach ($allquestions as $all)
                @php

                    // if (isset($allanswer[$all->id])) {
                    //     $userAnswer = $allanswer[$all->id];
                    // } else {
                    //     $userAnswer = null;
                    // }

                    // if (isset($skipQuestion[$all->id])) {
                    //     $skipanswer = $skipQuestion[$all->id];
                    // } else {
                    //     $skipanswer = null;
                    // }

                    $userAnswer = $allanswer[$all->id] ?? null;
                    $skipanswer = $skipQuestion[$all->id] ?? null;

                @endphp

                <div class="question-block">
                    <h5><strong>{{ $all->question }}</strong></h5>
                    <p
                        class="@if ($all->correctAnswer == 'a' && $skipanswer) skipped 
                              @elseif ($all->correctAnswer == 'a') correct 
                              @elseif ($userAnswer == 'a' && $userAnswer != $all->correctAnswer) incorrect @endif">
                        A) {{ $all->option1 }}
                    </p>
                    <p
                        class="@if ($all->correctAnswer == 'b' && $skipanswer) skipped 
                              @elseif ($all->correctAnswer == 'b') correct 
                              @elseif ($userAnswer == 'b' && $userAnswer != $all->correctAnswer) incorrect @endif">
                        B) {{ $all->option2 }}
                    </p>
                    <p
                        class="@if ($all->correctAnswer == 'c' && $skipanswer) skipped 
                              @elseif ($all->correctAnswer == 'c') correct 
                              @elseif ($userAnswer == 'c' && $userAnswer != $all->correctAnswer) incorrect @endif">
                        C) {{ $all->option3 }}
                    </p>
                    <p
                        class="@if ($all->correctAnswer == 'd' && $skipanswer) skipped 
                              @elseif ($all->correctAnswer == 'd') correct 
                              @elseif ($userAnswer == 'd' && $userAnswer != $all->correctAnswer) incorrect @endif">
                        D) {{ $all->option4 }}
                    </p>
                </div>
            @endforeach



        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>



</html>
