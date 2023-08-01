<?php $dash.='-- '; ?>
@foreach($subcategories as $subcategory)
    <!-- @if($category->id != $subcategory->id ) -->
        <option value="{{$subcategory->id}}" {{$product->categoryId == $subcategory->id ? 'selected' : ''}} >
        	{{$subcategory->title}}
        	<!-- {{$dash}}{{$subcategory->title}} -->
        </option>
    <!-- @endif -->
    <!-- @if(count($subcategory->subcategory))
        @include('sub-category-list-option-for-update',['subcategories' => $subcategory->subcategory])
    @endif -->
@endforeach