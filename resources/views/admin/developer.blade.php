@extends('layouts.admin')
@section('content')
  <div class="content-header">
    <div class="container-fluid">

          <div class="card">
            <div class="card-header">
          <h1 class="m-0 text-dark">DEVELOPER STUFF</h1>
            </div>

          </div>
    </div><!-- /.container-fluid -->
  </div>
  <div class="content-header">
    <div class="container-fluid">

          <div class="card">
            <div class="card-body">
              <passport-clients></passport-clients>
              <passport-authorized-clients></passport-authorized-clients>
              <passport-personal-access-tokens></passport-personal-access-tokens>
            </div>
          </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
@endsection
