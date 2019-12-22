@extends('layouts.app')
@section('content')
<table class="table"> 
  <tbody>  
    <tr>
      <th scope="row">Domain</th>
      <td>{{ $domain->name }}</td>
    </tr>
    <tr>
      <th scope="row">Status</th>
      <td>{{ $domain->status_code }}</td>
    </tr>
    <tr>
      <th scope="row">Body</th>
      <td>{{ $domain->body }}</td>
    </tr>
  </tbody>
</table>
@endsection