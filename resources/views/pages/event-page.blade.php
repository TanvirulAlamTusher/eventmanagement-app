@extends('app')
@section('content')
 
 @include('mycomponent.events.create')
 @include('mycomponent.events.list')
 @include('mycomponent.events.delete')
 @include('mycomponent.events.update')
 @include('mycomponent.events.eventDetails')
    
@endsection