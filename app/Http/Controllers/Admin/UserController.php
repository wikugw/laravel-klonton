<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use Session;
use App\Models\Store;
use App\Models\Cart;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['users'] = User::with('store')->get();
        return view('admin.users.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['user'] = User::findOrFail($id);
        return view('admin.users.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['user'] = User::findOrFail($id);
        return view('admin.users.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $params = $request->except('_token');

        if ($request->has('profile_photo') && $request->profile_photo != "undefined") {
            $profile_photo = $request->file('profile_photo');
            $extension = $profile_photo->getClientOriginalExtension();
            $filename = $params['name'] . time() . '.' . $extension;
            $profile_photo->storeAs('public/foto_user', $filename);
            $path_foto_user = 'storage/foto_user' . '/' . $filename;
            $params['profile_photo'] = $path_foto_user;
        }

        // return $params;
        $product = User::findOrFail($id);

        if ($product->update($params)) {
            Session::flash('success', 'User berhasil di update!');
        } else {
            Session::flash('error', 'Tidak dapat mengupdate User, coba ulangi');
        }

        return redirect()->route('users.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);

        $store = Store::where('user_id', $id)->first();
        if ($store) {
            $store->delete();
        }

        $carts = Cart::where('user_id', $id)->get();
        if ($carts) {
            foreach ($carts as $cart) {
                $cart->delete();
            }
        }

        if ($user->delete()) {
            Session::flash('success', 'User berhasil dihapus!');
        }
        return redirect()->back();
    }
}
