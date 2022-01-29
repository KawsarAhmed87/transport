@extends('backend.layouts.master')

@section('title')
   Edit division name
@endsection

@push('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .form-check-label {
        text-transform: capitalize;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        background-color: #0062cc;
    border-color: #005cbf;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
        background-color: #ced4da;;
        
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
            <h1>Edit division name</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.divisions.index')}}" class="btn btn-success">Division list</a></li>
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
              
                <form action="{{ route('admin.divisions.update', $division->id) }}" method="POST" autocomplete="off">
                  @method('PUT')
                  @csrf
                  <div class="form-row">
                      <div class="form-group col-md-12 col-sm-12">
                          <label for="name">Division Name <span class="required"> *</span></label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter division Name" value="{{ $division->name }}">
                      </div>
                     
                  </div>
                  
                  <button type="submit" class="btn btn-primary mt-4 col-md-12 col-sm-12">Update</button>
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
