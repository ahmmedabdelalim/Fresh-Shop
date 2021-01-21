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
                
              </tr>
            </thead>
            <tbody>
              @foreach ($services as $service)
                <tr>
                  <td>{{$service->id}}</td>
                <td>{{$service->name}}</td>
                
                
                </tr>
                @endforeach
            
            </tbody>
          </table>
          <br>
          <br>
          <br>

          <form method="POST" class="form-horizontal" action="{{route('Save.Services')}}" enctype="multipart/form-data">
            @csrf
            
        
            <div class="form-group">
              <label class="control-label col-sm-2" for="Doctor">{{__('Doctor')}}</label>
              <div class="col-sm-10">
                <input type="tex" class="form-control" id="email" placeholder="choose doctor " name="name">
                <select class="form-control" name="doctor_id" multiple>
                  @foreach ($showdoctors as $showdoctor)
                  <option value="{{$showdoctor->id}}">{{$showdoctor->name }} </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">{{__('services')}}</label>
              <div class="col-sm-10">
                <input type="tex" class="form-control" id="email" placeholder="choose service " name="name">
                <select class="form-control"  name="service_id" multiple>
                  @foreach ($showservices as $showservice)
                  <option value="{{$showservice->id}}">{{$showservice->name }} </option>
                  @endforeach
                </select>
              </div>
            </div>
            
            <div class="form-group">        
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">{{__('messages.save')}}</button>
              </div>
            </div>
          </form>
    </div>
@endsection