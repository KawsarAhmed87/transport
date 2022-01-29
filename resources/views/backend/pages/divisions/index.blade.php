<?php
use App\Http\Controllers\Backend\DivisionController;
?>

@php $admin = Auth::guard()->user(); @endphp
@extends('backend.layouts.master')

@section('title')
    Division list
@endsection

@push('style')
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush

@section('backend-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Division list</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            @if ($admin->can('division.create'))
          <li class="breadcrumb-item"><a href="{{route('admin.divisions.create')}}" class="btn btn-success">Division create</a></li>
          @else
          @endif
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
              
                <table id="example1"  class="table table-bordered table-striped">
                  <thead class="bg-light text-capitalize">
                      <tr>
                          <th width="10%">Sl</th>
                          <th width="60%">Name</th>
                          <th width="10%">Status</th>
                          <th width="20%">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                     @foreach ($divisions as $data)
                     <tr>
                          <td>{{ $loop->index+1 }}</td>
                          <td>{{ $data->name }}</td>
                          <td>
                            @if ($admin->can('division.edit'))

                            @if($data->status == 1)
                            <button type="button" onclick="statusItem({{ $data->id }})" class="btn btn-success text-white btn-sm">Active</button>
                            @else
                            <button type="button" onclick="statusItem({{ $data->id }})" class="btn btn-danger text-white btn-sm">Deactive</button>
                            @endif
                            <form id="status-form-{{ $data->id }}" action="{{ route('admin.divisions.status', $data->id) }}" method="POST" style="display: none;">
                              @csrf
                          </form>

                            @else

                            @if($data->status == 1)
                            <span  class="btn-success btn-sm">Active</span>
                            @else
                            <span  class="btn-danger btn-sm">Deactive</span>
                            @endif

                            @endif
                            

                          </td>
                        
                          <td>
                            @if ($admin->can('division.edit'))
                              <a class="btn btn-success text-white" href="{{ route('admin.divisions.edit', $data->id) }}">Edit</a>
                              @endif
                              @if ($admin->can('division.delete'))
                              <button type="button" class="btn btn-danger text-white" href=""
                              onclick="deleteItem({{ $data->id }})">
                                  Delete
                              </button>
                              <form id="delete-form-{{ $data->id }}" action="{{ route('admin.divisions.destroy', $data->id) }}" method="POST" style="display: none;">
                                  @method('DELETE')
                                  @csrf
                              </form>
                              @endif
                          </td>
                      </tr>
                     @endforeach
                  </tbody>
                  <tfoot>
                      <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
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
    <!-- /.content -->
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

   function deleteItem(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn btn-success',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } 
            })
        }

        function statusItem(id) {
            swal({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn btn-success',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('status-form-'+id).submit();
                } 
            })
        }
</script>
@endpush
