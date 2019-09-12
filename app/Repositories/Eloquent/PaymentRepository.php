<?php

namespace App\Repositories\Eloquent;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Course;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\Period;
use App\Repositories\Contracts\IPayment;
use App\Repositories\Contracts\ICourse;
use App\Repositories\Contracts\ICart;

class PaymentRepository extends RepositoryAbstract implements IPayment
{
    
    protected $courses;
    protected $carts;
    
    public function __construct(ICourse $courses, ICart $carts)
    {
        $this->courses = $courses;
        $this->carts = $carts;
    }
    
    public function entity()
    {
        return Payment::class;
    }
    
    public function process(array $data, $gateway, $gateway_payment_id=null)
    {
        $payer = auth()->user();
        $referee = null;
        
        $courses = $this->courses->findWhereIn('id', $data['courses']);
        
        $cart = Cart::find($data['cart']);
        $organicPercent = config('site_settings.earning_organic_sales_percentage')/100;
        $promoPercent = config('site_settings.earning_promo_sales_percentage')/100;
        $affiliatePercent = config('site_settings.earning_affiliate_sales_percentage')/100;
        
        
        // insert payments for each course
        foreach($courses as $course){
            $author = $course->author;
            $cartItem = $cart->items()->where('product_id', $course->id)->first();
            
            $amount = $cartItem->purchase_price;
            if($cartItem->coupon_id){
                $coupon = Coupon::find($cartItem->coupon_id);
            } else {
                $coupon = null;
            }
            /**************** Calculate Earnings **********/
            if(!is_null($referee) && config('site_settings.site_enable_affiliate') == 1){
                $affiliateEarning = $amount*$affiliatePercent;
                $amountLeft = $amount - $affiliateEarning;
                if($cartItem->coupon_id && $coupon->sitewide == false){
                    $authorEarning = $amountLeft * $promoPercent;
                } else {
                    $authorEarning = $amountLeft * $organicPercent;
                }
            } else {
                $affiliateEarning = 0;
                if($cartItem->coupon_id && $coupon->sitewide == false){
                    $authorEarning = $amount * $promoPercent;
                } else {
                    $authorEarning = $amount * $organicPercent;
                }
            }
            
            /************** Insert Payments ***************/
            $payment = new Payment();
            $payment->course_id = $course->id;
            $payment->payer_id = $payer->id;
            
            if(!is_null($referee) && config('site_settings.site_enable_affiliate') == 1){
                $payment->referred_by = $referee->id;
            }
            $payment->payment_method = $gateway;
            $payment->amount = $amount;
            $payment->coupon_id = $cartItem->coupon_id;
            $payment->description = 'sale';
            $payment->author_earning = $authorEarning;
            $payment->affiliate_earning = $affiliateEarning;
            $payment->gateway_payment_id = $gateway_payment_id;
            $payment->refund_deadline = Carbon::now('UTC')->add('30 days');
            $payment->period_id = $this->get_current_period()->id;
            $payment->save();
            
            // enroll the student
            $course->students()->attach($payer->id);
            
            // insert transaction for author
            $transaction = $author->transactions()->create([
                'type' => 'credit',
                'description' => 'Sale',
                'long_description' => 'Sale of '. $course->title,
                'amount' => $payment->author_earning
            ]);
            
            $payment->transaction_id = $transaction->id;
            $payment->save();
            
            // insert transaction for affiliate if it exists
            // if(!is_null($referee) && config('site_settings.site_enable_affiliate') == 1){
            //     $transaction = $referee->transactions()->create([
            //         'type' => 'credit',
            //         'description' => 'Affiliate Program',
            //         'long_description' => 'Earnings from Affiliate promotion of "'. $course->title . '"',
            //         'amount' => $affiliateEarning
            //     ]);
            // }
            
            // if($gateway=='account-balance'){
            //     $buyer_transaction = $payer->transactions()->create([
            //         'type' => 'debit',
            //         'description' => 'Purchase',
            //         'long_description' => 'Purchase of '. $course->title . 'with account balance',
            //         'amount' => -$amount
            //     ]);
            // }
            
        }
        
        // empty the cart
        $cart->clear();
    }

    public function getReceiptData($payment_id)
    {
        $payment = Payment::with(['course', 'user', 'coupon'])->where('uuid', $payment_id)->first();
        return $payment;
    }
    
    protected function get_current_period()
    {
        //$d = Carbon::now('UTC')->add('30 days');
        $current_period = Period::where('start_time', '=', Carbon::now('UTC')->startOfMonth())->first();
        return $current_period;
    }
    
}









