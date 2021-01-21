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
                <th scope="col">Address</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($hospitals as $hospital)
                <tr>
                  <td>{{$hospital->id}}</td>
                <td>{{$hospital->name}}</td>
                <td>{{$hospital->address}}</td>
                <td><a href="{{route('Hospital.Doctors', $hospital->id)}}" class="btn btn-success">show Doctors</a></td>
                <td></td>
                </tr>
                @endforeach
            
            </tbody>
          </table>
    </div>
@endsection