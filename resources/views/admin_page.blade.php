<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <!-- تضمين Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            display: none;
            margin-bottom: 20px;
        }
        .form-container h2 {
            margin-top: 20px;
        }
        .answer-set {
            margin-left: 20px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Admin Page</h1>
        
        <div class="text-center mb-4">
            <button class="btn btn-primary" onclick="toggleForm('surveyForm')">Add Survey</button>
            <button class="btn btn-danger" onclick="toggleForm('viewForm')">View Surveys</button>
        </div>

        <div id="surveyForm" class="form-container">
            <button type="button" class="btn btn-info mt-2" data-toggle="modal" data-target="#questionsModal">Add Questions and Answers</button>
            <button type="button" class="btn btn-secondary mt-2" data-toggle="modal" data-target="#surveyTypeModal">Add Survey Type</button>
        </div>

        <div id="questionsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="questionsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="questionsModalLabel">Add Questions and Answers</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('add.questions.answers') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="survey_id">Survey:</label>
                                <select id="survey_id" name="survey_id" class="form-control" required>
                                    @foreach ($surveys as $survey)
                                        <option value="{{ $survey->id }}">{{ $survey->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="questions-container">
                                <div class="question-set">
                                    <div class="form-group">
                                        <label for="questions[0][question_text]">Question 1:</label>
                                        <input type="text" name="questions[0][question_text]" class="form-control" required>
                                    </div>
                                    <div id="answers-container-0" class="answer-set">
                                        <div class="form-group">
                                            <label for="questions[0][answers][0][answer_text]">Answer 1:</label>
                                            <input type="text" name="questions[0][answers][0][answer_text]" class="form-control" required>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-2" onclick="addAnswer(0)">Add Another Answer</button>
                                    <button type="button" class="btn btn-warning mt-2" onclick="removeQuestion(this)">Remove Question</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary mt-3" onclick="addQuestion()">Add Another Question</button>
                            <button type="submit" class="btn btn-success mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="surveyTypeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="surveyTypeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="surveyTypeModalLabel">Add Survey Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('add.survey') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="survey_type_title">Title:</label>
                                <input type="text" id="survey_type_title" name="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="survey_type_description">Description:</label>
                                <textarea id="survey_type_description" name="description" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Survey Type</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="viewForm" class="form-container">
            <h2>View Surveys</h2>
            <ul class="list-group">
                @foreach ($surveys as $survey)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $survey->title }}
                        <form action="/delete" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $survey->id }}">
                            <input type="hidden" name="status" value="0">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        let questionIndex = 1;

        function toggleForm(formId) {
            const forms = document.querySelectorAll('.form-container');
            forms.forEach(form => {
                form.style.display = form.id === formId ? (form.style.display === 'block' ? 'none' : 'block') : 'none';
            });
        }

        function addQuestion() {
            const container = document.getElementById('questions-container');
            const questionSet = document.createElement('div');
            questionSet.className = 'question-set';
            questionSet.innerHTML = `
                <div class="form-group">
                    <label for="questions[${questionIndex}][question_text]">Question ${questionIndex + 1}:</label>
                    <input type="text" name="questions[${questionIndex}][question_text]" class="form-control" required>
                </div>
                <div id="answers-container-${questionIndex}" class="answer-set">
                    <div class="form-group">
                        <label for="questions[${questionIndex}][answers][0][answer_text]">Answer 1:</label>
                        <input type="text" name="questions[${questionIndex}][answers][0][answer_text]" class="form-control" required>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary mt-2" onclick="addAnswer(${questionIndex})">Add Another Answer</button>
                <button type="button" class="btn btn-warning mt-2" onclick="removeQuestion(this)">Remove Question</button>
            `;
            container.appendChild(questionSet);
            questionIndex++;
        }

        function addAnswer(questionIndex) {
            const container = document.getElementById(`answers-container-${questionIndex}`);
            const answerIndex = container.getElementsByClassName('form-group').length;
            const answerSet = document.createElement('div');
            answerSet.className = 'form-group';
            answerSet.innerHTML = `
                <label for="questions[${questionIndex}][answers][${answerIndex}][answer_text]">Answer ${answerIndex + 1}:</label>
                <input type="text" name="questions[${questionIndex}][answers][${answerIndex}][answer_text]" class="form-control" required>
            `;
            container.appendChild(answerSet);
        }

        function removeQuestion(button) {
            button.parentElement.remove();
            questionIndex--;
        }
    </script>
</body>
</html>
