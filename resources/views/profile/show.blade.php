@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2 text-center">
      <h1>{{ $user->name }}</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      @include('timeline.component.view_create_timeline_form')
    </div>
  </div>

  @foreach ($timelines as $timeline)
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        @include('timeline.component.view_show_timeline', ['timeline'=>$timeline])
      </div>
    </div>
  @endforeach

</div>
@endsection
