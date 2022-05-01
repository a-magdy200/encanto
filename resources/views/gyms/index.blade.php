@extends('layouts.app')
@section('content')
<section class="content">
<div class="text-center">
  <a href="/gyms/create" class="mt-4 btn btn-success">Create user</a>
</div>
  <div class="container-fluid">
    <div class="row">
     
     
      <div class="col-12">
        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>name</th>
                  <th>email</th>
                  <th>avatar</th>
                  <th>role_id</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($users as $user)
                <tr>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->avatar}}</td>
                  <td>
                    <span>
                      <a href="{{route('gyms.show',['user'=>$user['id']])}}"class="btn btn-info">View</a>
                      <form method="get" style="display: inline-block;" action="{{route('gyms.edit',['user'=>$user['id']])}}">
                        @csrf
                        <button class="btn btn-secondary">Edit</button>
                      </form>
                      <form method="POST" style="display: inline-block;" action="">
                        @method("DELETE")
                        @csrf
                        <button onclick="return confirm('are you sure?')" class="btn btn-danger">Delete</button>
                      </form>
                    </span>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>CRUD</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
@endsection