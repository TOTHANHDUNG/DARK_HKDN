<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Commet;
use App\Models\Slide;
use App\Models\Bill;
use App\Models\Bill_detail;
use App\Models\Customer;
use App\Models\User;
use App\Models\Cart;
use App\Models\NguoiDung;
use App\Login;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Session;

class PageController extends Controller
{
    //
    public function getIndex(){
        $products = Product::where('trangthai',1)->orderBy('id','desc')->paginate(8);
        return view('users.page.trangchu',compact('products'));
    }


    public function getChitiet(Request $req,$id){
        $sanpham = Product::where('id',$req->id)->first();
        $data=Commet::where('id_com',$id)->get();
        $sp_tuongtu = Product::where('idcat',$sanpham->idcat)->where('id', '<>', $sanpham->id)->paginate(6);
    	return view('users.page.chitiet_sanpham',compact('sanpham','sp_tuongtu','data'));
    }


    public function postComment(Request $request,$id)
    {
       $comment=new Commet;
       $comment->name=$request->name;
       $comment->email=$request->email;
       $comment->content=$request->content;
       $comment->id_com=$id;
       $comment->save();
       return back();
    }
    public function getLienHe(){
    	return view('users.page.lienhe');
    }

    public function getGioiThieu(){
    	return view('users.page.gioithieu');
    }

    public function getGioHang(){
        return view('users.page.giohang');
    }

    public function getAddtoCart(Request $req,$id){
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }


    public function getDelItemCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }
        return redirect()->back();
    }

    public function getCheckout(){
        return view('users.page.dat_hang');
    }



    public function postCheckout(Request $req){
        $cart = Session::get('cart');
        $customer = new Customer;
        $customer->name = $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone;
        $customer->note = $req->notes;
        $customer->save();

        $bill = new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment_method;
        $bill->note = $req->notes;
        $bill->save();

        foreach ($cart->items as $key => $value) {
            $bill_detail = new Bill_detail;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_products = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->price = ($value['price']/$value['qty']);
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('thongbao','Đặt hàng thành công');

    }

    public function getLogin(){
        return view('users.page.dangnhap');
    }
    public function getSignin(){
        return view('users.page.dangky');
    }

    public function getSearch(Request $request){
        $product=Product::where('name','like','%'.$request->key.'%')
       ->orWhere('price',$request->key)->get();
        return view('users.page.search',compact('product'));

    }

    public function postSignin(Request $req){
        $this->validate($req,
            [   'diachi'=>'required',
                'dienthoai'=>'required',
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'name'=>'required',
                're_password'=>'required|same:password'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng email',
                'password.required'=>'Vui lòng nhập mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự'
            ]);
        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        // $user->phone = $req->dienthoai;
        $user->diachi = $req->diachi;

        $user->save();
        return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');
    }

    public function postLogin(Request $request){
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'active'   => 1
        ];
        if (Auth::attempt($login)) {
            return redirect('/')->with('name');
        } else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }

    }
    public function postLogout(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }

    public function getDonHang()
    {
        $donhang =Customer::all();
        $hd=Bill_detail::all();
        return view('users.page.donhang',compact('donhang','hd'));
    }
}
