
<?php $__env->startSection('content'); ?>
<style>
    .preview {
overflow: hidden;
width: 234px !important; 
height: 121px !important;
margin: 10px;
border: 1px solid red;
}

    .filters-heading
    {
        color: cadetblue;
    }
    .custom-form-control{
        font-size: 15px;
    }
    .pagination{
        float: right;
    }
    <style>
    .ck-editor__editable {
    min-height: 265px;
}

    .preview {
overflow: hidden;
width: 234px !important; 
height: 121px !important;
margin: 10px;
border: 1px solid red;
}
.container {
  box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.5);
  border-radius: 10px;
}


</style>
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
                        <li class="breadcrumb-item active">Add Slider</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">Add New Slider</h3>
</br>
    <section class="content" style="padding:20px 30%;">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        
                    </div>

                    <form role="form" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Slider title*</label>
                                        <input type="text" name="title" class="form-control" placeholder="Slider name" value="<?php echo e(old('title')); ?>" required />
                                    </div>
                                </div>
                                <!-- <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Slider description</label>
                                        <textarea name="description" class="form-control" placeholder="Slider description"><?php echo e(old('description')); ?></textarea>
                                    </div>
                                </div> -->
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Image*</label><span>(626px x 367px)</span>
                                        <input id="image_select" type="file" name="image_before" class="input is-large image" style="height: 60px !important;margin-bottom:13px" required>
                                        <input id="image_original" type="hidden" name="image" class="input is-large image" style="height: 60px !important;margin-bottom:13px">
                                        <!-- <input type="file" name="image" class="form-control"> -->
                                    </div>
                                </div>
                                <!-- <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Website Slider Image*</label><span>(1920 x 1280)</span>
                                        <input type="file" name="web_image" class="form-control">
                                        
                                    </div>
                                </div> -->

                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Create</button>

                        </div>
                    </form>

                    <?php if($errors->any()): ?>
                    <div>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="alert alert-danger"><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>

                    <?php if(\Session::has('error')): ?>
                    <div>
                        <li class="alert alert-danger"><?php echo \Session::get('error'); ?></li>
                    </div>
                    <?php endif; ?>

                    <?php if(\Session::has('success')): ?>
                    <div>
                        <li class="alert alert-success"><?php echo \Session::get('success'); ?></li>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
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
<div class="col-md-8">
<img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
</div>
<div class="col-md-4">
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('cropper_script'); ?>
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
aspectRatio: 626/367,
viewMode: 3,
preview: '.preview'
});
}).on('hidden.bs.modal', function () {
cropper.destroy();
cropper = null;
});
$("#crop").click(function(){
canvas = cropper.getCroppedCanvas({
width: 626,
height: 367,
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/create-slider.blade.php ENDPATH**/ ?>