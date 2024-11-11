<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Site</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            background-color: #333;
            color: white;
            padding: 10px 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .dropdown-menu a:hover {
            background-color: #ddd;
        }

        .card-custom {
            cursor: pointer;
            position: relative;
        }

        .modal-header, .modal-body, .modal-footer {
            text-align: center;
        }

        .delete-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            color: red;
            cursor: pointer;
            font-size: 24px;
        }

        .nav-link.active {
            background-color: #575757;
            color: white !important;
        }
    </style>
</head>
<body>
    <div class="header text-center mb-4">
        <div class="d-flex justify-content-center align-items-center">
            <img src="https://image.shutterstock.com/image-vector/survey-icon-260nw-1235078167.jpg" alt="Survey Logo" height="40">
            <h1 class="ml-3">Survey Site</h1>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('surveys') ? 'active' : '' }}" href="/" onclick="setActive(this)">Surveys</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin-page') ? 'active' : '' }}" href="/admin-page" onclick="setActive(this)">Admin Page</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Names
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Ismail Mahmoud Basbous</a>
                            <a class="dropdown-item" href="#">Layla Sameh Nayouf</a>
                            <a class="dropdown-item" href="#">Mohamed Alaa Alden Naama</a>
                            <a class="dropdown-item" href="#">Sima Tayser Aziz</a>
                            <a class="dropdown-item" href="#">Gali Al Nafoury</a>
                            <a class="dropdown-item" href="#">Gias</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @foreach($surveys as $survey)
            <div class="card card-custom p-4" data-toggle="modal" data-target="#surveyModal_{{ $survey->id }}">
                <span class="delete-icon" onclick="confirmDelete(event)">&times;</span>
                <h3>{{ $survey->title }}</h3>
                <p>{{ $survey->description }}</p>
            </div>

            <div class="modal fade" id="surveyModal_{{ $survey->id }}" tabindex="-1" role="dialog" aria-labelledby="surveyModalLabel_{{ $survey->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="surveyModalLabel_{{ $survey->id }}">{{ $survey->title }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="surveyForm_{{ $survey->id }}" method="POST" action="{{ route('submitSurvey', ['surveyId' => $survey->id]) }}">
                                @csrf
                                @foreach($survey->questions as $question)
                                    <div class="form-group">
                                        <label for="question_{{ $question->id }}">{{ $question->question_text }}</label>
                                        <div>
                                            @foreach($question->answers as $answer)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="answer_{{ $answer->id }}" value="{{ $answer->id }}">
                                                    <label class="form-check-label" for="answer_{{ $answer->id }}">{{ $answer->answer_text }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        function confirmDelete(event) {
            if (confirm('Are you sure you want to delete this survey?')) {
                event.target.closest('.card').remove();
            }
        }

        function setActive(element) {
            var links = document.querySelectorAll('.nav-link');
            links.forEach(link => link.classList.remove('active'));
            element.classList.add('active');
        }
    </script>
</body>
</html>
