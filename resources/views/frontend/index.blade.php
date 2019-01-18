@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
    <div class="row mb-4 d-flex align-middle">
        <div class="col border-right border-primary">
           Debate.org is a free online community where intelligent minds from around the world come to debate online and read the opinions of others. Research today’s most controversial debate topics and cast your vote on our opinion polls.
        </div><!--col-->
        <div class="col-2">
            <a href="{{ route('frontend.auth.register') }}" title="" class="btn btn-primary">Become a Member</a>
        </div>
    </div><!--row-->
    <hr>
    <div class="row mb-5">
        <h4 class="text-primary mb-1">Recent Posts</h4>
        <p class="mb-4"> Investigate today’s most controversial debate topics covering society’s biggest issues in politics, religion, education and more. Gain balanced, non-biased insight into each issue and review the breakdown of pro-con stances within our community. </p>
            @foreach($listings as $list)
            <div class="col-4 p-0">
              <div class="card listing" style="width: 18rem;">
                  <img class="card-img-top" src="{{ $list->featured_image }}" alt="Card image cap">
                  <div class="card-body">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1 list-title"><a href="{{ route('frontend.listing.show', $list->slug) }}">{{ $list->title }}</a></h5>
                          <small>${{ number_format($list->price, 2) }}</small>
                        </div>  
                        <small class="text-muted">{{ $list->location }}</small> 
                  </div>
                  
                </div>
            </div>
            @endforeach
        
    </div>
@endsection
