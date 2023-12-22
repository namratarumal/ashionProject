<html>
    <body>
       <form method="POST" action="{{url('import')}}" enctype="multipart/form-data">
        @csrf
         <input type="file" name="file"><br><br>
         <input type="submit" value="Import">
       </form>
       <a href="{{url('registerexport')}}">Export</a>
    </body>
</html>