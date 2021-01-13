@extends('layouts.app')

@section('content')
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">{{__('messages.name')}}</th>
      <th scope="col">price</th>
      <th scope="col">photo</th>
      <th scope="col">Delete</th>
      <th scope="col">Ajax Delete</th>
      <th scope="col">Update</th>
    
    </tr>
  </thead>
  <tbody>
  
    @foreach ($offers as $offer)
    <tr class="OfferRow{{$offer->id}}">
      <th scope="row">{{$offer->id}}</th>
      <td>{{$offer->name}}</td>
      <td>{{$offer->price}}</td>
      <!-- for display photo -->
      <td> <img width="200" height="200" src="{{asset('images/offers/' .  $offer->photo)}}" alt="Product Image"></td>
      
      <td><a href="{{route('offers.delete',$offer -> id)}}" class="btn btn-success">Delete</a></td>
      <td><a href=""   offerid="{{$offer -> id}}"  class=" ajaxdelete btn btn-success"  >Ajax Delete</a></td>
      <td><a href="{{url('offers/edit/'.$offer -> id)}}" class="btn btn-success">Update</a></td>
      
    </tr>
    @endforeach
        
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function () {

$("body").on("click",".ajaxdelete",function(e){

  e.preventDefault();
  $.ajaxSetup({
    headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
                });
  var id = $(this).attr("offerid");

  

  $.ajax(
      {
        url:"{{ route('ajax.offers.delete')}}", //or you can use url: "company/"+id,
        type: 'POST',
        data: {
          
          'id': id,
      },
      success: function (data){
          $('.OfferRow'+data.id).remove();
          
      }
    });
    
  });
  

});

</script>
    
@endsection