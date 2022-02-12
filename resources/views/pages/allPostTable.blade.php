@extends('layouts.index')
@section('contentSection1')
<div class="row">
<div class=" col-md-2 col-xs-2">
</div>
    <div class=" col-md-8 col-xs-12">

<h1>All Posts table</h1>
<hr>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">User</th>
      <th scope="col">Title</th>
      <th scope="col">Commnents</th>
      <th scope="col">Likes</th>
      <th scope="col">Dislikes</th>
      <th scope="col">Views</th>
    </tr>
  </thead>

  <tbody>
  @foreach($posts as $p)
    <tr>
      <td scope="row">{{$p->name}}</td>
      <td>{{$p->title}}</td>
      <td>{{$p->comments}}</td>
      <td>{{$p->ldv[0]->l}}</td>
      <td>{{$p->ldv[0]->d}}</td>
      <td>{{$p->ldv[0]->v}}</td>
    </tr>
   
    @endforeach
  </tbody>
</table>
</div>
</div>
@endsection