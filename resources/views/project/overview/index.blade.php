@extends('layouts.dashboard')

@section('content')
    <div class="row">
        {{--NEW--}}
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <a class="project-container card mb-2 mt-2 p-3" href="{{route('project.create')}}">
                <div class="row h-100">
                    <div class="col-12 my-auto text-center">
                        <i class="fas fa-2x fa-plus icon-black"></i>
                    </div>
                </div>
            </a>
        </div>

        @foreach(Auth::user()->projects as $project)
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <a class="project-container card mb-2 mt-2 p-0"
                   href="{{route('project.show', $project->id)}}" style="background: url({{$project->getProjectImage()}}) no-repeat center center">
                    <div class="row mx-0 h-100">
                        <div class="col-12 my-auto text-center project-name-container">
                            <div class="project-name">{{$project->name}}</div>
                        </div>
                    </div>
                </a>
                </img>
            </div>
        @endforeach
    </div>

    <div class="row mb-2">
        <h1 class="project-headline col-12">Weitere Projekte</h1>
    </div>

    <div class="row">
        @foreach(Auth::user()->getRecommendedProjects() as $project)
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <a class="project-container card mb-2 mt-2 p-0"
                   href="{{route('project.show', $project->id)}}" style="background: url({{$project->getProjectImage()}}) no-repeat center center">
                    <div class="row mx-0 h-100">
                        <div class="col-12 my-auto text-center project-name-container">
                            <div class="project-name">{{$project->name}}</div>
                        </div>
                    </div>
                </a>
                </img>
            </div>
        @endforeach
    </div>
@endsection
