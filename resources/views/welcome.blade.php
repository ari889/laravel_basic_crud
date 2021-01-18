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
    <div class="card shadow rounded-0">
        <div class="card-header">
            <h3>Laravel crud</h3>
        </div>
        <div class="card-body">
            <div class="btn-group w-100">
                <a class="btn btn-primary rounded-0" href="{{route('teacher.index')}}">All teachers</a>
                <a class="btn btn-dark rounded-0" href="{{route('staff.index')}}">All staff</a>
                <a class="btn btn-warning rounded-0" href="{{route('student.index')}}">All students</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>

