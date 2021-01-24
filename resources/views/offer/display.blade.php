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
  
  
@if (Session::has('errore'))
<div class="alert alert-success" role="alert">
  {{Session::get('errore')}}
  
</div>
<br>
@endif
@if (Session::has('success'))
  <div class="alert alert-success" role="alert">
    {{Session::get('success')}}
  </div>
  <br>
  @endif
  
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">{{__('messages.name')}}</th>
        <th scope="col">price</th>
        <th scope="col">photo</th>
        <th scope="col">Delete</th>
        <th scope="col">Update</th>

      </tr>
    </thead>
    <tbody>

      @foreach ($offers as $offer)
      <tr>
        <th scope="row">{{$offer->id}}</th>
        <td>{{$offer->name}}</td>
        <td>{{$offer->price}}</td>
        <!-- for display photo -->
        <td> <img width="200" height="200" src="{{asset('images/offers/' .  $offer->photo)}}" alt="Product Image"></td>
        <td><a href="{{url('offers/edit/'.$offer -> id)}}" class="btn btn-success">Update</a></td>
        <td><a href="{{route('offers.delete',$offer -> id)}}" class="btn btn-success">Delete</a></td>
      </tr>
      @endforeach
      
    </tbody>
  </table>
  {{ $offers->links() }}
  
</body>
</html>
