
@extends('backend.layouts.master')

@section('title')
   Create vehicle assign
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
            <h1>Create vehicle assign</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.assigns.index')}}" class="btn btn-success">Assign list</a></li>
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
              
                <form action="{{ route('admin.assigns.store') }}" method="POST" autocomplete="off">
                  @csrf
                  <table class="table table-bordered">
                    <tr>
                      <td width="15%">Registration no <span class="required">*</span></td>
                      <td width="35%">
                        <select class="form-control select2" name="vehicle_id">
                          <option value="">Select</option>
                          @foreach($vehicles as $data)
                          <option value="{{$data->id}}">{{$data->registration}}</option>
                          @endforeach
                        </select>
                      </td>
                      
                      <td width="15%">Division <span class="required">*</span></td>
                      <td width="35%">
                        <select class="form-control select2" name="division_id">
                          <option value="">Select</option>
                          @foreach($divisions as $data)
                          <option value="{{$data->id}}">{{$data->name}}</option>
                          @endforeach
                        </select>
                      </td>
                      
                    </tr>
                    <tr>
                      <td width="15%">Officer info</td>
                      <td width="35%"><input type="text" class="form-control" name="officer_info"/></td>
                      <td width="15%">Officer phone</td>
                      <td width="35%"><input type="text" class="form-control" name="officer_phone"/></td>
                    </tr>
                    <tr>
                      <td width="15%">Assign start date</td>
                      <td width="35%"><input type="date" class="form-control" name="assign_start_date"/></td>
                      <td width="15%">Memo & date</td>
                      <td width="35%"><input type="text" class="form-control" name="memo"/></td>
                    </tr>

                    <tr>
                      <td width="15%">Remarks</td>
                      <td width="35%"><input type="text" class="form-control" name="remarks"/></td>
                      <td width="15%">Status <span class="required">*</span></td>
                      <td width="35%">
                        <select class="form-control" name="status">
                          <option value="">Select</option>
                          <option value="Active">Active</option>
                          <option value="Inactive">Inactive</option>

                        </select>
                      </td>
                    </tr>
                    
                  </table>
     
                  <button type="submit" class="btn btn-primary mt-4 col-md-12 col-sm-12">Submit</button>
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
