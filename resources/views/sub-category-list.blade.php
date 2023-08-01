<?php
use App\Models\Product;
use App\Models\Category;
$dash .= '-- ';?>
@foreach($subcategories as $subcategory)
<?php $_SESSION['i'] = $_SESSION['i'] + 1; 
    $prod_count = Product::where('categoryId', $subcategory->translationId)->where('language', $subcategory->language)->count();
    $count = Category::where('translationId', $subcategory->translationId)->count();
?>
                                <tr class="row1 group" data-id="{{ $subcategory->id }}">
    <td></td>
    <td>
    <a href="{{ asset('uploads/category/'.$subcategory->image) }}" data-lightbox="myImg<?php echo $subcategory->id;?>" data-title="{{$subcategory->title}}">
                                        <img src="{{ asset('uploads/category/'.$subcategory->thumbnail) }}" width="150" data-lightbox="myImg<?php echo $subcategory->id;?>"/>
                                        </a>    
</td>
    <td>{{$dash}}{{$subcategory->title}}</td>
    <td>{{$dash}}{{$subcategory->title_ar}}</td>
    
    <td>{{$subcategory->parent->title}}</td>
    <td>{{$prod_count}}</td>
    <td>
        <a href="{{Route('editCategory', $subcategory->id)}}">
            <button class="btn btn-sm btn-info">Edit</button>
        </a>
        <a href="{{Route('deleteCategory', $subcategory->id)}}">
            <button class="btn btn-sm btn-danger">Delete</button>
        </a>
    </td>
</tr>
@endforeach