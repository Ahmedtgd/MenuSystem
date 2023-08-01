
<?php $__env->startSection('content'); ?>
<?php
$locale = App::getLocale();
$align_class = $locale == 'en' ? 'text-left' : 'text-right';
$rtl = false;
if($locale == 'en')
{
    $rtl = 'rtl: false,';
}
if($locale == 'ar')
{
    $rtl = 'rtl: true,';
}
$division = 5;
$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))

$division = 3;

?>
<style>
    body{
        -moz-transition: padding-top 0.5s ease;
  -o-transition: padding-top 0.5s ease;
  -webkit-transition: padding-top 0.5s ease;
  transition: padding-top 0.5s ease;
    }
    .product-item{
        min-height: 180px;
    }
    .owl-next span{
        direction: ltr;
    }
    .owl-prev span{
        direction: ltr;
    }
    .common-listing-class{
        margin-top: 20px;
        min-height: 10px;
    }
    .common-listing-class{
        margin-top: 20px;
        min-height: 10px;
    }
    #slider-menu-main{
        -moz-transition: all 0.5s ease;
  -o-transition: all 0.5s ease;
  -webkit-transition: all 0.5s ease;
    }
    .sticky{
        position: fixed;
        top: 0;
        /*width: 92%;*/
        background: white;
        /* -moz-transition: all 0.5s ease;
  -o-transition: all 0.5s ease;
  -webkit-transition: all 0.5s ease; */
  z-index: 99;
    }
    .pt-100{
        position: relative;
    width: 100%;
    top: 185px;
        /* padding-top: 100px; */
    }
    .pr{
        position: relative;
        top: 175px;
    }

    /* ==== */
    .product-image{
        height: 85px;
    }
    @media  screen and (max-width: 575px) {
        .product-image{
            height: 55px;
        }
        .product-title{
            font-size: 14px;
            padding: 0;
        }
        .current-category-title{
            font-size: 18px;
        }
        .product-price{
            font-size: 14px;
        }
        .product-item .product-image{
            border-radius: 0px !important;
        }
        
    }
    
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div id="owl-main-section">
            <div class="main-menu">
                <p class="main-menu-heading text-center">
                    <?php echo e(__('site.main_menu')); ?>

                </p>
            </div>
            <!-- Set up your HTML -->
			<?php if(count($categories)): ?>
            <div class="owl-carousel" id="slider-menu">
				<?php
					$count = 1;
                    $count_slide = 0;
				?>
				<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                if($count>$division)
                {
                    $division +=$division;
                    $count_slide++;
                }
                $url = asset('uploads/category/'.$category->thumbnail);
                ?>
                <div number-slide="<?php echo e($count_slide); ?>" class="slider-category-item <?= $count == 1 ? 'active' : ''?>" id="item-common-<?php echo e($category->id); ?>" target-section="common-<?php echo e($category->id); ?>" cat-id="<?php echo e($category->id); ?>"> 
                    <div id="5c07e7a245a4dc00139e8b43" height="135" class="box__Box-sc-1ou4qyg-0 dxfvZz">
                        <div class="slider-category-image" style="background-image: url('<?php echo e($url); ?>');background-size: cover; background-position: center; background-repeat: no-repeat; height: 125px;"></div>
                            <div display="flex" height="45" class="box__Box-sc-1ou4qyg-0 kUVlyD">
                            <p class="slider-category-title mt-3">
                            	<?php echo e($locale == 'en' ? ucwords($category->title) : $category->title_ar); ?>

                            </p>
                        </div> 
                    </div>
                </div>
				<?php
					$count++;
				?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
			<?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row">
		<div class="col-md-12">
			<div class="ajax-products">
                <div class="common-listing-class" id="common-div">
                <div id="loading-image"  class="text-center" style="display: none;">
				<img src="<?php echo e(asset('theme/images/loader.svg')); ?>" />
			    </div>
                <div class="content"></div>
                </div>
			</div>
		</div>
	</div>
</div>
<script>
    // When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

// Get the header
var header = document.getElementById("owl-main-section");

// Get the offset position of the navbar
var sticky = header.offsetTop;

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
    var outerheight = $('.top-navbar').outerHeight();
    var divwidth = $('.ajax-products').width()+22;
    $('#owl-main-section').css('width', divwidth);
    $('#owl-main-section').css('margin', '-11px');
//   if (window.pageYOffset > sticky) {
  if ($(window).scrollTop() > outerheight) {
    //   var divwidth = $('.ajax-products').width()+22;
    // $('.sticky').css('width', divwidth);
    // $('.sticky').css('margin', '-11px');
    header.classList.add("sticky");
    $('.ajax-products').addClass('pt-100');
    $('.footer-area').addClass('pr');
  } else {
    //   $('.sticky').css('width', '100%');
    //   $('.sticky').css('margin', '0px');
    header.classList.remove("sticky");
    $('.ajax-products').removeClass('pt-100');
    $('.footer-area').removeClass('pr');
  }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\feso beso\Documents\berbene2\berbene\resources\views/frontend/home.blade.php ENDPATH**/ ?>