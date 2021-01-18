<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP Form Validation</title>
	<link rel="stylesheet" href="{{asset('style.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body>
	<div class="container mt-5">
        <div class="btn-group">
            <a href="{{route('teacher.create')}}" class="btn btn-primary rounded-0">Add new teacher</a>
            <a href="{{route('crud.index')}}" class="btn btn-dark rounded-0">Home</a>
        </div>
    <div class="card rounded-0 shadow">
      <div class="card-header">
        <h3>All teachers</h3>
      </div>
      <div class="card-body p-0">
          <div class="message">
              @include('validation')
          </div>
        <table class="table table-hover table-dark mb-0">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Cell</th>
              <th scope="col">Username</th>
              <th scope="col">Age</th>
            </tr>
          </thead>
          <tbody>

            @foreach($all_teacher as $teacher)
              <tr>
                <th scope="row">{{$loop -> index + 1}}</th>
                <td>{{$teacher -> name}}</td>
                <td>{{$teacher -> email}}</td>
                <td>{{$teacher -> cell}}</td>
                <td>{{$teacher -> username}}</td>
                <td>{{$teacher -> age}}</td>
                <td class="text-right">
                  <a href="{{route('teacher.show', $teacher -> id)}}" class="btn btn-info">View</a>
                  <a href="#" class="btn btn-warning">Edit</a>
                  <a href="{{route('teacher.delete', $teacher -> id)}}" class="btn btn-danger" id="delete-btn">Delete</a>
                </td>
              </tr>
            @endforeach



          </tbody>
        </table>
      </div>
    </div>
	</div>
	<script type="text/javascript" src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>
