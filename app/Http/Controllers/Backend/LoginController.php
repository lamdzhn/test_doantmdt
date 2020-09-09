<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function auth(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        $messages = [
          'username.required' => 'Vui lòng nhập tên đăng nhập',
          'password.required' => 'Vui lòng nhập mật khẩu'
        ];

        $validates = validator($request->all(), $rules, $messages);
        if ($validates->fails()) {
            return redirect()->back()->withInput()->withErrors($validates);
        }

        if ($request->remember == 'on') {
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                if (Auth::user()->status != 0) {
                    return redirect('/backend/index');
                }
                else {
                    $errors = new MessageBag(['inactive_account' => 'Tài khoản này đã bị khóa, vui lòng liên hệ với quản lý']);
                    return redirect()->back()->withInput()->withErrors($errors);
                }
            }
            $errors = new MessageBag(['username_or_password_wrong' => 'Tên đăng nhập hoặc mật khẩu không đúng, vui lòng kiểm tra lại']);
            return redirect()->back()->withInput()->withErrors($errors);
        }

        if (!isset($request->remember)) {
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                if (Auth::user()->status != 0) {
                    return redirect('/backend/index');
                }
                else {
                    $errors = new MessageBag(['inactive_account' => 'Tài khoản này đã bị khóa, vui lòng liên hệ với bộ phận quản lý']);
                    return redirect()->back()->withInput()->withErrors($errors);
                }
            }
            $errors = new MessageBag(['username_or_password_wrong' => 'Tên đăng nhập hoặc mật khẩu không đúng, vui lòng kiểm tra lại']);
            return redirect()->back()->withInput()->withErrors($errors);

        }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
