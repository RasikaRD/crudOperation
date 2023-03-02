<!DOCTYPE html>
<html lang="en">

<head>
    <title>Project 1 - CRUD</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.20.0/css/mdb.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="w-35">
    <div class="container w-25 mt-5">
        <div class="card shadow-sm">
            <div class="card-body w-25">
                <h2> TO DO LIST</h2>
                <form action="{{ route('store') }}" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="input-group inline-flex bg-gray-300 rounded-xl">
                        <input type="text" name="content" placeholder="Add a new To Do" class="form-control">
                        <button type="submit" class="btn btn-dark btn-sm px-4"><i class="fas fa-plus"></i></button>
                </form>
                @if (count($todolists))
                <ul class="list-group mt-4">

                
                    @foreach ($todolists as $todolist)
                    <li class="list-group-item">
                        <form action="{{ route('destroy' , $todolists->id) }}" method="POST">
                            {{$todolists->content}}
                            {{ csrf_field() }}
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm px-3"><i class="fas fa-trash"></i></button>
                        </form>
                    </li>
                    @endforeach
                </ul>

                <!-- <div class="card-body">

                    <form action="{{ rout('update')}}" method="post" autocomplete="off">
                        {!! csrf_field() !!}
                        @method("PATCH")
                        <input type="hidden" name="id" id="id" value="{{$todolists->id}}" id="id" />
                        <input type="submit" value="Update" class="btn btn-success"><i class="fas fa-pencil"></i></br>
                    </form>

                </div> -->


                @else
                <p class="text-center "> No task !</p>
                @endif

            </div>
            @if (count($todolists))
            <div class="mt-5 card-footer">
                You have {{count($todolists)}} tasks available
            </div>
            @endif
        </div>
    </div>


</body>

</html>