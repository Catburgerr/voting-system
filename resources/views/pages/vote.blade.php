@extends('layouts.app', ['page' => __('Start Vote'), 'pageSlug' => 'vote'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-6">
                    <h2 class="card-title">Start Vote</h2>
                    </div>
                </div>
                <div class="card-body">
                    
                    <div class="col-lg-12 col-md-12">
                        <form method="get" action="{{ route('votes.check') }}" autocomplete="off">
                            <div class="card-body">
                                @csrf
                                @include('alerts.warning')
                                <h6 class="title">Please enter the vote code to continue </h6><br>
                                <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                                    <label>{{ __('Vote Code') }}</label>
                                    <input type="text" name="code" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="{{ __('Vote Code') }}" required>
                                    @include('alerts.feedback', ['field' => 'code'])
                                </div>                                                                                           
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-fill btn-primary">{{ __('Start Vote') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
