@extends('layouts.app', ['page' => __('Results'), 'pageSlug' => 'results'])

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Vote End</h4>
      </div>
      <div class="card-body">
      <h6 class="title">Thank you for voting</h6>
        <div class="alert alert-primary">
          <span> <b> NO 1 :</b> HAMIZAH </span>
        </div>
        <div class="alert alert-info">
          <span> <b> NO 2 :</b> HAMIZAH </span><br>
          <span> <b> NO 3 :</b> HAMIZAH </span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
