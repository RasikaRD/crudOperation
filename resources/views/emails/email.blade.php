<h3>Hello {{ $user->name }},</h3>

<img src="{{public_path('images/todolist.jpg')}}" alt="todolist image" />

<p>Thank you for registering on our application. Stay tune for more updates!</p>

<ul>
    <li>Create a new account</li>
    <li>Create a new To do list</li>
    <li>Create a new sub To do list</li>
</ul>

<p>Best regards,</p>
<p>The {{ config('app.name') }} team</p>