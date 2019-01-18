@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
 <!--    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-tachometer-alt"></i> My Listings
                    </strong>
                    <a href="{{ route('frontend.user.account.listing.create') }}" class="btn btn-primary float-right" title="Suggest Post">Suggest New</a>
                </div>

                <div class="card-body">
                



                   





                </div>
            </div>
        </div>
    </div> -->

    <addlisting-component></addlisting-component>
@endsection
