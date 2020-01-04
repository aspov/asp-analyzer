@extends('layouts.app')
@section('content')
<div class="container mw-100 shadow-sm">
  <div class="row border-bottom">
    <div class="col-12 col-sm-2 pl-4 font-weight-bold">Name</div>
    <div class="col-12 col-sm-10 pl-4">{{ $domain->name }}</div>
  </div>
  <div class="row border-bottom">
    <div class="col-12 col-sm-2 pl-4 font-weight-bold">Status</div>
    <div class="col-12 col-sm-10 pl-4">{{ $domain->status_code }}</div>
  </div>
  @if ( $domain->content_length )
  <div class="row border-bottom">
    <div class="col-12 col-sm-2 pl-4 font-weight-bold">Content-length</div>
    <div class="col-12 col-sm-10 pl-4">{{ $domain->content_length }}</div>
  </div>  
  @endif
  @if ( $domain->keywords )
  <div class="row border-bottom">
    <div class="col-12 col-sm-2 pl-4 font-weight-bold">Keywords</div>
    <div class="col-12 col-sm-10 pl-4">{{ $domain->keywords }}</div>
  </div>  
  @endif
  @if ( $domain->description )
  <div class="row border-bottom">
    <div class="col-12 col-sm-2 pl-4 font-weight-bold">Description</div>
    <div class="col-12 col-sm-10 pl-4">{{ $domain->description }}</div>
  </div>  
  @endif
  @if ( $domain->heading )
  <div class="row border-bottom">
    <div class="col-12 col-sm-2 pl-4 font-weight-bold">Heading</div>
    <div class="col-12 col-sm-10 pl-4">{{ $domain->heading }}</div>
  </div>
  @endif
</div>
@endsection