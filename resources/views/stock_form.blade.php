@extends('header')
@section('content')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Product Stock </h4>
                    
                    <form class="forms-sample"  method="post"  action="{{route('stock.store')}}">
                      @csrf
                      <div class="form-group" >
                        <label for="exampleInputName1">Product Name</label>
                       
                        <select class="form-control" name="pid">
                            <option>Select Product</option>
                            @foreach($product as $p)
                            <option value="{{$p->id}}">{{$p->name}}</option>
                            @endforeach
                        </select>
                       
                      </div>
                      
                      <div class="form-group" >
                        <label for="exampleInputName1">Stock</label>
                        <input type="text" class="form-control" name="stock" placeholder="Enter Stock" required>
                      </div>
                     
                      <input type="submit" class="btn btn-gradient-primary me-2" value="Submit">
                     
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © bootstrapdash.com 2021</span>
              <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin template</a> from Bootstrapdash.com</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <script>
     $(document).ready(function(e){
        $('#formbtn').on('submit',function(e){
            e.preventDefault();

            $.ajax({
                method:'POST',
                url:'http://localhost:8000/api/apicatrgory',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    console.log(data);
                },
                error:function(data)
                {
                    console.log(data);
                }
            })
        });
     });
    </script>
    <!-- plugins:js -->
    <script src="{{asset('admin/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('admin/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('admin/assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('admin/assets/js/misc.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('admin/assets/js/file-upload.js')}}"></script>
    <!-- End custom js for this page -->
  </body>
</html>
@endsection