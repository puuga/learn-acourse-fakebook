<div class="panel panel-default">
  <div class="panel-body">
    <form class="" action="{{ route('timeline_store') }}" method="post">
      {{ csrf_field() }}
      <div class="form-group">
        <textarea class="form-control" name="content" rows="3"></textarea>
      </div>

      <div class="form-group text-right">
        <button type="submit" class="btn btn-default">Post</button>
      </div>
    </form>
  </div>
</div>
