<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <li>
            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                {{ $properties['native'] }}
            </a>
        </li>
        @endforeach
        
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>

<div class="container">
  <h2>Horizontal form</h2>
  @if (Session::has('success'))
  <div class="alert alert-success" role="alert">
    {{Session::get('success')}}

  </div>
  <br>
      
  @endif
  <form method="POST" class="form-horizontal" action="{{route('offers.store')}}">
    @csrf
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">offer name:</label>
      <div class="col-sm-10">
        <input type="tex" class="form-control" id="email" placeholder="Enter name " name="name">
        @error('name')
        <small class="from-text text-danger">{{$message}}</small>
        @enderror
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">price:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control"   placeholder="Enter price" name="price">
        @error('price')
        <small class="from-text text-danger">{{$message}}</small>
        @enderror
      </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">offer photo:</label>
        <div class="col-sm-10">
          <input type="tex" class="form-control" id="email" placeholder="Enter photo " name="photo">
          @error('photo')
        <small class="from-text text-danger">{{$message}}</small>
        @enderror
        </div>
      </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox" name="remember"> Remember me</label>
        </div>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>

</body>
</html>
