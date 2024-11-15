<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login()
    {
        return view('pages.login');
    }

    public function auth_login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Tìm người dùng trong cơ sở dữ liệu bằng email
        $user = User::where('Email', $email)->first();

        if ($user) {
            // Kiểm tra mật khẩu
            if (Hash::check($password, $user->PasswordHash)) {
                // Đăng nhập thành công
                Auth::login($user); // Đảm bảo $user là một instance của User

                // Lưu thông tin vào session
                $request->session()->put('UserId', $user->UserId);
                $request->session()->put('Email', $user->Email);
                $request->session()->put('Role', $user->Role);
                $request->session()->put('FullName', $user->FullName);
                $request->session()->put('PhoneNumber', $user->PhoneNumber);
                // Điều hướng dựa trên vai trò
                if ($user->Role === 'Customer') {
                    return redirect()->route('home');
                }
                if ($user->Role === 'Admin') {
                    return redirect()->route('home');
                }

            } else {
                return redirect()->back()->withErrors(['message' => 'Mật khẩu không đúng']);
            }
        } else {
            return redirect()->back()->withErrors(['message' => 'Không tìm thấy tài khoản với email này']);
        }
    }

    public function register(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,Email',
            'password' => 'required|min:6|confirmed',
            'fullname' => 'required|string|max:255', // Điều chỉnh rule cho fullname
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Tạo người dùng mới
        User::create([
            'Username' => $request->input('email'), // Hoặc dùng tên người dùng tùy chỉnh
            'Email' => $request->input('email'),
            'PasswordHash' => Hash::make($request->input('password')),
            'FullName' => $request->input('fullname'), // Đúng tên cột từ database
        ]);

        // Chuyển hướng sau khi đăng ký thành công
        return redirect()->route('login')->with('success', 'Đăng ký thành công!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush(); // Xóa tất cả session

        return redirect()->route('login'); // Chuyển hướng đến trang đăng nhập
    }

    public function all_users()
    {
        $all_users = User::all();

        return view('admin.all_users', [
            'all_users' => $all_users,
        ]);
    }

    public function edit_user($email)
    {
        // Tìm người dùng dựa trên email
        $user = User::where('Email', $email)->first();

        // Kiểm tra nếu người dùng không tồn tại
        if (! $user) {
            return redirect()->back()->withErrors(['message' => 'Người dùng không tồn tại']);
        }

        // Trả về view với thông tin người dùng
        return view('admin.edit_users', [
            'user' => $user,
        ]);
    }

    public function update_user(Request $request, $email)
    {
        // Lấy người dùng theo email
        $user = User::where('Email', $email)->first();

        // Kiểm tra nếu người dùng không tồn tại
        if (! $user) {
            return redirect()->back()->withErrors(['message' => 'Người dùng không tồn tại']);
        }

        // Cập nhật thông tin người dùng
        $user->Username = $request->input('username');
        $user->Email = $request->input('email');
        $user->FullName = $request->input('name');
        $user->PhoneNumber = $request->input('phoneNumber');
        $user->Address = $request->input('address');
        $user->Role = $request->input('role');

        // Kiểm tra xem mật khẩu có thay đổi không
        $newPassword = $request->input('password');
        if ($newPassword && ! Hash::check($newPassword, $user->PasswordHash)) {
            $user->PasswordHash = Hash::make($newPassword);
        }

        // Lưu người dùng
        $user->save();

        return redirect()->back()->with('message', 'Người dùng đã được chỉnh sửa thành công');
    }

    public function remove_user($email)
    {
        // Tìm người dùng theo email
        $user = User::where('Email', $email)->first();

        // Kiểm tra nếu người dùng không tồn tại
        if (! $user) {
            return redirect()->back()->withErrors(['message' => 'Người dùng không tồn tại']);
        }

        // Xóa người dùng
        $user->delete();

        return redirect()->route('admin.all_users')->with('message', 'Người dùng đã được xóa thành công');
    }

    public function add_user()
    {
        return view('admin.add_users');
    }

    public function save_add_user(Request $request)
    {
        // Kiểm tra nếu email đã tồn tại
        if (User::where('Email', $request->input('email'))->exists()) {
            return redirect()->back()->withErrors(['email' => 'Email này đã tồn tại.']);
        }

        // Tạo mới người dùng
        $user = new User;
        $user->Username = $request->input('username');
        $user->Email = $request->input('email');
        $user->PasswordHash = Hash::make($request->input('password'));
        $user->FullName = $request->input('name');
        $user->Address = $request->input('address');
        $user->PhoneNumber = $request->input('phoneNumber');
        $user->Role = $request->input('role');
        $user->save();

        // Chuyển hướng và thông báo thành công
        return redirect()->route('admin.all_users')->with('message', 'Người dùng đã được thêm thành công');
    }

    public function info_user($id)
    {
        $user = User::find($id);
        $cart = Cart::where('UserId', Auth::id())->first();
        $cartItems = $cart ? $cart->cartItems()->with('product')->get() : collect([]);

        return view('pages.user_info', [
            'user' => $user,
            'cartItems' => $cartItems,
        ]
        );
    }

    public function save_user_edit(Request $request)
    {
        // Tìm user dựa vào email
        $user = User::where('Email', $request->email)->first();

        // Kiểm tra nếu user tồn tại
        if ($user) {
            // Cập nhật các thông tin cần thiết
            $user->Username = $request->name;
            $user->PhoneNumber = $request->phone;
            $user->Address = $request->address;

            // Lưu thông tin user
            $user->save();

            // Điều hướng về trang trước với thông báo thành công
            return redirect()->back()->with('message', 'Cập nhật thành công');
        } else {
            // Trả về thông báo lỗi nếu không tìm thấy user
            return redirect()->back()->with('error', 'Không tìm thấy người dùng');
        }
    }
}
