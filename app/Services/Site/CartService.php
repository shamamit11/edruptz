<?php
namespace App\Services\Site;

use App\Models\Cart;
use App\Models\CartCourse;
use App\Models\Commission;
use App\Models\Course;
use App\Models\TempCart;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe\Charge;
use Stripe\Stripe;

$session_id = Session::getID();
class CartService
{

    function list() {
        $session_id = Session::getID();
        $data['carts'] = TempCart::with('course')->where('session_id', $session_id)->get();
        return $data;
    }

    public function cartAdd($request)
    {
        $session_id = Session::getID();
        $course_id = $request['course_id'];
        $course = Course::where('id', $course_id)->first();
        if (!$course) {
            redirect(route('/'));
        }
        $cart = TempCart::where('course_id', $course_id)->where('session_id', $session_id)->first();
        if ($cart) {
            $message = "Data updated";
        } else {
            $cart = new TempCart;
            $message = "Data added";
        }
        $cart->session_id = $session_id;
        $cart->course_id = $course_id;
        $cart->amount = $course->amount;
        $cart->save();
        return $message;
    }

    public function delete($id)
    {
        TempCart::where('id', $id)->delete();
        $message = "Data deleted";
        return $message;
    }

    public function stripePost($request)
    {
        try {
            $session_id = Session::getID();
            $total_amount = TempCart::where('session_id', $session_id)->sum('amount');
            Stripe::setApiKey(env('STRIPE_SECRET'));
            Charge::create([
                "amount" => $total_amount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment from Edruptz.com.",
            ]);

            $temp_carts = TempCart::with('course')->with('course.instructor')->where('session_id', $session_id)->get();
            $commission = Commission::first();
            if ($temp_carts->count() > 0) {
                $cart = new Cart;
                $cart->student_id = Auth::guard('student')->id();
                $cart->save();
                foreach ($temp_carts as $temp_cart) {
                    if ($temp_cart->course->instructor->admin_set == 1) {
                        $commission = $temp_cart->course->instructor->commission;
                    } else {
                        $commission = $temp_cart->course->instructor->commission;
                    }
                    $cart_course = new CartCourse;
                    $cart_course->cart_id = $cart->id;
                    $cart_course->course_id = $temp_cart->course_id;
                    $cart_course->amount = $temp_cart->amount;
                    $cart_course->admin_commission = round(($temp_cart->amount * ($commission / 100)), 0);
                    $cart_course->save();
                }
                TempCart::where('session_id', $session_id)->delete();
            }

            $message = "Payment successful!";
            return redirect()->route('cart-success')->withMessage($message);
        } catch (\Stripe\Error\Card$e) {
            $message = "Card declined";
            return redirect()->back()->withErrors(['error' => $message]);
        } catch (\Stripe\Error\InvalidRequest$e) {
            $message = "Invalid parameters were supplied to Stripe's API";
            return redirect()->back()->witherrors(['error' => $message]);
        } catch (\Stripe\Error\Authentication$e) {
            $message = "Authentication with Stripe's API failed";
            return redirect()->back()->witherrors(['error' => $message]);
        } catch (\Stripe\Error\ApiConnection$e) {
            $message = "Network communication with Stripe failed";
            return redirect()->back()->witherrors(['error' => $message]);
        } catch (\Stripe\Error\Base$e) {
            $message = "Display a very generic error to the user";
            return redirect()->back()->witherrors(['error' => $message]);
        } catch (Exception $e) {
            $message = "Something else happened, completely unrelated to Stripe";
            return redirect()->back()->witherrors(['error' => $message]);
        }
    }

}
