<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Classes\Helper;
use Session;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('CheckAdminLogin');
        $this->viewprefix='admin.product.';
        $this->index='product.index';
    }
    public function index(Request $request)
    {
        $this->delImages("1700928531.png");
        $filters = $request->all();
        $query = new Product;
        if(!empty($filters['keyword'])){
            $query = $query->where('name', 'like', '%' . $filters['keyword'] . '%');
        }
        if(!empty($filters['idcat'])){
            $query = $query->where('idcat', $filters['idcat']);
        }
        info($query->toSql(), $query->getBindings());

        $products = $query->get();
        $categories = categories::all();
        return view($this->viewprefix.'index', compact('products', 'categories', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Categories::all();
        return view($this->viewprefix.'create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description'=>'required',
            'baohanh'=>'required',
            'size'=>'required',
            'trangthai'=>'required',
            'discount' => 'required',
            // 'content' => 'required',
            'idcat' => 'required',
        ]);
        $data['image'] = $this->imageUploadCreate($request);
        $result = Product::create($data);
        info($result);
        if($result)
            Session::flash('message', 'successfully!');
        else
            Session::flash('message', 'Failure!');
        return redirect()->route($this->index);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $products = Product::all();
        $category = Categories::all();
        return view($this->viewprefix.'edit',compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->delImages($product->image);

        $data=$request->validate([
            'name' => 'required',
            'price' => 'required',
            'description'=>'required',
            'baohanh'=>'required',
            'size'=>'required',
            'trangthai'=>'required',
            'discount' => 'required',
            'idcat' => 'required',
        ]);
        //delete old images'
        $this->delImages($product->image);
        $data['image'] = $this->imageUploadCreate($request);
        if($product->update($data))
            Session::flash('message', 'successfully!');
        else
            Session::flash('message', 'Failure!');
        return redirect()->route($this->index);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //delete images
        if(!empty($product->image)){
            $this->delImages($product->image);
        }
        if($product->delete())
            Session::flash('message', 'successfully!');
        else
            Session::flash('message', 'Failure!');
        return redirect()->route($this->index);
    }

    

    public function imageUploadCreate(Request $request)
    {
        if($request->hasFile('image')){
            if($request->file('image')->isValid()){
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);

                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                return $imageName;
            }
        }
        return "";
    } 
    private function delImages($fileName)
    {
        if (file_exists(public_path('images/' . $fileName))){
            $filedeleted = unlink(public_path('images/' . $fileName));
        }
        
        return true;
    }
}
