@extends('layouts.app', ['page' => __('Vote'), 'pageSlug' => 'vote'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="col-sm-6">
                    <h2 class="card-title">Vote</h2>
                    <table>
                        <tbody>
                            <tr>
                                <td><h5 class="card-title"><strong>Vote Title</strong></h5></td>
                                <td><h5 class="card-title">: {{$vote->title}}</h5></td>
                            </tr> 
                            <tr>
                                <td><h5 class="card-title"><strong>Vote Date</strong></h5></td>
                                <td><h5 class="card-title">: {{date('d F Y',strtotime($vote->date))}}</h5></td>
                            </tr> 
                        </tbody>
                    </table>
                </div>
            </div>
            <form method="post" action="{{ route('results.check', $vote->id) }}" autocomplete="off">
            <div class="card-body">
                <h6 class="title">Note: You can only vote once, so vote wisely. </h6>
                @include('alerts.warning')
                <div class="table-full-width table-responsive">
                    <table class="table">
                        <tbody>
                            @csrf
                            @foreach ($vote->profiles as $profile)
                            @if ($profile->id != auth()->user()->profile->id)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="" name="profile_id" type="radio" value="{{$profile->id}}" required>  
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">{{$profile->name}}</p>
                                        <p class="text-muted">{{$profile->job_role}}</p>
                                    </td>    
                                </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-fill btn-primary">{{ __('Submit Vote') }}</button>
            </div>
</form>
        </div>
        
    </div>

</div>
</div>
</div>
@endsection
