<div class="panel panel-default">

  <div class="panel-heading">
    <h3 class="panel-title">
      {{ $timeline->user->name }} <small>{{$timeline->created_at}}</small>
    </h3>
  </div>

  <div class="panel-body">
    <p>
      {{ $timeline->content }}
    </p>
  </div>
  
</div>
