@extends('layouts.app')
@section('content')
<div class="container mw-100 shadow-sm">
  <div class="row">    
    @foreach ($domains as $domain)
      <a href="{{ route('domains.show', ['id' => $domain]) }}" class="list-group-item list-group-item-action pl-4">{{ $domain->name }}</a>        
    @endforeach    
  </div>
</div>
<div>
  {{ $domains->links() }}
</div>
@endsection