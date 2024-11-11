<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body, html {
            width: 100%;
            height: 100%;
            background: url('/images/1.jpg') center/cover no-repeat;
            background-size: cover;
            background-position: center;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 0 9px;
            background-color: rgba(46, 46, 46, 0.7); 
            color: rgb(255, 255, 255);
        }

        .wrapper {
            width: 480px;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            border: 2px solid #74b9d0;
            backdrop-filter: blur(5px); 
        }

        h2 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            text-align: center;
            letter-spacing: 2px;
            color: rgb(224, 80, 80);
        }

        h2 span {
            display: inline-block;
            animation: colorChange 1s infinite alternate;
        }

        @keyframes colorChange {
            0% { color: #ff3366; }
            50% { color: #00bfff; }
            100% { color: #ff9900; }
        }

        .input-field {
            position: relative;
            margin-bottom: 20px;
        }

        .input-field label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #3a0b0b;
            font-size: 16px;
            transition: 0.3s ease;
        }

        .input-field input {
            width: 100%;
            padding: 12px 15px;
            background: transparent;
            border: 2px solid #060000;
            color: #fff;
            font-size: 16px;
            border-radius: 5px;
            outline: none;
            transition: border 0.3s ease, box-shadow 0.3s ease;
        }

        .input-field input:focus ~ label,
        .input-field input:valid ~ label {
            font-size: 17px;
            top: -8px;
            color: #b11b9d;
        }

        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
        }

        .button-container button {
            background-color: #a73095;
            color: rgb(200, 200, 200);
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .button-container button:hover {
            background-color: #bd24d7;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color:  #de98d7;
            text-decoration: none;
            font-size: 20px;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
        
    </style>
</head>
<body>
    <div class="wrapper">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h2><span>C</span><span>r</span><span>e</span><span>a</span><span>t</span>e an <span>A</span><span>c</span><span>c</span><span>o</span><span>u</span><span>n</span><span>t</span></h2>

            <div class="input-field">
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                <label>Enter your email</label>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="input-field">
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                <label>Enter your username</label>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="input-field">
                <input type="password" id="password" name="password" required>
                <label>Enter your password</label>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="input-field">
                <input type="password" id="password_confirmation" name="password_confirmation" required>
                <label>Confirm your password</label>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="button-container">
                <button type="submit"><span>Create</span> Account</button>
            </div>

            <div class="login-link">
                <p>Already have an account? <a href="{{ route('login') }}">Log In</a></p>
            </div>
        </form>
    </div>
</body>
</html>
