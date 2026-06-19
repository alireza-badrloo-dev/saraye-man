<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
   // لیست تمام پیام‌ها با فیلتر
    public function index(Request $request)
    {
        $query = Contact::orderBy('created_at', 'desc');
        
        // فیلتر بر اساس وضعیت
        if ($request->has('status')) {
            if ($request->status == 'unread') {
                $query->where('is_read', false);
            } elseif ($request->status == 'read') {
                $query->where('is_read', true);
            }
        }
        
        $contacts = $query->paginate(20);
        
        // حفظ فیلتر در صفحه‌بندی
        $contacts->appends($request->all());
        
        return view('admin.contact', compact('contacts'));
    }

    // نمایش جزئیات پیام
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }
        
        return view('admin.showContact', compact('contact'));
    }

    // حذف پیام
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return back()->with('success', 'پیام با موفقیت حذف شد.');
    }

    // تغییر وضعیت خوانده/نخوانده
    public function toggleRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => !$contact->is_read]);
          

        return back()->with('success', 'وضعیت پیام تغییر کرد.');
    }
}
