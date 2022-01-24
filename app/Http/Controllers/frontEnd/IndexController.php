<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\ProductAttribute;
use App\Models\ProductReview;
use App\Models\AboutUs;


use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

class IndexController extends Controller
{
    public function showHomepage()
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $brands = Brand::where(['status'=>'active', 'status'=>'active'])->orderBy('id', 'DESC')->get();

        $sliders = Slider::where(['status'=>'active'])->orderBy('id', 'DESC')->get();
        $banners = Banner::where(['status'=>'active', 'condition'=>'Banner'])->orderBy('id', 'DESC')->get();
        $pro_banners = Banner::where(['status'=>'active', 'condition'=>'Promotional'])->orderBy('id', 'DESC')->get();

        $new_products = Product::where(['status'=>'active', 'conditions'=>'new'])
        ->where('stock', '>', 0)
        ->orderBy('id', 'DESC')
        ->limit(8)
        ->get();

        $special_products = Product::where(['status'=>'active', 'conditions'=>'special'])
        ->where('stock', '>', 0)
        ->orderBy('id', 'DESC')
        ->limit(8)
        ->get();
        
        $popular_products = Product::where(['status'=>'active', 'conditions'=>'popular'])
        ->where('stock', '>', 0)
        ->orderBy('id', 'DESC')
        ->limit(8)
        ->get();

        
        // Top Selling
        $items_sold = DB::table('order_details')->select('product_id', DB::raw('count(product_id) as count_productSold'))->groupBy('product_id')->orderBy('count_productSold', 'desc')->limit(10)->get();
        $product_ids = [];

        foreach($items_sold as $item){
            array_push($product_ids, $item->product_id);
        }
        
        $idsImplodedSold = implode(',', array_fill(0, count($product_ids), '?'));

        if($idsImplodedSold != null) {
            $best_selling = Product::whereIn('id', $product_ids)->orderByRaw("field(id, {$idsImplodedSold})", $product_ids)->get();
        }else {
            $best_selling = [];
        }
       
       
        //Top rated
        $items_rated= DB::table('product_reviews')->select('product_id', DB::raw('avg(rate) as avg_product'))->groupBy('product_id')->orderBy('avg_product', 'desc')->limit(10)->get();
     

        $product_ids = [];
        foreach($items_rated as $item){
            array_push($product_ids, $item->product_id);
        }

