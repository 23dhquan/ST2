<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Contact;
use App\Models\House;
use App\Models\HouseImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HouseHomeController extends Controller
{
    public function index()
    {
        $houses = House::where('is_rented', 0)->get();
        foreach ($houses as $house) {
            $houseImage = HouseImage::where('house_id', $house->house_id)->first();
            // Gán ảnh đại diện mặc định nếu không có ảnh
            $house->house_image = $houseImage ? $houseImage->image_path : '/assetsHome/images/default.jpg';


        }

        return view('home', compact('houses'));
    }
    public function house()
    {
        $houses = House::where('is_rented', 0)->get();

        foreach ($houses as $house) {
            $houseImage = HouseImage::where('house_id', $house->house_id)->first();
            // Gán ảnh đại diện mặc định nếu không có ảnh
            $house->house_image = $houseImage ? $houseImage->image_path : '/assetsHome/images/default.jpg';
            $house->area_name = $house->getAreaName();
            $house->area_address = $house->getAreaAddress();


        }

        return view('house', compact('houses'));
    }
    public function contact()
    {
        return view('contact');
    }

    public function storeContact(Request $request)
    {
        Contact::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'title' => $request->input('title'),
            'message' => $request->input('message'),
        ]);

        return redirect()->back()->with('success', 'Đã gửi thành công!');
    }



    public function show($house_id)
    {
        $house = House::with('images')->where('house_id', $house_id)->first();

        // Nếu không tìm thấy nhà -> 404
        if (!$house) {
            abort(404);
        }

        // Thông tin khu vực
        $house->area_name = $house->getAreaName();
        $house->area_address = $house->getAreaAddress();

        // Lấy thông tin chủ sở hữu một lần để tránh lặp truy vấn
        $owner = User::where('area_id', $house->area_id)->first();
        $house->user_name = $owner?->name;
        $house->user_note = $owner?->note;
        $house->user_avatar = $owner?->avatar;
        $house->user_email = $owner?->email;
        $house->user_phone = $owner?->phone;

        return view('house-detail', compact('house'));
    }

}
