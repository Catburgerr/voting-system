@extends('layouts.app', ['page' => __('Nominees'), 'pageSlug' => 'nominees'])

@section('content')
<div id="nominees">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-6">
                        <h2 class="card-title">Pick the Nominees</h2>
                        <h5 class="card-title"><strong> Vote Title: </strong> {{$vote->title}} </h5>
                        <h5 class="card-title"><strong> Vote Date: </strong> {{$vote->date}}</h5>
                        <h5 class="card-title"><strong> Vote Code: </strong> {{$vote->code}}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-12 col-md-12">
                    <form method="post" id="nominee" action="{{ route('nominee.store', $vote->id) }}" autocomplete="off">
                        @csrf
                        <div class="card-body ">
                            <div class="table-full-width table-responsive">
                                <table class="table">
                                    <tbody>
                                        @foreach ($profiles as $profile)
                                        @if ($profile->role !== "Admin")
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input pick-nominee" name="profile_id[]" type="checkbox" value="{{$profile->id}}">
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
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
                            <button type="submit" class="btn btn-fill btn-primary">{{ __('Appoint Nominees') }}</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

