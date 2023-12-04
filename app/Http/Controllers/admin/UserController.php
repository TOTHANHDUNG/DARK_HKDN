<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;
class UserController extends Controller
{   public $viewprefix;
    public $viewnamespace;
    public function __construct()
    {   //$this->middleware('CheckAdminLogin');
        $this->viewprefix='admin.user.';
        $this->viewnamespace='panel/user';
    }
    public function index()
    {
        
    }
    public function getadd()
    {
        return view('admin.user.add'); 
    }
    public function postadd(request $request)
    {
    	  
    }
    public function getedit($id)
    {
        
    }
    public function postedit($id,request $request)
    {
        
    }
    public function delete($id)
    {
        
    }
}
