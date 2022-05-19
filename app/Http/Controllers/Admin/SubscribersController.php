<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    public function index()
    {
        $subs = Subscription::all();

        return view('admin.subs.index', compact('subs'));
    }

    public function create()
    {
        return view('admin.subs.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'email' => 'required|email|unique:subscriptions'
        ]);

        Subscription::add($request->get('email'));


        return redirect()->route('subscribers.index');
    }

    public function destroy($id)
    {
        Subscription::find($id)->delete();

        return redirect()->route('subscribers.index');
    }

}
