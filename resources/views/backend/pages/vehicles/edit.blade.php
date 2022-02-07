
@extends('backend.layouts.master')

@section('title')
   Edit vehicle registration
@endsection

@push('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
 
    .select2-container--default .select2-selection--single .select2-selection__rendered{
      line-height: 22px!important;
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
            <h1>Edit vehicle registration</h1>
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

                <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST" autocomplete="off">
                  @method('PUT')
                  @csrf
                
                  <table class="table table-bordered">
                      <tr>
                        <td width="15%">Registration no <span class="required">*</span></td>
                        <td width="35%"><input type="text" class="form-control" name="registration" value="{{$vehicle->registration}}" placeholder="Dhaka Metro-" value="Dhaka Metro-"></td>

                        <td width="15%">Purchase type<span class="required">*</span></td>
                        <td width="35%">
                          <select class="form-control" name="purchase_type">
                            <option value="">Select</option>
                            @php
                            $purchase_type = array('Revenue'=>'Revenue', 'Project'=>'Project', 'Rent'=>'Rent');
                            @endphp   
                            @foreach ($purchase_type as $key=>$value)
                            <option value="{{$key}}" {{$key == $vehicle->purchase_type ? 'Selected' : ''}}>{{$value}}</option>
                            @endforeach 
                          </select>
                        </td>
                      </tr>
                      <tr>
                        
                        <td width="15%">Vehicle brand</td>
                        <td width="35%">
                          <select class="form-control select2" name="brand_id">
                            <option value="">Select</option>
                           @foreach($brands as $data)
                           <option value="{{$data->id}}" {{$data->id == $vehicle->brand_id ? 'selected' : ''}}>{{$data->name}}</option>
                           @endforeach
                          </select>
                        </td>
                        <td width="15%">Vehicle CC</td>
                        <td width="35%"><input type="text" value="{{$vehicle->vehicle_cc}}" class="form-control" name="vehicle_cc"></td>

                      </tr>

                      <tr>
                        <td width="15%">Vehicle type<span class="required">*</span></td>
                        <td width="35%">
                          <input type="hidden" value="{{$vehicle->vehi_type_id}}" id="old_vehi_type_id"/>
                          <select class="form-control select2" name="vehi_type_id" onchange="vehicle_category(this.value)">
                            <option value="">Select</option>
                           @foreach($vehicle_types as $data)
                           <option value="{{$data->id}}" {{$data->id == $vehicle->vehi_type_id ? 'selected': '' }}>{{$data->name}}</option>
                           @endforeach
                          </select>
                        </td>

                        <td width="15%">Vehicle category<span class="required">*</span></td>
                        <td width="35%">
                          <input type="hidden" value="{{$vehicle->vehi_cat_id}}" id="old_vehi_cat_id" />
                          <select class="form-control select2" name="vehi_cat_id" id="vehi_cat_id">
                           
                          </select>
                        </td>
                        
                        
                      </tr> 
                  </table>
                  <hr/>
                  <hr/>
                  <table class="table table-bordered">
                    <tr>
                      <td width="15%">Engine type</td>
                      <td width="35%">
                        <select class="form-control select2" name="engine_type">
                          <option value="">Select</option>
                          <option value="Petrol Engine" {{$vehicle->engine_type == 'Petrol Engine' ? 'selected' : ''}}>Petrol Engine</option>
                          <option value="Diesel Engine" {{$vehicle->engine_type == 'Diesel Engine' ? 'selected' : ''}}>Diesel Engine</option>
                        </select>
                      </td>
                      <td width="15%">No of Seat </td>
                      <td width="35%"><input type="text" value="{{$vehicle->seat}}" class="form-control" name="seat"></td>
                      
                    </tr>

                    <tr>
                      <td width="15%">Fuel type</td>
                      <td width="35%">
                        <select class="form-control select2" name="fuel_type">
                          <option value="">Select</option>
                          @php
                          $fuel_type = array('CNG'=>'CNG', 'LPG'=>'LPG', 'Petrol'=>'Petrol', 'Octane'=>'Octane', 'Diesel'=>'Diesel');
                          @endphp   
                          @foreach ($fuel_type as $key=>$value)
                          <option value="{{$key}}" {{$key == $vehicle->fuel_type ? 'Selected' : ''}}>{{$value}}</option>
                          @endforeach
                          
                        </select>
                      </td>
                      <td width="15%">Fuel limit (monthly) </td>
                      <td width="35%"><input type="text" class="form-control" value="{{$vehicle->fuel_limit}}" name="fuel_limit"></td>
                    </tr>

                    <tr>
                      <td width="15%">Colour <span class="btn btn-default" onclick="showModal()" >+</span></td>
                      <td width="35%">
                        <input type="hidden" value="{{$vehicle->colour_id}}" id="old_colour_id" />
                        <select class="form-control select2" name="colour_id" id="colour_id" >
                         
                         
                        </select>

                      </td>
                      <td width="15%">Vehicle Model </td>
                      <td width="35%"><input type="text" class="form-control" value="{{$vehicle->vehicle_model}}"  name="vehicle_model"></td>
                    </tr>

                    <tr>
                      <td width="15%">Chasis No</td>
                      <td width="35%"><input type="text" class="form-control" value="{{$vehicle->chasis_no}}"  name="chasis_no">
                      </td>

                      <td width="15%">Engine No </td>
                      <td width="35%"><input type="text" class="form-control" value="{{$vehicle->engine_no}}"  name="engine_no"></td>
                    </tr>

                    <tr>
                      <td width="15%">Tax expaired</td>
                      <td width="35%"><input type="date" class="form-control" value="{{$vehicle->tax}}"  name="tax">
                      </td>

                      <td width="15%">Fitness expaired </td>
                      <td width="35%"><input type="date" class="form-control" value="{{$vehicle->fitness}}"  name="fitness"></td>
                    </tr>

                    <tr>
                      <td width="15%">Cylinder expaired</td>
                      <td width="35%"><input type="date" class="form-control" value="{{$vehicle->cylinder}}"  name="cylinder">
                      </td>

                      <td width="15%">Remarks </td>
                      <td width="35%"><input type="text" class="form-control" value="{{$vehicle->remarks}}"  name="remarks"></td>
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

<!-- Modal -->
@include('backend.pages.vehicles.partials.add_colour')


@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
  let _token = "{{csrf_token()}}";
</script>

<script>
  old_vehi_type_id = $('#old_vehi_type_id').val();
    $(document).ready(function() {
        $('.select2').select2();

        
         vehicle_category(old_vehi_type_id);    
    })
</script>

<script>  

old_vehi_cat_id = $('#old_vehi_cat_id').val();
    function vehicle_category(id) {
        if (id) {
            $.ajax({
                url: "{{route('admin.vehiclecategory')}}",
                type: "POST",
                data: {
                    id: id,
                    _token: _token
                },
                dataType: "JSON",
                success: function (data) {

                    $(' #vehi_cat_id').html('');
                    $(' #vehi_cat_id').html(data);
                    $('#vehi_cat_id').val(old_vehi_cat_id);  
                    
                },
                error: function (xhr, ajaxOption, thrownError) {
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });
        }
    }

  </script>

  {{-- colour --}}

  <script>      
    $(document).ready(function() {
      
      showColour();    
    })

    old_colour_id = $('#old_colour_id').val();
 
    function showColour(){
        $.ajax({
                url: "{{route('admin.vehiShowcolour')}}",
                type: "POST",
                data: {
                    _token: _token
                },
                dataType: "JSON",
                success: function (data) {
                    $(' #colour_id').html('');
                    $(' #colour_id').html(data);
                    $('#colour_id').val(old_colour_id);    
                },
                error: function (xhr, ajaxOption, thrownError) {
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });
      }

  </script>

  {{-- insert colour --}}

  <script>

    function showModal(){
      document.getElementById("storeColour").reset();
      $('#ColourModal').modal({
            keyboard: false,
            backdrop: 'static'
        });
    }
      
  </script>

  
<<script>
  $('#storeColour').on('submit',function(event){
      event.preventDefault();
      // Get Alll Text Box Id's
      name = $('#name').val();
   
      $.ajax({
        url: "{{route('admin.vehiAddcolour')}}",
        type:"POST",
        data:{
          "_token": "{{ csrf_token() }}",
          name:name,
        },
        //Display Response Success Message
        success: function(response){
          document.getElementById("storeColour").reset();
          $('#ColourModal').modal('hide');
          showColour();
          toastr.success('Colour added successfully')
     },
     error: function (xhr, ajaxOption, thrownError, message) {
           $('#ColourModal').modal('hide');
          console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
          toastr.error('Invalid data')
      }
    });
  });
  </script>

@endpush
