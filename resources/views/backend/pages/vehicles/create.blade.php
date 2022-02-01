
@extends('backend.layouts.master')

@section('title')
   Create vehicle
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
            <h1>Create vehicle registration</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.vehicles.index')}}" class="btn btn-success">Vehicle list</a></li>
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

                <form action="{{ route('admin.vehicles.store') }}" method="POST" autocomplete="off">
                  @csrf
                
                  <table class="table table-bordered">
                      <tr>
                        <td width="15%">Registration no</td>
                        <td width="35%"><input type="text" class="form-control" name="registration" placeholder="Dhaka Metro-" value="Dhaka Metro-"></td>

                        <td width="15%">Purchase type</td>
                        <td width="35%">
                          <select class="form-control" name="purchase_type">
                            <option value="">Select</option>
                            <option value="Revenue">Revenue</option>
                            <option value="Project">Project</option>
                            <option value="Rent">Rent</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td width="15%">Vehicle type</td>
                        <td width="35%">
                          <select class="form-control select2" name="vehi_type_id">
                            <option value="">Select</option>
                           @foreach($vehicle_types as $data)
                           <option value="{{$data->id}}">{{$data->name}}</option>
                           @endforeach
                          </select>
                        </td>

                        <td width="15%">Vehicle brand </td>
                        <td width="35%">
                          <select class="form-control select2" name="brand_id">
                            <option value="">Select</option>
                           @foreach($brands as $data)
                           <option value="{{$data->id}}">{{$data->name}}</option>
                           @endforeach
                          </select>
                        </td>
                      </tr>

                      <tr>
                        <td width="15%">Vehicle category</td>
                        <td width="35%">
                          <select class="form-control select2" name="colour_id">
                            <option value="">Select</option>
                           @foreach($colours as $data)
                           <option value="{{$data->id}}">{{$data->name}}</option>
                           @endforeach
                          </select>
                        </td>
                        <td width="15%">No of Seat </td>
                        <td width="35%"><input type="text" class="form-control" name="seat"></td>
                      </tr>

                      <tr>
                        <td width="15%">Engine type</td>
                        <td width="35%">
                          <select class="form-control select2" name="engine_type">
                            <option value="">Select</option>
                            <option value="Petrol Engine">Petrol Engine</option>
                            <option value="Diesel Engine">Diesel Engine</option>
                          </select>
                        </td>
                        <td width="15%">Vehicle CC </td>
                        <td width="35%"><input type="text" class="form-control" name="vehicle_cc"></td>
                      </tr>

                      <tr>
                        <td width="15%">Fuel type</td>
                        <td width="35%">
                          <select class="form-control select2" name="fuel_type">
                            <option value="">Select</option>
                            <option value="Petrol">Petrol</option>
                            <option value="Octane">Octane</option>
                            <option value="Diesel">Diesel</option>
                            <option value="CNG">CNG</option>
                          </select>
                        </td>
                        <td width="15%">Fuel limit (monthly) </td>
                        <td width="35%"><input type="text" class="form-control" name="fuel_limit"></td>
                      </tr>

                      <tr>
                        <td width="15%">Colour</td>
                        <td width="35%">
                          <select class="form-control select2" name="colour_id">
                            <option value="">Select</option>
                           @foreach($colours as $data)
                           <option value="{{$data->id}}">{{$data->name}}</option>
                           @endforeach
                          </select>
                        </td>
                        <td width="15%">Vehicle Model </td>
                        <td width="35%"><input type="text" class="form-control" name="vehicle_model"></td>
                      </tr>

                      <tr>
                        <td width="15%">Chasis No</td>
                        <td width="35%"><input type="text" class="form-control" name="chasis_no"></select>
                        </td>

                        <td width="15%">Engine No </td>
                        <td width="35%"><input type="text" class="form-control" name="engine_na"></td>
                      </tr>

                      <tr>
                        <td width="15%">Tax expaired</td>
                        <td width="35%"><input type="date" class="form-control" name="tax"></select>
                        </td>

                        <td width="15%">Fitness expaired </td>
                        <td width="35%"><input type="date" class="form-control" name="fitness"></td>
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
