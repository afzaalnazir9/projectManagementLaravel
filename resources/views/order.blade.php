
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
                <h4 class="">Add Data </h4>
                <form action="{{ route('store') }}" method="POST" autocomplete="off" class="submitdDataBtn">
                    <div class="form-group">
                        @csrf
                          <input type="text" name="Project" id="Add_Project" class="form-control mb-3" placeholder="Enter Project Name">
                          <input type="text" name="title" id="Add_todo" class="form-control" placeholder="Enter Task Name">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
                <div class="alert alert-danger d-none mt-3" role="alert">
                    Please Enter Value!
                </div>
            </div>

            <div class="projectsDropdown">
              <button type="button" class="mb-3 btn btn-primary dropdown-toggle projectsMainBtn" data-bs-toggle="dropdown" aria-expanded="false">
                Select Project
              </button>
              <ul class="dropdown-menu">
                  @foreach($Projects as $item)
                      <li>
                        <a class="dropdown-item projectItem" href="/Project/{{ $item->Project }}" data-projectName="{{ $item->Project }}">{{ $item->Project }}</a>
                      </li>
                  @endforeach
              </ul>
            </div>

            <table id="table" class="table table-bordered">
              <thead>
                <tr>
                  <th width="30px">#</th>  
                  <th>Project</th>
                  <th>Title</th>
                  <th>Created At</th>
                  <th>Update</th>
                  <th>Remove</th>
                </tr>
              </thead>
              <tbody id="tablecontents">
                <!-- get all data from Table by Controller -->
                @foreach($posts as $post)
    	            <tr class="row1" data-id="{{ $post->id }}">
    	              <td class="pl-3"><i class="fa fa-sort"></i></td>
                    <td>{{ $post->Project }}</td>
    	              <td>{{ $post->title }}</td>
    	              <td>{{ date('d-m-Y h:m:s',strtotime($post->created_at)) }}</td>
                      <td>
                        <a href="/updateTask/{{ $post->id }}">
                          <button type="button" class="btn btn-warning">Update task</button>
                        </a>
                      </td>
                      <td>
                        <form method="POST" action="{{ route('destroy', $post->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
    	            </tr>
                @endforeach
              </tbody>                  
            </table>
            <div class="delete_all_data">
                <form method="POST" action="/delete-all">
                    @csrf
                    <button type="submit" class="btn btn-danger mt-3">Delete All</button>
                </form>
            </div>
            <hr>
            <h5>Drag and Drop the table rows and <button class="btn btn-success btn-sm" onclick="window.location.reload()">REFRESH</button> </h5> 
    	</div>
    </div>
  
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
    <script>

    $('.submitdDataBtn').on('submit', function(e){
        e.preventDefault();
        var len = $('#Add_todo').val().length;
        if (len) {
            this.submit();
            $(".add_data_here .alert-danger").attr("style","");
        }
        else {
            $(".add_data_here .alert-danger").attr("style","display:block !important");
        }
    });

      $(function () {
        $("#table").DataTable();
        // this is need to Move Ordera according user wish Arrangement
        $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });

        function sendOrderToServer() {
          var order = [];
          var token = $('meta[name="csrf-token"]').attr('content');
          // by this function User can Update hisOrders or Move to top or under
          $('tr.row1').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });
          // the Ajax Post update
          $.ajax({
            type: "POST", 
            dataType: "json", 
            url: "{{ url('Custom-sortable') }}",
            data: {
              order: order,
              _token: token
            },
            success: function(response) {
                if (response.status == "success") {
                  console.log(response);
                } else {
                  console.log(response);
                }
            }
          });
        }

        $('.projectsDropdown .projectItem').click(function() {
          var projectName = $(this).attr('data-projectName');
          $(".projectsMainBtn").text(projectName);
          var token = $('meta[name="csrf-token"]').attr('content');
          // the Ajax Post update
          $.ajax({
            type: "POST", 
            dataType: "json", 
            url: "{{ url('selectProject') }}",
            data: {
              Project: projectName,
              _token: token
            },
            success: function(response) {
                if (response.status == "success") {
                  console.log(response);
                } else {
                  console.log(response);
                }
            }
          });
          console.log('projectName :>> ', projectName);
        });


      });
    </script>
</body>
</html>	