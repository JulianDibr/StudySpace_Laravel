@extends('layouts.dashboard')

@section('content')
    <div class="row">
        {{--NEW--}}
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <a class="group-container card mb-2 mt-2 p-3" href="{{route('group.create')}}">
                <div class="row h-100">
                    <div class="col-12 my-auto text-center">
                        <i class="fas fa-2x fa-plus icon-black"></i>
                    </div>
                </div>
            </a>
        </div>

        @foreach(Auth::user()->groups as $group)
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <a class="group-container card mb-2 mt-2 p-0"
                   href="{{route('group.show', $group->id)}}" style="background: url({{$group->getGroupImage()}}) no-repeat center center">
                    <div class="row mx-0 h-100">
                        <div class="col-12 my-auto text-center group-name-container">
                            <div class="group-name">{{$group->name}}</div>
                        </div>
                    </div>
                </a>
                </img>
            </div>
        @endforeach
    </div>

    <div class="row mb-2">
        <h1 class="group-headline col-12">Weitere Gruppen</h1>
    </div>

    <div class="row">
        @foreach(Auth::user()->getRecommendedGroups() as $group)
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <a class="group-container card mb-2 mt-2 p-0"
                   href="{{route('group.show', $group->id)}}" style="background: url({{$group->getGroupImage()}}) no-repeat center center">
                    <div class="row mx-0 h-100">
                        <div class="col-12 my-auto text-center group-name-container">
                            <div class="group-name">{{$group->name}}</div>
                        </div>
                    </div>
                </a>
                </img>
            </div>
        @endforeach
    </div>
@endsection
