<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class BillingController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();

        // Check if not owner
        if ($user->role !== "owner") {
            abort(404);
        }

        $company = $user->company;

        return view('billing.billing', [
            'expiration' => Carbon::createFromFormat('Y-m-d H:i:s', $company->subscription->expiration)->tz('Asia/Manila')->format('F j, Y g:i a'),
            'transactions' => $company->transactions()->where('complete', true)->get()
        ]);
    }

    public function extend(Request $request)
    {
        $user = $request->user();

        // Check if not owner
        if ($user->role !== "owner") {
            abort(404);
        }

        $company = $user->company;

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Your Product Name',
                        ],
                        'unit_amount' => 1000, // in cents
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('billing.success'),
            'cancel_url' => route('billing.cancel'),
        ]);

        Transaction::create([
            "company_id" => $company->id,
            "amount" => 1000, // in cents
            "checkout_session_id" => $session->id,
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $user = $request->user();

        // Check if not owner
        if ($user->role !== "owner") {
            abort(404);
        }

        $company = $user->company;

        $latestTransaction = $company->transactions->last();

        // Get checkout session
        $checkoutSessionId = $latestTransaction->checkout_session_id;

        // Check if complete
        if ($latestTransaction->complete) {
            return redirect()->route('billing')->with('error', 'Invalid!');
        }

        // Set your Stripe API key
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Retrieve the checkout session
            $session = Session::retrieve($checkoutSessionId);

            // Process the session data as needed
            // For example, you can check the session status
            if ($session->payment_status === 'paid') {
                // Mark as complete
                $transaction = Transaction::find($latestTransaction->id);
                $transaction->complete = true;
                $transaction->save();

                // Add 1 month in expiration
                $subscription = Subscription::find($company->subscription->id);
                $subscription->expiration = Carbon::parse($company->subscription->expiration)->addDays(30);
                $subscription->save();

                // Payment was successful
                return redirect()->route('billing')->with('success', 'Payment successfully!');
            } else {
                // Payment was not successful
                return 'Payment was not successful.';
            }
        } catch (\Exception $e) {
            // Handle any exceptions
            // return 'Error: ' . $e->getMessage();
            return "Something went wrong";
        }
    }

    public function cancel(Request $request)
    {
        return "Cancel";
    }
}
