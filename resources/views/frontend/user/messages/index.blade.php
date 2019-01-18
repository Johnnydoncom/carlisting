@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('My Inbox') )

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-tachometer-alt"></i> Inbox
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    <div class="row">
                        <div class="col col-sm-4 order-1 order-sm-2  mb-4">
                            <div class="card mb-4 bg-light">
                                <img class="card-img-top" src="{{ $logged_in_user->picture }}" alt="Profile Picture">

                                <div class="card-body">
                                    <h4 class="card-title">
                                        {{ $logged_in_user->name }}<br/>

                                    </h4>
                                    <p class="card-text">
                                        <small>
                                            <i class="fas fa-envelope"></i> {{ $logged_in_user->email }}<br/>
                                            <i class="fas fa-calendar-check"></i> @lang('strings.frontend.general.joined') {{ timezone()->convertToLocal($logged_in_user->created_at, 'F jS, Y') }}
                                        </small>
                                    </p>

                                    <p class="card-text">

                                        <a href="{{ route('frontend.user.account')}}" class="btn btn-info btn-sm mb-1">
                                            <i class="fas fa-user-circle"></i> @lang('navs.frontend.user.account')
                                        </a>

                                        @can('view backend')
                                            &nbsp;<a href="{{ route('admin.dashboard')}}" class="btn btn-danger btn-sm mb-1">
                                                <i class="fas fa-user-secret"></i> @lang('navs.frontend.user.administration')
                                            </a>
                                        @endcan
                                    </p>
                                </div>
                            </div>
                        </div><!--col-md-4-->

                        <div class="col-md-8 order-2 order-sm-1">
                            <ul class="list-group">
                    
                                @forelse($messages as $message)
                                <li class="list-group-item">
                                    <!-- <div class="carlist mt-4"> -->
                                       <!--  <div class="card">
                                           
                                            <div class="card-body"> -->
                                                <div class="row">
                                                    <div class="col-2">
                                                        <img class="img-fluid" src="{{ $message->from->picture }}" alt="Card image cap">
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="d-flex w-100 justify-content-between">
                                                          <h5 class="mb-1"><a href="{{ route('frontend.user.message.show', encrypt($message->id)) }}">{{ $message->subject }}</a></h5>
                                                          <small>{{ $message->created_at->diffForHumans() }}<br>By: <a href="#">{{ $message->from->name }}</a></small>
                                                        </div>                                                        
                                                        <div class="description mb-1">
                                                            {!! strip_tags($message->excerpt()) !!}
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                           <!--  </div>
                                        </div> -->
                                        

                                    <!-- </div> -->
                                </li>
                                @empty
                                <div>
                                    No data
                                </div>
                                @endforelse
                            </ul>
        
                        </div><!--col-md-8-->
                    </div><!-- row -->
                </div> <!-- card-body -->
            </div><!-- card -->
        </div><!-- row -->
    </div><!-- row -->
@endsection
