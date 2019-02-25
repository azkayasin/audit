<!DOCTYPE html>
<html>
<head>
  @include('admin.template.head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    @include('admin.template.header')

    <!-- Left side column. contains the logo and sidebar -->
    {{-- @include('admin.template.sidebar-left') --}}

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>
       {{-- <form action="{{route('summernotePersist')}}" method="POST">
        {{ csrf_field() }}
        <textarea name="summernoteInput" class="summernote"></textarea>
        <br>
        <button type="submit">Submit</button>
    </form> --}}
    <form class="form-horizontal" method="POST" action="{{route('summernotePersist')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tipe</label>
                    <div class="col-sm-10">
                        <input type="text" name="tipe" class="form-control" placeholder="Tipe" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Konten</label>
                    <div class="col-sm-10">
                        <textarea id="konten_editor" name="summernoteInput" class="summernote"
                                  placeholder="Konten"></textarea>
                    </div>
                </div>

                <div class="box-footer text-right">
                    <a href="{{URL::previous()}}" class="btn btn-default">Batal</a>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
    </div>
          <!-- /.content-wrapper -->
          @include('admin.template.footer')

          <!-- Control Sidebar -->
          @include('admin.template.sidebar-right')
          <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div>
 <!-- ./wrapper -->

 <!-- jQuery 3 -->
 @include('admin.template.setting')
<!-- include libraries(jQuery, bootstrap) -->
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
 
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>    
 
<script>
        $(document).ready(function() {
            $('.summernote').summernote({
               tabsize: 2,
                height: 400
            });
        });
</script>

</body>
</html>
