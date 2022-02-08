<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Orders;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate fields.
        
        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        //     'price' => 'required',
        //     'qty' => 'required',
        // ]);

        Product::create($request->all());
        

        return redirect()->route('index-products')
            ->with('success', 'Product created successfully.');
    }

    public function order(Request $request)
    {
        $existingProduct = Product::where('id', $request->product_id)->first();
        $updatedQtyAfterDeduct = $existingProduct->qty - $request->qty;
        $existingProduct->update(['qty' => $updatedQtyAfterDeduct]);

        Orders::create([
            'customer_id' => 1,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'qty' => $request->qty,
            'image_url' => $request->image_url,
        ]);
        return $updatedQtyAfterDeduct;
    }
}
