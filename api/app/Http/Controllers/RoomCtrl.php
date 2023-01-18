<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Room;

class RoomCtrl extends Controller
{
    public function Create(Request $request){
        // Xác thực yêu cầu tạo là từ admin
        if (Admin::where('email', '=', $request->admin_email)->exists() && 
            Admin::where('name', '=', $request->admin_name)->exists()) {
            // Kiểm tra loại phòng đã tồn tại chưa
            if (Room::where('name', '=', $request->name)->exists()) {
                // Gửi thông báo phòng đã tồn tại
                return response()->json([
                    'alert' => "Existed",
                ]);
            }
            // Nếu chưa tồn tại thì tạo phòng mới
            $room = new Room();
            $room->name = $request->name;
            $room->view = $request->view;
            $room->size = $request->size;
            $room->bedroom = $request->bedroom;
            $room->type_bedroom = $request->type_bedroom;
            $room->occupancy = $request->occupancy;
            $room->bathtub = $request->bathtub;
            $room->des = $request->des;
            $room->introduce = $request->introduce;
            $room->src = $request->src;
            $room->save();
            // Trả về phản hồi từ server
            return response()->json([
                'alert' => "Successfully",
                'data' => $room,
            ]);
        }
        
        // Gửi thông báo lỗi không thể tạo (Không cấp quyền)
        return response()->json([
            'alert' => "No authorization",
        ]);
    }

    public function Get(){
        $rooms = Room::all();
        return response()->json([
            'data' => $rooms,
        ]);
    }
}
