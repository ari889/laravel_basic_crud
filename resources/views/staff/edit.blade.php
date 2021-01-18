<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP Form Validation</title>
	<link rel="stylesheet" href="{{asset('style.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body>

	<div class="custom_signup">
        <div class="btn-group">
            <a href="{{route('staff.index')}}" class="btn btn-primary rounded-0">All staff</a>
            <a href="{{route('crud.index')}}" class="btn btn-dark rounded-0">Home</a>
        </div>
		<h2 class="mt-2">Add new staff.</h2>
		<div class="message">
            @include('validation')
		</div>
		<form method="POST" action="{{route('staff.update', $staff -> id)}}" enctype="multipart/form-data">
		  @csrf
{{--            @method('PUT')--}}
            @method('PATCH')
            <div class="form-group">
		    <label for="exampleInputName1">Name</label>
		    <input name="name" value="{{$staff -> name}}" type="text" class="form-control" id="exampleInputName1" aria-describedby="emailHelp">
            @if($errors -> has('name'))
                <p class="text-danger">{{$errors -> first('name')}}</p>
            @endif
		  </div>
		  <div class="form-group">
		    <label for="exampleInputEmail1">Email</label>
		    <input name="email" value="{{$staff -> email}}" type="text" class="form-control" id="exampleInputEmail1">
              @if($errors -> has('email'))
                  <p class="text-danger">{{$errors -> first('email')}}</p>
              @endif
		  </div>
		   <div class="form-group">
		    <label for="cell">Cell</label>
		    <input name="cell" value="{{$staff -> cell}}" type="text" class="form-control" id="cell">
               @if($errors -> has('cell'))
                   <p class="text-danger">{{$errors -> first('cell')}}</p>
               @endif
		  </div>
          <div class="form-group">
           <label for="username">Username</label>
           <input name="uname" value="{{$staff -> uname}}" type="text" class="form-control" id="username">
              @if($errors -> has('uname'))
                  <p class="text-danger">{{$errors -> first('uname')}}</p>
              @endif
         </div>
            <div class="form-group">
                <img src="{{URL::to('/')}}/media/staff/{{$staff -> photo}}" alt="" class="img-fluid">
                <label for="new_photo">Photo</label>
                <input name="old_photo" type="hidden" value="{{$staff -> photo}}" class="form-control" id="old_photo">
                <input name="new_photo" type="file" class="form-control" id="new_photo">
            </div>
            <div class="form-group">
                <label for="username">Age</label>
                <input name="age" value="{{$staff -> age}}" type="text" class="form-control" id="username">
                @if($errors -> has('age'))
                    <p class="text-danger">{{$errors -> first('age')}}</p>
                @endif
            </div>
            <input class="btn btn-primary rounded-0" value="Update" type="submit">
		</form>
	</div>
	<script type="text/javascript" src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>
