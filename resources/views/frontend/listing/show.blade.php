@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
<div class="row mt-5 mb-4">
    <div class="col-8">        
        <div class="card mb-2">
            <div class="card-body">
                <img src="{{ $listing->featured_image }}" alt="{ $listing->title }}" class="img img-fluid">
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>Description</h4>
                {{ $listing->description }}
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex w-100 justify-content-between">
                  <h4 class="mb-1 list-title text-primary"><strong>₦{{ number_format($listing->price, 2) }}</strong></h4>
                  <span><i class="fa fa-share-alt fa-2x mx-1"></i><i class="far fa-heart fa-2x mx-1"></i></span>
                </div> 


    
                <p>
                    <h6>{{ $listing->title }}</h6>
                </p>
                
                <p>
                    <strong>Make</strong><br>
                    {{ $listing->make->name }}
                </p>
                <p>
                    <strong>Model</strong><br>
                    {{ $listing->model->name }}
                </p>
                <p>
                    <strong>Year</strong><br>
                    {{ $listing->year }}
                </p>
                <p>
                    <strong>Location</strong><br>
                    {{ $listing->location }}
                </p>
                <p>
                    <strong>Seller</strong><br>
                    {{ $listing->user->name }}
                </p>
                @auth
                @cannot('update', $listing)
                <p>
                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#contactSeller">Contact Seller</button>
                </p>
                @endcannot

                @else
                <div class="border-top">
                     <a href="{{route('frontend.auth.login')}}">Login</a> to contact seller
                 </div> 
                @endauth
            </div>
        </div>
    </div>
</div>
@auth
<!-- Modal -->
<div class="modal fade" id="contactSeller" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contact {{ $listing->user->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form method="post" action="{{ route('frontend.user.message.store') }}">
      <div class="modal-body">
       
            @csrf
          <div class="form-group">
            <input type="hidden" name="seller" value="{{ $listing->user->id }}">
            <input type="hidden" name="listing" value="{{ $listing->id }}">
            <input type="hidden" name="subject" value="Re: {{ $listing->title }}">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ Auth::user()->name }}" readonly="">
            </div>
           
            <div class="form-group">
                <textarea class="form-control" name="message" id="message" rows="5"></textarea>
            </div>
            
          </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send message</button>
      </div>
       </form>
    </div>
  </div>
</div>
@endauth
@endsection
