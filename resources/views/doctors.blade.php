@extends('layouts.app')
@section('content')
<br>
<br>
<br>
<br>
    <div class = "container">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Title</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($doctors as $doctor)
                <tr>
                  <td>{{$doctor->id}}</td>
                <td>{{$doctor->name}}</td>
                <td>{{$doctor->title}}</td> 
                <td><a href="{{route('Doctors.Services', $doctor->id)}}" class="btn btn-success">Show Service</a></td>
                </tr>
                @endforeach
            
            </tbody>
          </table>
    </div>
@endsection