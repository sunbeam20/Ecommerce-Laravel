<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): Response
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->noContent();
    }
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
         if (Auth::guard('web')->attempt($credentials)) {
             $userId = Auth::id();
        //     $recommend = Cart::with('product')->where('user_id', $userId)->limit(6)->get();
        //     if ($recommend->count() < 18) {
        //         $orders = Order::with('product')
        //             ->where('user_id', $userId)
        //             ->limit(6)
        //             ->get();
        //         $recommend = $recommend->merge($orders);
        //     }
        // View::share('recommend', $recommend);
        //     return redirect('/home');
        // }
        return view('home');}
    }
    /**
     * Destroy an authenticated session.
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function logoutAndRedirect()
    {
        Auth::logout();
        return redirect('/SellerLogin');
    }


    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
