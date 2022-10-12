<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Exception;
use Stripe\OAuth;
use Stripe\Stripe;
use Stripe\StripeClient;
use App\Models\Instructor;


class StripeController extends Controller 
{
    private $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.api_keys.secret_key'));
        Stripe::setApiKey(config('stripe.api_keys.secret_key'));
    }

    public function index()
    {
        $nav = 'stripe';
		$instructor_id = Auth::guard('instructor')->id();
		$data['user'] = Instructor::where('id', $instructor_id)->first();
        $queryData = [
            'response_type' => 'code',
            'client_id' => config('stripe.client_id'),
            'scope' => 'read_write',
            'redirect_uri' => route('instructor-stripe-redirect')
        ];
        $connectUri = config('stripe.authorization_uri').'?'.http_build_query($queryData);
        $account = $data['user']->stripe_id;
        return view('instructor.stripe.index', compact('nav', 'connectUri'), $data);
    }



    public function redirect(Request $request)
    {
        $token = $this->getToken($request->code);
        if(!empty($token['error'])) {
            return redirect(route('instructor-stripe-connect'))->withErrors(['error' => $token['error']]);
        }
        $connectedAccountId = $token->stripe_user_id;
        $account = $this->getAccount($connectedAccountId);
        if(!empty($account['error'])) {
            return redirect(route('instructor-stripe-connect'))->withErrors(['error' => $token['error']]);
        }

        $nav = '';
		$instructor_id = Auth::guard('instructor')->id();
		$data['user'] = $instructor = Instructor::where('id', $instructor_id)->first();
        $instructor->stripe_id = $account['id'];
        $instructor->save();
        return view('instructor.stripe.connect', compact('nav', 'account'), $data);
    }

    private function getToken($code)
    {
        $token = null;
        try {
            $token = OAuth::token([
                'grant_type' => 'authorization_code',
                'code' => $code
            ]);
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function getAccount($connectedAccountId)
    {
        $account = null;
        try {
            $account = $this->stripe->accounts->retrieve(
                $connectedAccountId,
                []
            );
        } catch (Exception $e) {
            $account['error'] = $e->getMessage();
        }
        return $account;
    }

}