        $idsImplodedRated = implode(',', array_fill(0, count($product_ids), '?'));
        if($idsImplodedRated != null) {
            $best_rated = Product::whereIn('id', $product_ids)->orderByRaw("field(id, {$idsImplodedRated})", $product_ids)->get();
        }else {
            $best_rated = [];
        }
         
      
        return view('frontEnd.home', compact(['categories',
                                              'brands',
                                              'sliders',
                                              'banners', 
                                              'pro_banners',
                                              'new_products',
                                              'special_products',
                                              'popular_products',
                                              'best_selling',
                                              'best_rated',                                  
                                            ]));
    }

    public function showAllProducts(Request $request)
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])
        ->orderBy('title', 'ASC')
        ->get();
        
        $brands = Brand::where(['status'=>'active'])
        ->orderBy('title', 'ASC')
        ->get();

        // $sort = '';
        // $sort = $request->sort;

        $products = Product::query();

        if(!empty($_GET['category'])) {
            $slugs =explode(',', $_GET['category']);
            $category_ids = Category::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            $products = $products->whereIn('category_id', $category_ids);

        }

        if(!empty($_GET['brand'])) {
            $slugs =explode(',', $_GET['brand']);
            $brand_ids = Brand::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            $products = $products->whereIn('brand_id', $brand_ids);
        }

        $size = $request->size;

        if(!empty($_GET['size'])) {
            $products = $products->whereIn('size', [$size]);
        } 

        if(!empty($_GET['sortBy'])) {   
            if($_GET['sortBy'] == 'default')  {
                $products = $products->where(['status'=>'active'])->paginate(12);
            }
            if($_GET['sortBy'] == 'priceAsc') {
                $products = $products->where(['status'=>'active'])->orderBy('price', 'ASC')->paginate(12);
            }
            if($_GET['sortBy'] == 'priceDesc') {
                $products = $products->where(['status'=>'active'])->orderBy('price', 'DESC')->paginate(12);
            }
            if($_GET['sortBy'] == 'titleAsc') {
                $products = $products->where(['status'=>'active'])->orderBy('title', 'ASC')->paginate(12);
            }
            if($_GET['sortBy'] == 'titleDesc') {
                $products = $products->where(['status'=>'active'])->orderBy('title', 'DESC')->paginate(12);
            }
            if($_GET['sortBy'] == 'discAsc') {
                $products = $products->where(['status'=>'active'])->orderBy('offer_price', 'ASC')->paginate(12);
            }
            if($_GET['sortBy'] == 'discDesc') {
                $products = $products->where(['status'=>'active'])->orderBy('offer_price', 'DESC')->paginate(12);
            }
        }
        else {
            $products = $products->where(['status'=>'active'])->paginate(12);
        }

        
        return view('frontEnd.productAll', compact(['categories', 'brands', 'products']));
    }

    public function productsFilter(Request $request)
    {
        $data = $request->all();
        //Category filter
        $catUrl = '';
        if(!empty($data['category'])) {
            foreach($data['category'] as $category) {
                if(empty($catUrl)) {
                    $catUrl .='&category='.$category;      
                } else {
                    $catUrl .=','.$category;   
                }
            }
        }

        //Brand filter
        $brandUrl = '';
        if(!empty($data['brand'])) {
            foreach($data['brand'] as $brand) {
                if(empty($brandUrl)) {
                    $brandUrl .='&brand='.$brand;
                } else {
                    $brandUrl .=','.$brand;
                }
            }
        }
        
        //Size filter
        $sizeUrl = '';
        if(!empty($data['size'])) {     
            $sizeUrl .='&size='.$data['size'];        
        }

        //Sort filter
        $sortByUrl = '';
        if(!empty($data['sortBy'])) {

            $sortByUrl .='&sortBy='.$data['sortBy'];
        }

        return redirect()->route('showAllProducts', $catUrl.$brandUrl.$sizeUrl.$sortByUrl);
    }



    public function autoSearch(Request $request)
    {
        $query = $request->get('term', '');
        $products = Product::where('title', 'LIKE', '%'.$query.'%')->get();

        $data = array();
        foreach($products as $product) {
            $data[] = array('value' => $product->title, 'id' => $product->id);
        }

        if(count($data)) {
            return $data;
        } else {
            return['value' => "No Result Found", 'id' => ''];
        }

    }

    public function searchResults(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = Product::where('title', 'LIKE', '%'.$keyword.'%')->orderBy('id', 'DESC')->paginate(12);
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $brands = Brand::where(['status'=>'active'])->orderBy('title', 'ASC')->get();

        return view('frontEnd.searchProducts', compact(['categories', 'brands', 'products', 'keyword']));

    }



    public function showNewProducts(Request $request)
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $brands = Brand::where(['status'=>'active'])->orderBy('title', 'ASC')->get();

   
        $sort = $request->sort;
      

        if($sort == 'priceAsc') {
            $new_products = Product::where(['status'=>'active', 'conditions'=>'new'])->orderBy('price', 'ASC')->paginate(12);
        }
        elseif($sort == 'priceDesc') {
            $new_products = Product::where(['status'=>'active', 'conditions'=>'new'])->orderBy('price', 'DESC')->paginate(12);
        }
        elseif($sort == 'titleAsc') {
            $new_products = Product::where(['status'=>'active', 'conditions'=>'new'])->orderBy('title', 'ASC')->paginate(12);
        }
        elseif($sort == 'titleDesc') {
            $new_products = Product::where(['status'=>'active', 'conditions'=>'new'])->orderBy('title', 'DESC')->paginate(12);
        }
        elseif($sort == 'discAsc') {
            $new_products = Product::where(['status'=>'active', 'conditions'=>'new'])->orderBy('offer_price', 'ASC')->paginate(12);
        }
        elseif($sort == 'discDesc') {
            $new_products = Product::where(['status'=>'active', 'conditions'=>'new'])->orderBy('offer_price', 'DESC')->paginate(12);
        }
        else {
            $new_products = Product::where(['status'=>'active', 'conditions'=>'new'])->paginate(12);
        }

     
        $route = 'newProducts';
        
        return view('frontEnd.new_products', compact(['categories', 'brands', 'new_products', 'route', 'sort']));

        
    }

    public function showPopularProducts(Request $request)
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $brands = Brand::where(['status'=>'active'])->orderBy('title', 'ASC')->get();

        $sort = $request->sort;

        if($sort == 'priceAsc') {
            $popular_products = Product::where(['status'=>'active', 'conditions'=>'popular'])->orderBy('price', 'ASC')->paginate(12);
        }
        elseif($sort == 'priceDesc') {
            $popular_products = Product::where(['status'=>'active', 'conditions'=>'popular'])->orderBy('price', 'DESC')->paginate(12);
        }
        elseif($sort == 'titleAsc') {
            $popular_products = Product::where(['status'=>'active', 'conditions'=>'popular'])->orderBy('title', 'ASC')->paginate(12);
        }
        elseif($sort == 'titleDesc') {
            $popular_products = Product::where(['status'=>'active', 'conditions'=>'popular'])->orderBy('title', 'DESC')->paginate(12);
        }
        elseif($sort == 'discAsc') {
            $popular_products = Product::where(['status'=>'active', 'conditions'=>'popular'])->orderBy('offer_price', 'ASC')->paginate(12);
        }
        elseif($sort == 'discDesc') {
            $popular_products = Product::where(['status'=>'active', 'conditions'=>'popular'])->orderBy('offer_price', 'DESC')->paginate(12);
        }
        else {
            $popular_products = Product::where(['status'=>'active', 'conditions'=>'popular'])->paginate(12);
        }

     
        $route = 'popularProducts';

        return view('frontEnd.popular_products', compact(['categories', 'brands', 'popular_products', 'route', 'sort']));
    }

    public function showSpecialProducts(Request $request)
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $brands = Brand::where(['status'=>'active'])->orderBy('title', 'ASC')->get();

        $sort = $request->sort;

        if($sort == 'priceAsc') {
            $special_products = Product::where(['status'=>'active', 'conditions'=>'special'])->orderBy('price', 'ASC')->paginate(12);
        }
        elseif($sort == 'priceDesc') {
            $special_products = Product::where(['status'=>'active', 'conditions'=>'special'])->orderBy('price', 'DESC')->paginate(12);
        }
        elseif($sort == 'titleAsc') {
            $special_products = Product::where(['status'=>'active', 'conditions'=>'special'])->orderBy('title', 'ASC')->paginate(12);
        }
        elseif($sort == 'titleDesc') {
            $special_products = Product::where(['status'=>'active', 'conditions'=>'special'])->orderBy('title', 'DESC')->paginate(12);
        }
        elseif($sort == 'discAsc') {
            $special_products = Product::where(['status'=>'active', 'conditions'=>'special'])->orderBy('offer_price', 'ASC')->paginate(12);
        }
        elseif($sort == 'discDesc') {
            $special_products = Product::where(['status'=>'active', 'conditions'=>'special'])->orderBy('offer_price', 'DESC')->paginate(12);
        }
        else {
            $special_products = Product::where(['status'=>'active', 'conditions'=>'special'])->paginate(12);
        }

     
        $route = 'specialProducts';

        return view('frontEnd.special_products', compact(['categories', 'brands', 'special_products', 'route', 'sort']));
    }

    public function showProductCategory(Request $request, $slug)
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $brands = Brand::where(['status'=>'active'])->orderBy('title', 'ASC')->get();
        
        $category = Category::with('products')->where('slug', $slug)->first();
        $sort = '';

        if($request->sort != null) {
            $sort = $request->sort;
        }
        if($category==null) {
            return view('error.404');
        }
        else {
            if($sort == 'priceAsc') {
                $products = Product::where(['status'=>'active', 'category_id'=>$category->id])->orderBy('price', 'ASC')->paginate(12);
            }
            elseif($sort == 'priceDesc') {
                $products = Product::where(['status'=>'active', 'category_id'=>$category->id])->orderBy('price', 'DESC')->paginate(12);
            }
            elseif($sort == 'titleAsc') {
                $products = Product::where(['status'=>'active', 'category_id'=>$category->id])->orderBy('title', 'ASC')->paginate(12);
            }
            elseif($sort == 'titleDesc') {
                $products = Product::where(['status'=>'active', 'category_id'=>$category->id])->orderBy('title', 'DESC')->paginate(12);
            }
            elseif($sort == 'discAsc') {
                $products = Product::where(['status'=>'active', 'category_id'=>$category->id])->orderBy('offer_price', 'ASC')->paginate(12);
            }
            elseif($sort == 'discDesc') {
                $products = Product::where(['status'=>'active', 'category_id'=>$category->id])->orderBy('offer_price', 'DESC')->paginate(12);
            }
            else {
                $products = Product::where(['status'=>'active', 'category_id'=>$category->id])->paginate(12);
            }
        }
     
        $route = 'products/category';
        
        // if($request->ajax()) {
        //     $view = view('frontEnd.layouts.loadingProducts', compact('products'))->render();
        //     return response()->json(['html'=>$view]);
        // }

        return view('frontEnd.productCategory', compact(['categories', 'category', 'brands', 'route', 'products', 'sort']));
    }

    public function showProductDetail($slug)
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->get();
        $product = Product::where('slug', $slug)->first();
        $product_attr = ProductAttribute::where('product_id', $product->id)->get();
        $product_review= ProductReview::where('product_id', $product->id)->paginate(5);
        $avg_review = ProductReview::where('product_id', $product->id)->avg('rate');
        $conv_avgReview = (int)$avg_review;
       
        if($product) {
            return view('frontEnd.productDetail', compact(['categories','product', 'product_attr', 'product_review', 'conv_avgReview']));
        } else {
            return 'Product detail not found';
        }
    }

    public function showAboutUs()
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $aboutUs = AboutUs::get();
        return view('frontEnd.aboutUs', compact('categories', 'aboutUs'));
    }

    public function showContactUs()
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        return view('frontEnd.contactUs', compact('categories'));
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'full_name' => 'string|required',
            'email' => 'string|required',
            'subject' => 'min:4|string|required',
            'message' => 'string|nullable|max:200|required',
        ]);

        $data = $request->all();

        Mail::to('earthshop.smtp@gmail.com')->send(new Contact($data));

        return back()->with('success', 'Successfull send your enquiry.');
        
    }


   //Test
    public function error404()
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        return view('error.500', compact('categories'));
    }
  
    public function test()
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        return view('frontEnd.aboutUs', compact('categories'));
    }

}
