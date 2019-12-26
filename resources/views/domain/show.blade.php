@extends('layouts.app')
@section('content')
<table class="table"> 
  <tbody>  
    <tr>
      <th scope="row" style="width: 200px">Name</th>
      <td>{{ $domain->name }}</td>
    </tr>
    <tr>
      <th scope="row">Status</th>
      <td>{{ $domain->status_code }}</td>
    </tr>
    @if ( $domain->content_length )
    <tr>
      <th scope="row">Content-length</th>
      <td>{{ $domain->content_length }}</td>
    </tr>
    @endif
    @if ( $domain->keywords )
    <tr>
      <th scope="row">Keywords</th>
      <td>{{ $domain->keywords }}</td>
    </tr>
    @endif
    @if ( $domain->description )
    <tr>
      <th scope="row">Description</th>
      <td>{{ $domain->description }}</td>
    </tr>
    @endif
  </tbody>
</table>
@endsection