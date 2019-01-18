@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-tachometer-alt"></i> Latest News
                    </strong>
                    <a href="{{ route('frontend.news.create') }}" class="btn btn-primary float-right" title="Suggest Post">Suggest News</a>
                </div><!--card-header-->

                <div class="card-body">
                @forelse($allnews as $news)
                   <div class="row">
                       <div class="col-4">
                           <img class="img img-thumbnail" src="{{ $news->image }}" alt="">
                       </div>
                       <div class="col-8">
                           <h2 class="modal-title"><a href="{{ route('frontend.news.show', $news->slug) }}">{{ $news->title }}</a></h2>
                           <p>{{ $news->excerpt() }}</p>
                           <div>
                              <i class="icon-user"></i> by <a href="{{ route('frontend.user.profile', $news->user->username) }}">{{ $news->user->name }}</a> 
                              | <i class="icon-calendar"></i> {{ $news->created_at->diffForHumans() }}
                              | <i class="icon-comment"></i> <a href="#">{{ $news->comments->count() }} comment{{ ($news->comments->count() > 1) ? 's' : '' }}</a>
                              | <i class="icon-tags"></i> Category : <a href="#"><span class="label label-info">{{ $news->category->name }}</span></a> 
                            
                            </div>
                       </div>
                   </div>
                @empty
                    <p>No data found.</p>
                @endforelse

                </div> <!-- card-body -->
            </div><!-- card -->
        </div><!-- row -->
    </div><!-- row -->
@endsection
