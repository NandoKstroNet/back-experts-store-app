<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Support\Facades\DB;

class FrontStoreController extends Controller
{
    public function __construct(private Product $product) {}

    public function home()
    {
        return $this->product->addSelect([
            'photo' => ProductPhoto::where('product_id', DB::raw('products.id'))
                ->select('photo')
                ->take(1)
        ])->orderBy('id', 'DESC')->get();
    }

    public function single(string $slug)
    {
        return $this->product->findOrFail($slug);
    }
}
