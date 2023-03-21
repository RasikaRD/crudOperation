<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to LinkIng</title>
    <style type="text/css">
       body {
            font-family:'Times New Roman', Times, serif;
            font-size: 14px;
            line-height: 1.5;
            margin: 5px
        }

        .container {
            max-width: 80%;
            padding: 5px;
            background-color: white;
            border: 1px solid black;
            border-radius: 5px;
            margin: 8px;
            padding: 5px;
        }

        h2,
        h3 {
            font-weight: 400;
            margin: 3px;
        }

        h2 {
            font-size: 26px;
            margin-bottom: 20px;
        }

        h3 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        p {
            font-size: 14px;
        }

        footer {
            font-size: 8px;
            margin-top: 40px
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3c6d77;
            color: #fff;
            border-radius: 5px;
            margin-bottom: 20px;
            align-content: center;
			text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Hello {{ $user->name }},</h2>
        <h3>Welcome to ToDo App</h3>
        <img src="{{public_path('images/todolist.jpg')}}" alt="todolist image" />

        <p>Thank you for joining <b>TODO APP!</b> We are thrilled to have you as part of our comminuty.
            We hope that you will find our platform easy to use, informactive and engaging. </p>
        <p>
            To get started, you can:
        </p>
        <ul>
            <li>Create a new account</li>
            <li>Create a new To do list</li>
            <li>Create a new sub To do list</li>
        </ul>

        <a href="{{ url('/') }}" class="btn">Visit Our Website</a>

        <p>Best regards,</p>
        <p>ToDo App Team</p>
        <hr />

        <div class="footer">
            <p>This email was sent to {{ $user->email }}</p>
            <p>&copy; {{ date('Y') }} The ToDo App team. All rights reserved.</p>
        </div>

    </div>
</body>

</html>
