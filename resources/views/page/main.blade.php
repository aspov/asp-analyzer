@extends('layouts.app', ['request' => app()->request])
@section('content')
<div class="jumbotron">
  <p>Here you can analyze the domains</p>  
  <form class="form-inline" method="POST" action="{{ route('domains.store') }}" accept-charset="UTF-8">
    <input name="_token" type="hidden">            
    <div class="form-group mb-2">
      <label for="inputAddress" class="sr-only">address</label>
      <input type="text" class="form-control" id="inputAddress" name="name" placeholder="enter the address" value = "{{ $request->name ?? '' }}">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Аnalyze</button>
  </form>
  <div>
  @if ($error)       
      <span class="text-danger">{{ $error }}</span>      
  @endif  
</div>
@endsection