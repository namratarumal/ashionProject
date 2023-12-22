@extends('header')
@section('content')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Product View</h4>
                    <img src="{{asset('admin/image')}}/{{$product->piamge}}">

                    <table class="table table-bordered">                   
                      <thead>                       
                        <tr>                         
                          <td><?php 
                          foreach(json_decode($product->mulimage) as $img)
                          {
                            ?>
                            <img src="{{asset('admin/image')}}/{{$img}}">
                            <?php
                          }?>
                          </td>                        
                        </tr>                 
                    </table>
                    <table class="table table-bordered">
                    
                      <thead>
                        <tr>
                          <th> Id </th>
                          <td>{{ $product->pid}} </td>
                        </tr>
                        <tr>
                          <th> Category  </th>
                          <td>{{ $product->name}} </td>
                        </tr>
                         <tr> 
                          <th> Name </th>
                          <td> {{ $product->pname}} </td>
                        </tr>
                       
                        <tr>
                          <th> Description </th>
                          <td> {{ $product->description}} </td>
                        </tr>
                        <tr>
                          <th> Price </th>
                          <td> {{ $product->price}} </td>
                        </tr>
                       
                      </thead>               
                    </table>
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
    <!-- End custom js for this page -->
  </body>
</html>
@endsection