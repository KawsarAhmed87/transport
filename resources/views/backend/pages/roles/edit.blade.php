@extends('backend.layouts.master')

@section('title')
   Create role
@endsection

@push('style')
<style>
  .form-check-label {
      text-transform: capitalize;
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
            <h1>Role edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.roles.index')}}" class="btn btn-success">Roles list</a></li>
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
              
                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                  @method('PUT')
                  @csrf
                  <div class="form-group">
                      <label for="name">Role Name</label>
                      <input type="text" class="form-control" id="name" value="{{ $role->name }}" name="name" placeholder="Enter a Role Name">
                  </div>

                  <div class="form-group">
                      <label for="name">Permissions</label>

                      <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1" {{ App\User::roleHasPermissions($role, $all_permissions) ? 'checked' : '' }}>
                          <label class="form-check-label" for="checkPermissionAll">All</label>
                      </div>
                      <hr>
                      @php $i = 1; @endphp
                      @foreach ($permission_groups as $group)
                          <div class="row">
                              @php
                                  $permissions = App\User::getpermissionsByGroupName($group->name);
                                  $j = 1;
                              @endphp
                              
                              <div class="col-3">
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" {{ App\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}> All
                                      <label class="form-check-label" for="checkPermission">{{ $group->name }}</label>
                                  </div>
                              </div>

                              <div class="col-9 role-{{ $i }}-management-checkbox">
                                 
                                  @foreach ($permissions as $permission)
                                      <div class="form-check">
                                          <input type="checkbox" class="form-check-input" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})" name="permissions[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                          <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                      </div>
                                      @php  $j++; @endphp
                                  @endforeach
                                  <br>
                              </div>

                          </div>
                          @php  $i++; @endphp
                      @endforeach
                  </div>
                  <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Role</button>
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
@include('backend.pages.roles.partials.scripts')

@endpush
