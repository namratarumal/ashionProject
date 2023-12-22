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
                        <tr>
                          <th> Id </th>
                          <th>Name </th>
                           <th> Email </th>
                          <th> Total Bill</th>
                          <th> State </th>
                         
                         <th> Show</th>
                          
                          <th> Delete</th>
                        </tr>
                      </thead>
                      @foreach($checkout as $c)
                      <tbody>
                        <tr>
                          <td>{{ $c->id}} </td>
                          <td> {{ $c->name}} </td>
                          <td>
                            {{$c->email}}
                          </td>
                          <td>
                            {{$c->total_bill}}
                          </td>
                          <td>
                            {{$c->state}}
                          </td>
                          
                         <td><a href="/shppingShow/{{$c->id}}"><button type="submit" class="btn btn-primary mr-2" style="background:skyblue;border:skyblue;">Show</button></a></td>
                         
                          <td>
                            <form method='post' action="/shoppingDelete/{{$c->id}}"> 
                              @csrf
                              @method('DELETE')
                              <button type="submit" style="border:none;background-color:white;"> 
                            <img src="{{asset('admin/image/delete.png')}}" style="height:30px;width:100%;"></button>
                            </form>
                          </td>
                        </tr>                  
                      </tbody>
                      @endforeach
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