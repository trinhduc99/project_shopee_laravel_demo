<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Session; // su dung session
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\FuncCall;

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id= session()->get('admin_id');
        if($admin_id){
            return redirect('dashboard');
        }
        else{
            return redirect('admin')->send();
        }
    }

    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $admin_email= $request->admin_email;
        $admin_password= md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($result){
            $request->session()->put('admin_name', $result->admin_name);
            $request->session()->put('admin_id', $result->admin_id);
        return redirect('/dashboard');
        }
        else
        {
            $request->session()->put('message','Mật khẩu hoặc tài khoản bị sai xin mời nhập lại' );
            return redirect('/admin');
        }
    }
    public function logout(){
        $this->AuthLogin();
        session()->put('admin_name',null);
        session()->put('admin_id', null);
        return redirect('/admin');
    }
}
