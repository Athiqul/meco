<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product as ProductModel;
use App\Models\ProductImages;
use App\Models\brand;
use App\Models\category;
use App\Models\Subcategory;
use App\Models\Discount;
use App\Models\User;

class Product extends Controller
{
    //show all products
    public function index()
    {
         $products= ProductModel::get();

        // / dd($products);

        return view('admin.products.productList',compact('products'));
    }
    //Add New Products
    public function addProduct()
    {
        return view('admin.products.addProduct');
    }
    //update products
    //Delete Products
    //status change products

}
