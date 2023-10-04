<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    //
    public function getContactList()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        return view('admin.contacts.admin-contact', compact('contacts'));
    }
    public function search(Request $request)
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        $search = $request->input('search');
        if ($search) {
            $results = Contact::where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone_number', 'like', '%' . $search . '%')
                ->get();
        } else {
            $results = [];
        }
        return view('admin.contacts.admin-contact', compact('contacts', 'results', 'search'));
    }
    public function getDetailContact($id)
    {
        $contact = Contact::where('id', $id)->get();
        return view('admin.contacts.admin-detail-contact', array('contact' => $contact));
    }
    public function deleteContact($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return redirect()->route('admin.ContactList')->with('success', 'Không tìm thấy liên hệ.');
        }

        $contact->delete();

        return redirect()->route('admin.ContactList')->with('success', 'Bạn đã xóa thành công!');
    }
}
