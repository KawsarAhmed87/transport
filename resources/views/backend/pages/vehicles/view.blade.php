
@extends('backend.layouts.master')

@section('title')
   Vehicle registration info
@endsection

@push('style')

@endpush

@section('backend-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vehicle registration info</h1>
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
                
                  <table class="table table-bordered">
                      <tr>
                        <td width="15%">Registration no </td>
                        <td width="35%">{{$vehicle->registration}}</td>

                        <td width="15%">Purchase type</td>
                        <td width="35%">{{$vehicle->purchase_type}}</td>
                      </tr>
                      <tr>
                        
                        <td width="15%">Vehicle brand</td>
                        <td width="35%">{{$vehicle->brand->name}}</td>
                        <td width="15%">Vehicle CC</td>
                        <td width="35%">{{$vehicle->vehicle_cc}}</td>

                      </tr>

                      <tr>
                        <td width="15%">Vehicle type</td>
                        <td width="35%">{{$vehicle->vehicle_type->name}}</td>

                        <td width="15%">Vehicle category</td>
                        <td width="35%">{{$vehicle->vehicle_category->name}}</td>
                        
                        
                      </tr> 
                  </table>
                  <hr/>
                  <hr/>
                  <table class="table table-bordered">
                    <tr>
                      <td width="15%">Engine type</td>
                      <td width="35%">{{$vehicle->engine_type}}</td>
                      <td width="15%">No of Seat </td>
                      <td width="35%">{{$vehicle->seat}}</td>
                      
                    </tr>

                    <tr>
                      <td width="15%">Fuel type</td>
                      <td width="35%">{{$vehicle->fuel_type}}</td>
                      <td width="15%">Fuel limit (monthly) </td>
                      <td width="35%">{{$vehicle->fuel_limit}}</td>
                    </tr>

                    <tr>
                      <td width="15%">Colour</td>
                      <td width="35%">{{$vehicle->colour->name}}</td>
                      <td width="15%">Vehicle Model </td>
                      <td width="35%">{{$vehicle->vehicle_model}}</td>
                    </tr>

                    <tr>
                      <td width="15%">Chasis No</td>
                      <td width="35%">{{$vehicle->chasis_no}}
                      </td>

                      <td width="15%">Engine No </td>
                      <td width="35%">{{$vehicle->engine_no}}</td>
                    </tr>

                    <tr>
                      <td width="15%">Tax expaired</td>
                      <td width="35%">{{$vehicle->tax}}
                      </td>

                      <td width="15%">Fitness expaired </td>
                      <td width="35%">{{$vehicle->fitness}}</td>
                    </tr>

                    <tr>
                      <td width="15%">Cylinder expaired</td>
                      <td width="35%">{{$vehicle->cylinder }}</td>

                      <td width="15%">Remarks </td>
                      <td width="35%">{{$vehicle->remarks}}</td>
                    </tr>
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

<!-- Modal -->

@endsection

@push('scripts')
@endpush
