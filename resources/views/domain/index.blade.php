@extends('layouts.app')
@section('mainActive', '')
@section('domainsActive', 'active')
@section('content')
<div class="list-group"> 
  @foreach ($domains as $domain)
    <a href="{{ route('domains.show', ['id' => $domain->id]) }}" class="list-group-item list-group-item-action">{{ $domain->name }}</a>        
  @endforeach
</div> 

<div class="fixed-bottom" style="height: 700px">
  {{ $domains->links() }}
</div> 
@endsection