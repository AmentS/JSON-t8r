<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Auth;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [

            'problem' => 'required|string',
            'description' => 'required|string'

        ]);

        $contact = new Contact(request(['problem', 'description']));
        $contact->user_id = Auth::id();
        $contact->save();

        return ['message' => 'Message sent successfully'];

    }

    public function index()
    {
        //ako zelimo neke filtere ne mozemo a stavimo all()
        return Contact::with('user')->get();
    }

}
