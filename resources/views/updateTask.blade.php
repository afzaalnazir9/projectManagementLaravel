
<!DOCTYPE html>
<html>
<head>
    <title>Sort and CRUD</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- this is for drop and drog in this arrange of wish order (need) -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/> 
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/style.css'); }}">
</head>
<body>
    <div class="mt-5">
        <div class="col-md-10 offset-md-1">
            <div class="add_data_here text-center card p-4 mb-5">
                <h4 class="">Update Task</h4>
                @foreach ($posts as $item)
                    <form method="POST" action="/updateData/{{ $item->id }}" autocomplete="off" class="submitdDataBtn">
                        <div class="form-group">
                            @csrf
                            @method('POST')
                            <input type="text" name="Project_update" id="Add_Project" class="form-control mb-3" placeholder="Enter Project Name" value="{{ $item->Project }}">
                            <input type="text" name="title_update" id="Add_todo" class="form-control  mb-3" placeholder="Enter Task Name" value="{{ $item->title }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                @endforeach
                <div class="alert alert-danger d-none mt-3" role="alert">
                    Please Enter Value!
                </div>
            </div>

            <hr>
            <a href="/"><button class="btn btn-success btn-sm">Back</button></a> 
    	</div>
    </div>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>	