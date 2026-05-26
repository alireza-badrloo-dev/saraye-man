<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Morilog\Jalali\Jalalian;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Admin::query();
        // در متد index کنترلر AdminController
        $totalAdmins = Admin::count();
        $activeAdmins = Admin::where('status', 'active')->count();
        $blockedAdmins = Admin::where('status', 'blocked')->count();
        $superAdmins = Admin::where('role', 'super_admin')->count();

       
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $admins = $query->orderBy('created_at', 'desc')->paginate(10);

        $totalAdmins = Admin::count();
        $activeAdmins = Admin::where('status', 'active')->count();
        $superAdmins = Admin::where('role', 'super_admin')->count();

         return view('admin.admins', compact('admins', 'totalAdmins', 'activeAdmins', 'blockedAdmins', 'superAdmins'));
    }

    public function create()
    {
        return view('admin.createAdmin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'mobile' => 'nullable|string|max:20',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:super_admin,admin,moderator',
            'gender' => 'nullable|in:male,female',
            'national_code' => 'nullable|string|max:20',
            'birth_date' => 'nullable|string',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive,blocked',
        ]);

        $admin = new Admin();
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        $admin->password = Hash::make($request->password);
        $admin->role = $request->role;
        $admin->gender = $request->gender;
        $admin->national_code = $request->national_code;
        $admin->birth_date = $request->birth_date ? Jalalian::fromFormat('Y/m/d', $request->birth_date)->toCarbon() : null;
        $admin->address = $request->address;
        $admin->status = $request->status;

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('admins', $filename, 'public');
            $admin->profile_image = $filename;
        }

        $admin->save();

        return redirect()->route('admin.admins')->with('success', 'ادمین با موفقیت اضافه شد');
    }

    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.showAdmin', compact('admin'));
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.editAdmin', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'mobile' => 'nullable|string|max:20',
            'role' => 'required|in:super_admin,admin,moderator',
            'gender' => 'nullable|in:male,female',
            'national_code' => 'nullable|string|max:20',
            'birth_date' => 'nullable|string',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive,blocked',
        ]);

        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        $admin->role = $request->role;
        $admin->gender = $request->gender;
        $admin->national_code = $request->national_code;
        $admin->birth_date = $request->birth_date ? Jalalian::fromFormat('Y/m/d', $request->birth_date)->toCarbon() : null;
        $admin->address = $request->address;
        $admin->status = $request->status;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('admins', $filename, 'public');
            $admin->profile_image = $filename;
        }

        $admin->save();

        return redirect()->route('admin.admins')->with('success', 'ادمین با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect()->back()->with('success', 'ادمین با موفقیت حذف شد');
    }

    public function toggleStatus($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->status = $admin->status == 'active' ? 'blocked' : 'active';
        $admin->save();
        return redirect()->back()->with('success', 'وضعیت ادمین تغییر کرد');
    }
}
