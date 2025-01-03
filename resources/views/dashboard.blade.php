<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <style>
        body { background-color: #f5f5ff; }
        header { background-color: #7b68ee; position: relative; }
        footer { background-color: #7b68ee; color: white; }

        .welcome-message {
            font-size: 1.5rem;
            font-weight: bold;
            color: #7b68ee;
            text-align: center;
            margin-top: 20px;
        }

        .section-title {
            font-size: 1.25rem;
            color: #7b68ee;
            text-align: center;
            margin: 20px 0;
        }

        #company-name {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ffffff;
            background: linear-gradient(135deg, #8a2be2, #d2691e, #7b68ee);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: gradient-glow 2s infinite alternate;
            white-space: nowrap;
        }

        @keyframes gradient-glow {
            0% { text-shadow: 0px 0px 10px rgba(138, 43, 226, 0.5); }
            100% { text-shadow: 0px 0px 20px rgba(138, 43, 226, 0.8); }
        }

        .header-link {
            font-size: 1rem;
            font-weight: bold;
            color: #ffffff;
            text-decoration: none;
            padding: 0;
            transition: text-shadow 0.3s ease;
        }

        .header-link:hover {
            text-shadow: 0px 0px 10px rgba(138, 43, 226, 0.8);
        }

        .survey-card {
            background-color: #dce7f1;
            border: 1px solid #8a2be2;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .survey-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
        }

        .survey-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #7b68ee;
        }

        .survey-description {
            font-size: 1rem;
            color: #333;
            margin: 10px 0;
        }

        .start-btn {
            background-color: #7b68ee;
            color: #fff;
            width: 100%;
            border-radius: 8px;
            font-weight: bold;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .start-btn:hover {
            background-color: #8a2be2;
        }

        .survey-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 500px;
            background-color: #d5f5f2;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        /* Footer Styling */
        .footer-contact { font-weight: bold; color: white; }
        .footer-item { margin-bottom: 8px; }

        /* Developer Dropdown */
        .developer-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #ffffff;
            border: 1px solid #7b68ee;
            border-radius: 5px;
            min-width: 200px;
            z-index: 10;
        }

        .developer-dropdown a {
            color: #7b68ee;
            text-decoration: none;
            padding: 8px;
            display: block;
        }

        .developer-dropdown a:hover {
            background-color: #f1f1f1;
        }

        .developer-btn:hover .developer-dropdown {
            display: block;
        }

        .logout-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ff4d4d;
            color: white;
            border-radius: 5px;
            padding: 8px 15px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #ff1a1a;
        }
        header {
            position: fixed;
            top: 0;
            left: 0;
            height: 75px;
            width: 100%;
            margin: 0;
            background-color: #7b68ee;
            justify-content: space-between;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 10px 20px;

        }
        .header-link {
            display: flex;
            justify-content: space-between;
            flex-direction: row;
            font-size: 1rem;
            font-weight: bold;
            color: #ffffff;
            text-decoration: none;
            margin-left: 20px;
            margin-right: 30px;
            transition: text-shadow 0.3s ease;

        }
        .header-link:hover {
            text-shadow: 0px 0px 10px rgba(23, 5, 40, 0.8);
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            margin-bottom: 15px;
        }
        .modal-header h5 {
            margin: 0;
        }
        
    .survey-modal {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%; 
        max-width: 600px; 
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        z-index: 1050;
    }

    .survey-content {
        max-height: 70vh; 
        overflow-y: auto; 
        padding: 20px;
    }

    .close {
        font-size: 1.5rem;
        background: transparent;
        border: none;
        color: #dc3545;
    }


    </style>
</head>
<body>

    <header class="text-white fixed-top py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h1 id="company-name" class="h4 font-weight-bold mr-4">My Company</h1>
                <nav class="d-flex">
                    <a href="/" class="header-link mx-2">🏠 Home</a>
                    @if(auth()->user()->role_id==1)
                    <a href="admin-page" class="header-link mx-2">Site Manager</a>
                    @endif 
                    <!-- Developer Dropdown -->
                    <div class="developer-btn position-relative">
                        <a href="#" class="header-link mx-2">Developers</a>
                        <div class="developer-dropdown">
                            <a href="https://github.com/MohamedEngineered242" target="_blank">Mohamed Alaa Al-Den Namaa</a>
                            <a href="https://github.com/LaylaSN" target="_blank">Layla Sameh Nayyouf</a>
                            <a href="https://github.com/Ismail158818" target="_blank">Ismail Mahmoud Basbous</a>
                            <a href="https://github.com/simaaziz888" target="_blank">Sima Tayser Aziz</a>
                            <a href="https://github.com/ghalialnfoury" target="_blank">Ghali Alnfoury</a>
                            <a href="https://github.com/Ghya77h" target="_blank">Gias</a>
                        </div>
                    </div>
                </nav>
            </div>
    
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </header>
    
    <main class="container mt-5 pt-5">
        <div class="welcome-message">
            Welcome to our survey page. We value your feedback!<br><br>
        </div>
    
        <div class="row">
            @foreach($surveys as $survey)
                <div class="col-md-3 col-sm-6">
                    <div class="survey-card">
                        <div class="survey-title">
                            {{ $survey->title }}
                            @if(auth()->user()->role_id == 1)  
                                <div class="dropdown" style="display: inline;">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $survey->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $survey->id }}">
                                        <form action="/delete" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this survey?');">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $survey->id }}">
                                            <button type="submit" class="dropdown-item text-danger" title="Delete Survey">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="survey-description">{{ $survey->description }}</div>
        
                        @if(auth()->user()->role_id != 1)  
                            @if($survey->response_status == 0)
                                <button class="start-btn" onclick="openSurveyModal({{ $survey->id }})">Start Survey</button>
                            @else
                                <p class="text-success font-weight-bold">Thank you for completing this survey!</p>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
            <div id="survey-modal" class="survey-modal">
            <form action="" method="POST" id="survey-form">
                @csrf
                <div class="survey-content position-relative">
                    <button class="close text-danger font-weight-bold position-absolute" style="top: 10px; right: 10px; cursor: pointer;" id="close-btn">&times;</button>
                    <h2 id="survey-title"></h2>
                    <div id="survey-questions"></div>
                    <button type="submit" class="start-btn">Submit Survey</button>
                </div>
            </form>
        </div>
    </main>
    
    <footer class="text-center py-3 fixed-bottom">
        <div class="container">
            <p class="mb-0">Contact us: +963936147908 | ismahel360@gmail.com</p>
        </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
       function openSurveyModal(surveyId) {
    document.getElementById('survey-modal').style.display = 'block';
    let survey = @json($surveys->toArray()).find(s => s.id === surveyId);
    
    document.getElementById('survey-title').innerText = survey.title;
    
    let questionsHtml = '';
    survey.questions.forEach(question => {
        questionsHtml += `<p class="text-danger font-weight-bold">${question.question_text}</p>`;
        let hasNullAnswer = question.answers.some(answer => answer.answer_text === null || answer.answer_text === 'N/A');
        
        if (hasNullAnswer) {
            questionsHtml += `<div class="form-group">
                <label for="answer-text-${question.id}">Please provide your answer:</label>
                <input type="text" class="form-control" name="answers[${question.id}][answer]" id="answer-text-${question.id}" required>
                <input type="hidden" name="answers[${question.id}][answer_type]" value="1">
            </div>`;
        } else {
            question.answers.forEach(answer => {
                questionsHtml += `<div class="form-check">
                    <input type="radio" class="form-check-input" name="answers[${question.id}][answer]" value="${answer.id}" id="answer-${answer.id}">
                    <label class="form-check-label" for="answer-${answer.id}">${answer.answer_text}</label>
                    <input type="hidden" name="answers[${question.id}][answer_type]" value="0">
                </div>`;
            });
        }
    });
    document.getElementById('survey-questions').innerHTML = questionsHtml;

    document.getElementById('survey-form').action = `/submit-survey/${surveyId}`;
}

document.getElementById('survey-form').addEventListener('submit', function(e) {
    let isValid = true;
    let questions = document.querySelectorAll('.form-check');

    questions.forEach(question => {
        let questionId = question.querySelector('input[type="radio"]').name.split('[')[1].split(']')[0];  // Extract question ID
        let answers = document.querySelectorAll(`input[name="answers[${questionId}][answer]"]:checked`);

        if (answers.length === 0) {
            isValid = false;  
        }
    });

    if (!isValid) {
        alert('Please answer all questions');
        e.preventDefault(); 
    }
});

document.getElementById('close-btn').addEventListener('click', function() {
    document.getElementById('survey-modal').style.display = 'none';
});

    </script>
    
    
    </body>
    </html>
    