<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
  
    public function index(Request $request)
    {
        $query = Contact::orderBy('created_at', 'desc');
        
       
        if ($request->has('status')) {
            if ($request->status == 'unread') {
                $query->where('is_read', false);
            } elseif ($request->status == 'read') {
                $query->where('is_read', true);
            }
        }
        
        $contacts = $query->paginate(20);
        
    
        $contacts->appends($request->all());
        
        return view('admin.contact', compact('contacts'));
    }

   
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }
        
        return view('admin.showContact', compact('contact'));
    }

    
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return back()->with('success', 'پیام با موفقیت حذف شد.');
    }

 
    public function toggleRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => !$contact->is_read]);
          

        return back()->with('success', 'وضعیت پیام تغییر کرد.');
    }
}
