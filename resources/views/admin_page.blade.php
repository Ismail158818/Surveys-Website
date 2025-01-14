<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Page</title>
    <style>
        body {
            background-color: #c5c9f8;
            font-family: Arial, sans-serif;
            margin: 66px;
            padding-top: 40px;
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

        .nav-container {
            display: flex;

            flex-direction: row;
            align-items: center;
        }

        .nav-body-container {
            display: flex;
            justify-content: space-between;
            flex-direction: row;
            font-size: 1rem;
            font-weight: bold;
            color: #ffffff;
            text-decoration: none;
            position: fixed;
            top: 40px;
            left: 280px;
            transition: text-shadow 0.3s ease;
            align-items: center;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            height: 60px;
            width: 100%;
            background-color: #7b68ee;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
        }

        #company-name {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ffffff;
            background: linear-gradient(135deg, #e3e1e4, #e7c7b1, #ffffff);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: gradient-glow 2s infinite alternate;
            white-space: nowrap;
            margin-left: 30px;
            margin-right: 10px;
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

        .purple-text {
            color: #210074;
        }

        @keyframes gradient-glow {
            0% {
                text-shadow: 0px 0px 10px rgba(138, 43, 226, 0.5);
            }

            100% {
                text-shadow: 0px 0px 20px rgba(138, 43, 226, 0.8);
            }
        }



        .header-link:hover {
            text-shadow: 0px 0px 10px rgba(23, 5, 40, 0.8);
        }

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
            background-color: #cfccd9;
        }

        .developer-btn {
            position: relative;
        }

        .developer-btn:hover .developer-dropdown {
            display: block;
        }

        .logout-btn {
            display: flex;
            justify-content: end;
            position: absolute;
            top: 30px;
            right: 65px;
            background-color: #ff4d4d;
            color: white;
            border-radius: 5px;
            padding: 8px 15px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #ff1a1a;
        }


        .container-body {
            text-align: center;
            background-color: #c5c9f8;
            overflow-y: auto;
            transition: 0.3s ease-in-out;
        }


        .add-survey {
            background-color: #e6e8fa;
            width: 50%;
        }

        .view-survey {
            background-color: #e6e8fa;
            width: 50%;
        }

        button {
            padding: 10px;
            border: none;
            background-color: #6366f1;
            color: white;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.2s;
            margin-bottom: 20px;
        }

        button:hover {
            background-color: #4f46e5;
        }

        .btn-delete {
            margin-top: 20px;
            margin-right: 15px;
        }

        .survey-form {
            display: none;
            margin-top: 20px;
            transition: 0.3s;
        }

        .question {
            margin-bottom: 15px;
        }

        select,
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }


        .form-container {
            text-align: center;
            display: none;
        }

        .add-survey-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }


        .modal {
            background: #fff;
            border-radius: 8px;
            width: 90%;
            max-width: 800px;
            max-height: 90%;
            overflow-y: auto;
            padding: 20px;
            position: relative;

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
       
        .close {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }

        .modal-body {
            margin: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            text-align: left;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .list-group {
            padding: 0;
            list-style: none;
            margin: 0;
        }

        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            background-color: #f8f9fa;
            transition: background-color 0.3s;
        }

        .list-group-item:hover {
            background-color: #e9ecef;
        }

        .question-set {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f8f9fa;
        }
        { 
        font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9; } 
        header, footer { background-color: #7b68ee; color: white; padding: 15px; text-align: center; }
        main { padding: 20px; } 
        .highlight { font-weight: bold; color: rgb(169, 10, 242); } 
        .error { color: red; } .success { color: rgb(167, 10, 239);}
    </style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <header>
        <div class="nav-container">
            <nav>
                <h1 id="company-name">My Company</h1>
                <div class="nav-body-container">
                    <a href="/" class="header-link">🏠 Home</a>
                    <a href="admin-page" class="header-link">Site Manager</a>
                    <div class="developer-btn">
                        <a href="#" class="header-link">Developers</a>
                        <div class="developer-dropdown">
                            <a href="https://github.com/MohamedEngineered242" target="_blank">Mohamed Alaa Al-Den Namaa</a>
                            <a href="https://github.com/LaylaSN" target="_blank">Layla Sameh Nayyouf</a>
                            <a href="https://github.com/Ismail158818" target="_blank">Ismail Mahmoud Basbous</a>
                            <a href="https://github.com/simaaziz888" target="_blank">Sima Tayser Aziz</a>
                            <a href="https://github.com/ghalialnfoury" target="_blank">Ghali Alnfoury</a>
                            <a href="https://github.com/Ghya77h" target="_blank">Ghyath Kaysiea</a>
                        </div>
                    </div>
            </nav>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            <button type="submit" class="logout-btn">Log out</button>
        </form>
    </header>
    
    <div class="container-body">
        <h2 class="purple-text">Welcome To Admin page</h2>
        <p class="purple-text">You can create, view, and edit surveys here!</p>

        <div class="button-container">
            <button onclick="toggleForm('surveyForm')">Add Survey</button>
            <button onclick="toggleForm('viewForm')">View Surveys</button>
            <button onclick="toggleForm('comparisons')">Create Comparisons</button>
        </div>

        <div id="surveyForm" class="form-container">
            <h2 class="purple-text">Add Survey</h2>
            <div class="add-survey-buttons">
                <button onclick="openModal('questionsModal')">Add Questions and Answers</button>
                <button onclick="openModal('surveyTypeModal')">Add Survey Type</button>
            </div>
        </div>

        <div id="viewForm" class="form-container">
            <h2 class="purple-text">View Surveys</h2>
            <ul class="list-group">
                @foreach ($surveys as $survey)
                    <li class="list-group-item">
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

        <div id="comparisons" class="form-container">
            <h2 class="purple-text">Create Comparisons</h2>
            <form action="{{ route('analysis') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="surveySelection">Select Survey:</label>
                    <select id="surveySelection" name="survey_id" onchange="loadRespondents(this.value)" required>
                        <option value="">Select a survey</option>
                        @foreach ($surveys as $survey)
                            <option value="{{ $survey->id }}">{{ $survey->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="respondentsSelection">Select Respondents:</label>
                    <select id="respondentsSelection" name="respondents[]" multiple required>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Confirm Selection</button>
            </form>
        </div>

        <div id="questionsModal" class="modal-overlay">
            <div class="modal">
                <div class="modal-header">
                    <h5>Add Questions and Answers</h5>
                    <button class="close" onclick="closeModal('questionsModal')">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add.questions.answers') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="surveySelection">Select Survey:</label>
                            <select id="surveySelection" name="survey_id">
                                @foreach ($surveys as $survey)
                                    <option value="{{ $survey->id }}">{{ $survey->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="questions-container"></div>

                        <button type="button" class="btn" onclick="addQuestion()">Add Question</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="surveyTypeModal" class="modal-overlay">
            <div class="modal">
                <div class="modal-header">
                    <h5>Add Survey Type</h5>
                    <button class="close" onclick="closeModal('surveyTypeModal')">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add.survey') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="surveyTypeTitle">Survey Type Title:</label>
                            <input type="text" id="surveyTypeTitle" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="surveyTypeDescription">Description:</label>
                            <textarea id="surveyTypeDescription" name="description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Survey Type</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        @if(session('success'))
        <h1>Algorithm Analysis Results</h1>
    
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @if(session('bestFactoryTime'))
                <h2>Factory Analysis Results</h2>
                <h3>Best Factory Based on Time</h3>
                <p><strong>Factory:</strong> {{ session('bestFactoryTime') }}</p>
                <p>{{ session('reasonTime') }}</p>
                <h3>Best Factory Based on Cost</h3>
                <p><strong>Factory:</strong> {{ session('bestFactoryCost') }}</p>
                <p>{{ session('reasonCost') }}</p>
            @endif
    
            @if(session('bestRoute'))
                <h2>Travelling Salesman Problem Analysis Results</h2>
                <p><strong>Starting City:</strong> {{ session('bestRoute')[0] }}</p>
                <p><strong>Best Route:</strong> {{ implode(' → ', session('bestRoute', [])) }}</p>
                <p><strong>Total Distance:</strong> {{ session('bestDistance') }}</p>
            @endif
        @endif
    </div>
    <footer>
        <div class="container">
            <p class="mb-0">Contact us: +963936147908 | ismahel360@gmail.com</p>
        </div>
    </footer>
    <script>
        function toggleForm(formId) {
            const forms = document.querySelectorAll('.form-container');
            forms.forEach(form => {
                form.style.display = form.id === formId ? (form.style.display === 'block' ? 'none' : 'block') : 'none';
            });
        }
        let questionIndex = 0;
        function openModal(modalId) {
            const modalOverlay = document.getElementById(modalId);
            const modal = modalOverlay.querySelector('.modal'); 
            modalOverlay.style.display = 'flex'; 
            modal.style.display = 'block'; 
        }
        function closeModal(modalId) {
            const modalOverlay = document.getElementById(modalId);
            const modal = modalOverlay.querySelector('.modal');
            modalOverlay.style.display = 'none'; 
            modal.style.display = 'none'; 
        } 
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', function (e) {
                if (e.target === overlay) {
                    closeModal(overlay.id);  
                }
            });
        });
        function addQuestion() {
            const container = document.getElementById('questions-container');
            const questionSet = document.createElement('div');
            questionSet.className = 'question-set';

            questionSet.innerHTML = `
                <div class="form-group">
                    <label>Question ${questionIndex + 1}:</label>
                    <input type="text" name="questions[${questionIndex}][text]" required>
                </div>
                <div class="form-group">
                    <label>Type:</label>
                    <select onchange="handleQuestionTypeChange(${questionIndex}, this)" required>
                        <option value="text">Text</option>
                        <option value="multi">Multiple Choice</option>
                    </select>
                </div>
                <div id="answers-container-${questionIndex}" class="answer-set" style="display: none;">
                    <button type="button" class="btn-secondary" onclick="addAnswer(${questionIndex})">Add Another Answer</button>
                </div>
                <button type="button" class="btn btn-danger" onclick="removeQuestion(this)">Remove Question</button>
            `;
            container.appendChild(questionSet);
            questionIndex++;
        }
        function handleQuestionTypeChange(index, selectElement) {
            const answersContainer = document.getElementById(`answers-container-${index}`);
            if (selectElement.value === 'multi') {
                answersContainer.style.display = 'block';
                addAnswer(index); 
            } else {
                answersContainer.style.display = 'none';
                answersContainer.innerHTML = ''; 
            }
        }
        function addAnswer(questionIndex) {
            const answersContainer = document.getElementById(`answers-container-${questionIndex}`);
            const answerCount = answersContainer.querySelectorAll('.form-group').length;
            const answerSet = document.createElement('div');
            answerSet.className = 'form-group';
            answerSet.innerHTML = `
                <label>Answer ${answerCount + 1}:</label>
                <input type="text" name="questions[${questionIndex}][answers][${answerCount}]" required>
            `;
            answersContainer.appendChild(answerSet);
        }
        function removeQuestion(button) {
            button.parentElement.remove();
        }
        function loadRespondents(surveyId) {
            const respondentsDropdown = document.getElementById('respondentsSelection');
            respondentsDropdown.innerHTML = ''; 
            
            const responses = @json($responses);
            const filteredResponses = responses.filter(response => response.survey_id == surveyId);

            if (filteredResponses.length > 0) {
                filteredResponses.forEach(response => {
                    const option = document.createElement('option');
                    option.value = response.user_id;
                    option.text = response.user ? response.user.name : `User ID: ${response.user_id}`;
                    respondentsDropdown.appendChild(option);
                });
            } else {
                const noOption = document.createElement('option');
                noOption.text = 'No respondents available';
                respondentsDropdown.appendChild(noOption);
            }
        }
    </script>
</body>
