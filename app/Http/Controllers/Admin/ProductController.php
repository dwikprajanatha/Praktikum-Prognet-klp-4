<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

use App\Product;
use App\ProductImage;
use App\ProductCategory;
use App\Discount;

use File;
use DB;
use Image;


class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::where('status',1)->get();

        return View('admin.product.adminProductList')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = ProductCategory::select('category_name')->where('status','Aktif')->get();

        return view('admin.product.adminProductAddNew')->with('categories',$categories);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'stock' => 'required',
            'weight' => 'required',
            'categories' => 'required:',
            'description' => 'required|string|max:255',
            'rate' => 'required',
            'price' => 'required',

        ]);
        
        //get id product_category
        foreach ($request->categories as $category) {

            $id = ProductCategory::select('id')->where('category_name',$category)->get()->toArray();

            $id_categories[] = $id[0];

        }

        //create date
        $before = strtotime($request->disc_start);
        $start_disc = date('Y-m-d',$before);
        
        $before = strtotime($request->disc_end);
        $end_disc = date('Y-m-d',$before);

        $date = ['start' => $start_disc, 'end' => $end_disc];


        DB::transaction(function() use($request, $id_categories, $date){

                //product
                $product = new Product;
                $product->product_name = $request->name;
                $product->stock = $request->stock;
                $product->weight = $request->weight;
                $product->description = $request->description;
                $product->product_rate = $request->rate;
                $product->price = $request->price;

                $product->save();
                

                //product_category_detail
                foreach ($id_categories as $id) {

                    DB::table('product_category_details')->insert(['product_id' => $product->id, 'category_id' => implode('',$id)]);

                }


                // discount
                if(isset($request->discount)){
                    
                    $discount = new Discount;
                    $discount->product_id = $product->id;
                    $discount->percentage = $request->discount;
                    $discount->start = $date['start'];
                    $discount->end = $date['end'];
                    $discount->save();

                }

                

                if($request->hasfile('files')){

                    foreach($request->file('files') as $file){

                        $ext = $file->getClientOriginalExtension();
                        $name = str_replace(' ','',$request->name);
                        $filename = $name.time() . rand(1,10) . '.' . $ext;
                        $location = public_path('images/'.$filename);
        
                        if(Image::make($file)->resize(800, 800)->save($location)){
                            
                            $image = new ProductImage;
                            $image->product_id = $product->id;
                            $image->image_name = $filename;
                            $image->image_location = $location;
                            $image->save();

                        }
                    }
                }

      });

        
        return redirect()->back()->with('success','Data Berhasil di Input');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Product::find($id);
        $images = ProductImage::select('image_name')
                            ->where([
                            ['product_id',$id],
                            ['status',1],
                            ])->get();
        
        $category = DB::table('product_category_details')
            ->join('products','product_id','=','products.id')
            ->join('product_categories','category_id','=','product_categories.id')
            ->select('category_name')->where('product_id',$id)->get();
        
        return view('admin.product.adminProductDetail')->with(['product' => $data, 'images' => $images, 'category' => $category,]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataProduct = Product::find($id);

        $categories = ProductCategory::where('status','Aktif')->get();

        $category_id = DB::table('product_category_details')
        ->join('products','product_id','=','products.id')
        ->join('product_categories','category_id','=','product_categories.id')
        ->select('category_id')->where('product_id',$id)->get();

        return view('admin.product.adminProductEdit')->with(['product' => $dataProduct, 'categories' => $categories, 'category_id' => $category_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request,$id);

        $this->validate($request, [
            'name' => 'required|string',
            'stock' => 'required',
            'weight' => 'required',
            'description' => 'required|string|max:255',
            'rate' => 'required',
            'price' => 'required',

        ]);
        
        DB::transaction(function() use($request,$id){

            $product = Product::find($id);
            $product->product_name = $request->name;
            $product->stock = $request->stock;
            $product->weight = $request->weight;
            $product->price = $request->price;
            $product->product_rate = $request->rate;
            $product->description = $request->description;
            $product->save();
    
            if($request->hasfile('files')){
    
                $old_images = ProductImage::where('product_id',$id)->get();
    
                foreach($request->file('files') as $file){
    
                    $ext = $file->getClientOriginalExtension();
                    $name = str_replace(' ','',$request->name);
                    $filename = $name.time() . rand(1,10) . '.' . $ext;
                    $location = public_path('images/'.$filename);
    
                    if(Image::make($file)->resize(800, 800)->save($location)){
                        
                        $image = new ProductImage;
                        $image->product_id = $product->id;
                        $image->image_name = $filename;
                        $image->image_location = $location;
                        $image->save();
    
                    }
                }
    
                foreach($old_images as $old_image){
                    $pic = ProductImage::find($old_image->id);
                    $pic->status = 0;
                    $pic->save();

                    unlink(public_path('images/'.$old_image->image_name));
                }
    
            }


        });
        
        return redirect(route('product.show',$id))->with('success','Produk Berhasil di Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::transaction(function() use($id){

            Product::find($id)->update(['status' => 0]);

            ProductImage::where('product_id',$id)->update(['status' => 0]);

        });

        return redirect(route('product.index'))->with('success','Data Berhasil di Hapus');
    }
}
