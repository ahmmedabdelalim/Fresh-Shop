
@extends('layouts.app')

@section('content')
    

<div class="container">
  <h2>{{__('messages.offer form')}}</h2>
  @if (Session::has('success'))
  <div class="alert alert-success" role="alert">
    {{Session::get('success')}}

  </div>
  <br>
      
  @endif
  <form method="" class="form-horizontal" id="offerformupdate" action="" enctype="multipart/form-data">

    <input type="text" style="display: none;" class="form-control" value="{{$offer->id}}" id="email" placeholder="Enter name " name="offer_id">
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">{{__('messages.offer photo')}}</label>
      <div class="col-sm-10">
        <td> <img width="200" height="200" src="{{asset('images/offers/' .  $offer->photo)}}" alt="Product Image"></td>
        @error('photo')
        <small class="from-text text-danger">{{$message}}</small>
        @enderror
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">{{__('messages.offer photo')}}</label>
      <div class="col-sm-10">
        <input type="file" class="form-control"  value="{{$offer->photo}}"  placeholder="Enter name " name="photo">
        @error('photo')
        <small class="from-text text-danger">{{$message}}</small>
        @enderror
      </div>
    </div>
    

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">{{__('messages.offer name')}}</label>
      <div class="col-sm-10">
        <input type="tex" class="form-control" value="{{$offer->name}}" id="email" placeholder="Enter name " name="name">
        @error('name')
        <small class="from-text text-danger">{{$message}}</small>
        @enderror
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">{{__('messages.offer price')}}</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control"  value="{{$offer->price}}" placeholder="Enter price" name="price">
        @error('price')
        <small class="from-text text-danger">{{$message}}</small>
        @enderror
      </div>
    </div>
    <!--
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">{{__('messages.offer photo')}}</label>
        <div class="col-sm-10">
          <input type="tex" class="form-control" id="email" placeholder="Enter photo " name="photo">
          @error('photo')
        <small class="from-text text-danger">{{$message}}</small>
        @enderror
        </div>
      </div> 
    -->
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox" name="remember"> Remember me</label>
        </div>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="" id="updateoffer" class="btn btn-default">{{__('messages.save')}}</button>
      </div>
    </div>
  </form>
</div>
@endsection

@section('scripts')
<script type="text/javascript">

          $(document).on('click','#updateoffer',function (e) {
            e.preventDefault();
              //// csrf token for form it is importants
            $.ajaxSetup({
    headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
                });

            // for get all data from the form
            var formData = new FormData ($('#offerformupdate')[0]);

            $.ajax({
              type:'POST',
              enctype: 'multipart/form-data',
              url:"{{route('ajax.offers.update')}}",
              data:formData ,
              processData:false,
              contentType : false,
              cache:false,
              success: function (data) {
                if(data.status==true)
                alert(data.msg)
                
              },

            });
          });

</script>
    
@endsection
