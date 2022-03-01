
@extends('backend.layouts.master')

@section('title')
   Create estimate
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
<div class="content-wrapper" id="app">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create estimate</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.brands.index')}}" class="btn btn-success btn-sm">Brand list</a></li>
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
                
                  <form action="{{ route('admin.brands.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12 col-sm-12">
                            <label for="name">Brand name<span class="required"> *</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Brand name">
                        </div>
                    </div>

                    

                    
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

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-4">
            

            <div class="card">
      
              <!-- /.card-header -->
              <div class="card-body">
          
                <div class="form-group">
                  <label>Select Service:</label>
                  <select class='form-control' v-model='servicetype' @change='getSpareParts()'>
                    <option value='0' >Service Type</option>
                    <option v-for='data in servicetypes' :value='data.id'>@{{ data.name }}</option>
                  </select>
              </div>
              <form action="{{route('admin.addCartParts')}}" method="POST">
                @csrf
              <div class="form-group">
                  <label>Select Spare Parts:</label>
                  <select class='form-control' v-model='sparepart' name="spare_parts_id">
                    <option value='0'>Select</option>
                    <option v-for='data in spareparts' :value='data.id'>@{{ data.name }}</option>
                  </select>
              </div>
              <div class="form-group">
                <button type="submit" class="form-control">Add</button>
                
            </div>
            </form>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-8">
            

            <div class="card">
      
              <!-- /.card-header -->
              <div class="card-body">
              
                <form action="" method="POST" autocomplete="off">
                  @csrf
                  <table class="table table-bordered">
                    <tr>
                      <th>SL</th>
                      <th>Service</th>
                      <th>Parts</th>
                      <th>Qty</th>
                      <th>Value</th>
                      <th>Del</th>
                    </tr>
                    
                    <tr v-for='data in cartParts'>
                   
                      <td>@{{data.id}}</td>
                      <td>@{{data.price}}</td>
                      <td>@{{data.name}}</td>
                      <td>@{{data.quantity}}</td>
                      <td><input name="price" class="form-control"/></td>
                      <td style="color: red">
                        <button type="button" class="btn btn-sm btn-danger">
                          X
                        </button>
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
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>

var app = new Vue({
  el: '#app',
  mounted() {
    
  },
  data(){
          return {
              servicetype: 0,
              servicetypes: [],
              cartParts: [],
              sparepart: 0,
              spareparts: []
          }
  },
  methods:{
          getServiceType: function(){
            axios.get('/admin/get-servicetype')
            .then(function (response) {
               this.servicetypes = response.data;
            }.bind(this));
       
          },
          getSpareParts: function() {
              axios.get('/admin/get-spartparts',{
               params: {
                 servicetype_id: this.servicetype
               }
            }).then(function(response){
                  this.spareparts = response.data;
              }.bind(this));
          },

          getCartParts: function(){
            axios.get('/admin/get-cart-parts')
            .then(function (response) {
               this.cartParts = response.data;
            }.bind(this));
       
          }

      },
      created: function(){
          this.getServiceType()
          this.getCartParts()
      }
})

</script>



@endpush
