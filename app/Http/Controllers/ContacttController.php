<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;
use App\Contact;

class ContacttController extends Controller
{
    public function getAllContacts()
    {
        
        $obj = new stdClass();
        $obj->status = "success";
        $obj->data = Contact::all();
        echo json_encode($obj);
    }

    public function create(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'contact_number' => 'required',
        ]);

        Contact::create($request->all());
        $obj = new stdClass();
        $obj->status = "success";
        echo json_encode($obj);
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'contact_number' => 'required',
        ]);

        DB::table('contacts')
              ->where('id', $request->id)
              ->update(['first_name' => $request->first_name,
              'last_name' => $request->last_name,
              'email' => $request->email,
              'contact_number' => $request->contact_number]);

        // $contact->update($request->all());
        $obj = new stdClass();
        $obj->status = "success";
        echo json_encode($obj);
    }

    public function delete(Request $request)
    {
        DB::table('contacts')->where('id', '=', $request->id)->delete();
        $obj = new stdClass();
        $obj->status = "success";
        echo json_encode($obj);
    }

}
