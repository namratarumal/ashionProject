@extends('header')
@section('content')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Shipping Details</h4>
                    <br><br>
                    <table class="table table-bordered">
                      <thead>
                       
                      </thead>
                     
                      <tbody>
                        <tr>
                        <th> Id </th>
                          <td>{{ $checkout->id}} </td>
                        </tr>
                        <tr>
                        <th> Name </th>
                          <td>{{ $checkout->name}} </td>
                        </tr>
                        <tr>
                        <th> Country </th>
                          <td>{{ $checkout->country}} </td>
                        </tr>
                        <tr>
                        <th> Address </th>
                          <td>{{ $checkout->address}} </td>
                        </tr>
                        <tr>
                        <th> Streetaddress </th>
                          <td>{{ $checkout->streetaddress}} </td>
                        </tr>
                        <tr>
                        <th> City </th>
                          <td>{{ $checkout->city}} </td>
                        </tr>
                        <tr>
                        <th> State </th>
                          <td>{{ $checkout->state}} </td>
                        </tr>
                        <tr>
                        <th> Contact </th>
                          <td>{{ $checkout->contact}} </td>
                        </tr>
                        <tr>
                        <th> Pincode </th>
                          <td>{{ $checkout->pincode}} </td>
                        </tr>
                        <tr>
                        <th> Email </th>
                          <td>{{ $checkout->email}} </td>
                        </tr>
                        <tr>
                        <th> Product Name </th>
                          <td>{{ $checkout->product_name}} </td>
                        </tr>
                        <tr>
                        <th> Total Bill </th>
                          <td>{{ $checkout->total_bill}} </td>
                        </tr>
                                        
                      </tbody>
                    
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