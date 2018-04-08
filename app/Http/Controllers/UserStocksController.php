<?php

namespace App\Http\Controllers;

use App\UserStocks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStocksController extends Controller
{
    public function store(Request $request)
    {

        if (Auth::check()) {
            $logged_user = Auth::user();

            $input = [
                'user_id' => $logged_user->id,
                'stock_id' => $request->stock_id
            ];

            $user_stocks = new UserStocks();
            if ($user_stocks->validate($input)) {
                UserStocks::create($input);
                return redirect()->back()->with('status_message', 'Subscription done');
            } else {
                return redirect()->back()->with('status_message', $user_stocks->errors);
            }
        }
    }

    public function destroy(Request $request)
    {
        if (Auth::check()) {
            UserStocks::where('user_id', Auth::id())
                ->where('stock_id', $request->stock_id)
                ->delete();
            return redirect()->back()->with('status_message', 'Unsubscribe done');
        }
    }
}
