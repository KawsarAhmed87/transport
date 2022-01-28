
@extends('backend.layouts.master')

@section('title')
   Create user
@endsection

@push('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .form-check-label {
        text-transform: capitalize;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        background-color: #343a40;
    border-color: #005cbf;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
        background-color: #ced4da;;
        
    }
    element.style {
    width: 100% !important;
    } 
</style>
@endpush

@section('backend-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create user</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}" class="btn btn-success">User list</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
      
              <!-- /.card-header -->
              <div class="card-body">
              
                <form action="{{ route('admin.users.store') }}" method="POST" autocomplete="off">
                  @csrf
                  <div class="form-row">
                      <div class="form-group col-md-6 col-sm-12">
                          <label for="name">User Name</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                      </div>
                      <div class="form-group col-md-6 col-sm-12">
                          <label for="email">User Email</label>
                          <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                      </div>
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-6 col-sm-12">
                          <label for="password">Password</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                      </div>
                      <div class="form-group col-md-6 col-sm-12">
                          <label for="password_confirmation">Confirm Password</label>
                          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
                      </div>
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-6 col-sm-12">
                          <label for="password">Assign Roles</label>
                          <select name="roles[]" id="roles" class="form-control select2" multiple>
                              @foreach ($roles as $role)
                                  <option value="{{ $role->name }}">{{ $role->name }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  
                  <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save User</button>
              </form>
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
    <!-- /.content -->
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>

@endpush
