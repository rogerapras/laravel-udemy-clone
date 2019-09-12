<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ICourse;
use App\Repositories\Contracts\ICart;
use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    
    protected $courses;
    protected $carts;

    public function __construct(ICourse $courses, ICart $carts)
    {
        $this->courses = $courses;
        $this->carts = $carts;
    }
    
    public function buyNow($course)
    {
        $course = $this->courses->findByUuid($course);
        // empty current user's cart and move to wishlist
        $this->carts->emptyCart();
        
        // insert the current item in the shopping cart
        $this->carts->addToCart([
            'id' => $course->id,
            'price' => $course->price
        ]);

        return view('frontend.cart.CartCheckout');
    }
    
    
}
