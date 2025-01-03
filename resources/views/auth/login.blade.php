<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        body, html {
            width: 100%;
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 0 10px;
            color: rgba(248, 4, 4, 0.745);
            position: relative;
            background: #1a1a1a;
        }

        body::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    background: url('/images/1.jpg') center/cover no-repeat;
    z-index: -1;
}


        .wrapper {
            width: 490px;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            border: 1px solid #ccc;
            backdrop-filter: blur(6px); 
        }

        form {
            display: flex;
            flex-direction: column;
        }

        h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: white;
            letter-spacing: 1px;
        }

        h2 span {
            color: #ff3366; 
            animation: color-change 1s infinite alternate;
        }

        @keyframes color-change {
            0% { color: #ff3366; }
            25% { color: #33ccff; }
            50% { color: #99cc33; }
            75% { color: #ffcc00; }
            100% { color: #ff3366; }
        }

        .input-field {
            position: relative;
            border-bottom: 2px solid #451919;
            margin: 15px 0;
        }

        .input-field label {
            position: absolute;
            color: rgb(0, 0, 0);
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            font-size: 16px;
            pointer-events: none;
            transition: 0.15s;
        }

        .input-field input {
            width: 100%;
            height: 40px;
            color: #000000;
            background: transparent;
            border: none;
            outline: none;
            font-size: 16px;
        }

        .input-field input:focus ~ label,
        .input-field input:not(:placeholder-shown) ~ label {
            font-size: 0.8rem;
            top: -10px;
            opacity: 0;
        }

        .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #160101;
            font-size: 18px;
        }

        .forget {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 25px 0 35px 0;
            color: rgb(250, 247, 247);
        }

        #remember {
            accent-color: #eba5f5;
        }

        .forget label {
            display: flex;
            align-items: center;
        }

        .forget label p {
            margin-left: 8px;
        }

        .wrapper a {
            color: #efefef;
            text-decoration: underline;
        }

        .button-container {
            display: flex;
            justify-content: center;
        }

        button {
            background-color: #a73095;
            color: rgb(200, 200, 200);
            font-weight: bold;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 18px;
            width: 38%; 
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #bd24d7;
        }

        .register {
            text-align: center;
            margin-top: 30px;
        }

        .register a {
            color:  #de98d7; 
        }

        .register a:hover {
            text-decoration: underline;
            color:  #de98d7;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h2><span>W</span><span>e</span><span>l</span><span>c</span><span>o</span><span>m</span><span>e</span></h2>
            <div class="input-field">
                <input type="email" id="email" name="email" placeholder=" " required autofocus>
                <label>Enter your email</label>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="input-field">
                <input type="password" id="password" name="password" placeholder=" " required>
                <label>Enter your password</label>
                <span class="eye-icon" onclick="togglePassword()">&#128065;</span> 
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="forget">
                <label for="remember">
                    <input type="checkbox" id="remember" name="remember">
                    <p>Remember me</p>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                @endif
            </div>
            <div class="button-container">
                <button type="submit">Log In</button>
            </div>
            <div class="register">
                <p>
                    Don't have an account?
                    <a href="{{ route('register') }}">Register</a>
                </p>
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.querySelector(".eye-icon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.innerHTML = "&#128064;";
            } else {
                passwordInput.type = "password";
                eyeIcon.innerHTML = "&#128065;";
            }
        }
    </script>
</body>
</html>
