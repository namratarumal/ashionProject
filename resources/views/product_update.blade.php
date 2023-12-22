@extends('header')
@section('content')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Product Update </h4>
                    
                    <form class="forms-sample" id='formbtn' method="post" enctype="multipart/form-data" action="{{route('product.update',$product->id)}}">
                      @csrf
                      @method('PATCH')
                      <img src="{{asset('admin/image')}}/{{$product->image}}" style="height:300px;">
                      <div class="form-group" >
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$product->name}}" required>
                      </div>
                      <div class="form-group" >
                        <label for="exampleInputName1">Category</label>
                        <select class="form-control" name="sid">
                          <option>Select category</option>
                          @foreach($subcategory as $s)
                          <option value="{{$s->id}}">{{$s->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                      <div class="form-group" >
                        <label for="exampleInputName1">Description</label>
                        <textarea class="form-control" name="description" value="{{$product->description}}" required>Description</textarea>
                      </div>
                      <div class="form-group" >
                        <label for="exampleInputName1">Price</label>
                        <input type="text" class="form-control" name="price" value="{{$product->price}}"required>
                      </div>
                      <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="mulimage[]" class="file-upload-default" Multiple>
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                     
                      <table class="table table-bordered">                     
                          <td style="border:none;top-border:none;"><?php 
                          foreach(json_decode($product->mulimage) as $img)
                          {
                            ?>
                            <img src="{{asset('admin/image')}}/{{$img}}">
                            <?php
                          }?>
                          </td>
                          
                    </table>                  
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
    <!-- <script>
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
    </script> -->
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