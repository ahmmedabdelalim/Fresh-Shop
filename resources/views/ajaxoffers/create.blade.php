
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
  <form method="" class="form-horizontal" action="" enctype="multipart/form-data">
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">{{__('messages.offer photo')}}</label>
      <div class="col-sm-10">
        <input type="file" class="form-control" id="email" placeholder="Enter name " name="photo">
        @error('photo')
        <small class="from-text text-danger">{{$message}}</small>
        @enderror
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">{{__('messages.offer name')}}</label>
      <div class="col-sm-10">
        <input type="tex" class="form-control" id="email" placeholder="Enter name " name="name">
        @error('name')
        <small class="from-text text-danger">{{$message}}</small>
        @enderror
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">{{__('messages.offer price')}}</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control"   placeholder="Enter price" name="price">
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
        <button type="" id="saveoffer" class="btn btn-default">{{__('messages.save')}}</button>
      </div>
    </div>
  </form>
</div>
@endsection

@section('scripts')
<script type="text/javascript">


          $(document).on('click','#saveoffer',function (e) {
            e.preventDefault();
            var name = $("input[name=name]").val();
            var price = $("input[name=price]").val();
            
            

            $.ajax({
              type:'POST',
              url:"{{route('ajax.offers.store')}}",
              data:{
                _token: '{!! csrf_token() !!}',
                name:name ,
                price:price,
                
                
              },
              

            });
          });

</script>
    
@endsection
