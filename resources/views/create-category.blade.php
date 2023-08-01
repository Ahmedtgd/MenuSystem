@extends('layouts.app')
@section('content')
<style>

.container {
  box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.5);
  border-radius: 10px;
}
</style>
<div class="container">
<div class="content-wrapper" style="min-height: 375px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                 
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">Add New Categories</h3>
    <section class="content" style="padding:20px 1%;">
   

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        
                    </div>

                    <form role="form" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Category title*</label>
                                        <input type="text" name="title" class="form-control" placeholder="Category name" value="{{old('title')}}" required />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Category title Arabic*</label>
                                        <input type="text" name="title_ar" class="form-control" placeholder="Category arabic name" value="{{old('title_ar')}}" required />
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Image*</label>
                                        <input id="image_web" type="file" name="image" class="form-control input is-large image" style="height: 60px !important;margin-bottom:13px" required>
                                        <!-- <input id="image_select" type="file" name="image_before" class="form-control input is-large image" style="height: 60px !important;margin-bottom:13px" required> -->
                                        <!-- <input id="image_original" type="hidden" name="image" class="input is-large image" style="height: 60px !important;margin-bottom:13px"> -->
                                        <!-- <input type="file" name="image" class="form-control"> -->
                                        <!-- <span>300</span> -->
                                        <span>(214px X 125px)</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tab image*</label>
                                        <input id="image_tab" type="file" name="tab_image" class="form-control input is-large image" style="height: 60px !important;margin-bottom:13px" required>
                                        <!-- <input id="image_select" type="file" name="tab_image" class="form-control input is-large image" style="height: 60px !important;margin-bottom:13px" required> -->
                                        <!-- <input id="image_original" type="file" name="image" class="input is-large image" style="height: 60px !important;margin-bottom:13px"> -->
                                        <!-- <input type="file" name="image" class="form-control"> -->
                                        <!-- <span>300</span> -->
                                        <span>(90px X 90px)</span>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select parent category*</label>
                                        <select type="text" name="parentId" class="form-control">
                                            <option value="">None</option>
                                            @if($categories)
                                            @foreach($categories as $category)
                                            <?php $dash = ''; ?>
                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Create</button>

                        </div>
                    </form>

                    @if ($errors->any())
                    <div>
                        @foreach ($errors->all() as $error)
                        <li class="alert alert-danger">{{ $error }}</li>
                        @endforeach
                    </div>
                    @endif

                    @if(\Session::has('error'))
                    <div>
                        <li class="alert alert-danger">{!! \Session::get('error') !!}</li>
                    </div>
                    @endif

                    @if(\Session::has('success'))
                    <div>
                        <li class="alert alert-success">{!! \Session::get('success') !!}</li>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="modalLabel">Crop Image Before Upload</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<div class="img-container">
<div class="row">
<div class="col-md-9">
<img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
</div>
<div class="col-md-3">
<div class="preview"></div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
<button type="button" class="btn btn-primary" id="crop">Crop</button>
</div>
</div>
</div>
</div>
</div>
@endsection
@section('cropper_script')
<script>
    $(document).ready(function(){
    $('#image_select').on('change', function(){
        console.log('here in change function of image');
    });
    //  $('#modal') = $('#modal');
var image = document.getElementById('image');
console.log(image);

var cropper;
$("#image_select").on("change", function(e){
var files = e.target.files;
var done = function (url) {
image.src = url;
$('#modal').modal('show');
};
var reader;
var file;
var url;
if (files && files.length > 0) {
file = files[0];
if (URL) {
done(URL.createObjectURL(file));
} else if (FileReader) {
reader = new FileReader();
reader.onload = function (e) {
done(reader.result);
};
reader.readAsDataURL(file);
}
}
});
$('#modal').on('shown.bs.modal', function () {
cropper = new Cropper(image, {
aspectRatio: 150/100,
viewMode: 1,
preview: '.preview'
});
}).on('hidden.bs.modal', function () {
cropper.destroy();
cropper = null;
});
$("#crop").click(function(){
canvas = cropper.getCroppedCanvas({
width: 150,
height: 100,
});
canvas.toBlob(function(blob) {
url = URL.createObjectURL(blob);
var reader = new FileReader();
reader.readAsDataURL(blob); 
reader.onloadend = function() {
var base64data = reader.result; 
$('#image_original').val(base64data);
$('#modal').modal('hide');
// $.ajax({
// type: "POST",
// dataType: "json",
// url: "/admin/test/category",
// data: {'_token': $('input[name="_token"]').val(), 'image': base64data},
// success: function(data){
// $('#modal').modal('hide');
// alert("Crop image successfully uploaded");
// }
// });
}
});
})
});
</script>
@endsection 