@extends('layouts.app', ['page' => __('Vote List'), 'pageSlug' => 'list'])
@section('content')

@php
@endphp

<div id="voting-list" class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="col-sm-6">                        
                        <h2 class="card-title">Vote List</h2>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr class="row">
                                    <th class="col-lg-1 col-md-1">
                                        Vote ID
                                    </th>
                                    <th class="col-lg-3 col-md-3">
                                        Vote Title
                                    </th>
                                    <th class="col-lg-3 col-md-3">
                                        Vote Date
                                    </th>
                                    <th class="col-lg-2 col-md-2">
                                        Status
                                    </th>
                                    <th class="col-lg-1 col-md-2">
                                        Nominees
                                    </th>                                                        
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($votes))
                                @foreach($votes as $vote)
                                <tr>
                                    <td>{{$vote->id}}</td>
                                    <td>{{$vote->title}}</td>
                                    <td>{{date('d F Y',strtotime($vote->date))}}</td>
                                    @if ($vote->is_active)
                                    <td><span class="badge badge-success">Active</span></td>
                                    @elseif (!$vote->is_active)
                                    <td><span class="badge badge-secondary">Not Active</span></td>
                                    @endif
                                    @php
                                        $count = 0;
                                        foreach ($vote->profiles as $profiles) {
                                            if (!empty($profiles->id)) {
                                                $count = $count + 1;
                                            }
                                        }
                                    @endphp
                                    <td>{{$count}}</td>                                    
                                    <td><a href="{{ route('votes.show', $vote->id ) }}"><span class="badge badge-outline-success">View</span></a></td>
                                </tr>
                                @endforeach
                                @endif                    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
