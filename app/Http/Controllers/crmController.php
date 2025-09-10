<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Categories;

class crmController extends Controller
{
    public function index(){
        $contacts = Contact::all();

        return view('emails.crm.index', compact(['contacts']));
    }

    public function create(){
        return view('emails.crm.createCrm');
    }

    public function store(Request $request){
        try{
            Contact::insert([
            'name' => $request->name,
            'company' => $request->company,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'website' => $request->website,
            'notes' => $request->notes,
        ]);
        return redirect()->route('crm.index')->with('success', 'Berhasil menambahkan kontak baru');
        }catch(\Exception){
            return redirect()->route('crm.index')->with('error', 'Terjadi Kesalahan');
        }
    }

    public function edit($id){
        $contact = Contact::findOrFail($id);        
        return view('emails.crm.editCrm', compact(['contact']));
    }

    public function update(Request $request){
        try{
            $contact = Contact::findOrFail($request->id);
            $contact->update([
                'name' => $request->name,
                'company' => $request->company,
                'email' => $request->email,
                'address' => $request->address,
                'notes' => $request->notes,
                'phone' => $request->phone,
                'website' => $request->website,
            ]);
            return redirect()->route('crm.index')->with('success', 'Contact Successfully updated');
        }catch(\Exception){
            return redirect()->route('crm.index')->with('error', 'Something went wrong');
        }
    }


    public function destroy($id){
        try{
            $contact = Contact::findOrFail($id);
            $contact->delete();
            return redirect()->route('crm.index')->with('success', 'Contact Successfuly Deleted');
        }catch(\Exception){
            return redirect()->route('crm.index')->with('error', 'Something went Wrong');
        }
    }

    public function write(){
        return view('emails.crm.createEmailCrm');
    }
   
    public function store_mail(Request $request){        
        $email = (object)[
            'subject' => $request->subject,
            'body' => $request->body
        ];
        if($request->picture){
            $picturePath = $request->file('picture')->store('email_images', 'public');
        }else {
            $picturePath = null;
        }
        $email = EmailHistory::create([
            'sent_by' => Auth::user()->id,
            'subject' => $email->subject,
            'body' => $email->body,
            'status' => 'Pending',
            'category' => 'crm',
            'image_url' => $picturePath
        ]);                    
        return redirect()->route('emails.penerima', $email->id);
    }

     public function recipients($id){
        $contacts = Contact::all();
        $email_id = $id;
        return view('emails.crm.recipients', compact(['contacts', 'email_id']));
    }

}
