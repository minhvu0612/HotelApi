<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminCtrl extends Controller
{
    public function Create(Request $request)
    {
        // Xác thực yêu cầu tạo là từ admin
        if (Admin::where('email', '=', $request->admin_email)->exists() && 
            Admin::where('name', '=', $request->admin_name)->exists()) {
            // Kiểm tra tài khoản admin đã tồn tại chưa
            if (Admin::where('email', '=', $request->email)->exists() || 
                Admin::where('name', '=', $request->name)->exists()) {
                // Gửi thông báo tài khoản đã tồn tại
                return response()->json([
                    'alert' => "Existed",
                ]);
            }
            // Nếu chưa tồn tại thì tạo tài khoản mới
            $admin = new Admin();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = md5($request->password);
            $admin->save();
            // Trả về phản hồi từ server
            return response()->json([
                'alert' => "Successfully",
                'data' => $admin,
            ]);
        }
        
        // Gửi thông báo lỗi không thể tạo (Không cấp quyền)
        return response()->json([
            'alert' => "No authorization",
        ]);
    }

    public function Get(Request $request){
        // Lấy tài khoản từ thông tin đăng nhập
        $admin = Admin::where('email', '=', $request->admin_email)->where('password', '=', md5($request->admin_pass))->first();
        if ($admin == null){
            return response()->json([
                'alert' => "Email or password was failed",
            ]);
        }
        else{
            return response()->json([
                'alert' => "Login successfully",
                'data' => $admin,
            ]);
        }
    }
}
