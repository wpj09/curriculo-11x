<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Mail as MailRequest;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact()
    {
        $head = $this->seo->render(env('CLIENT_DATA_IMOB') . ' - Software e Consultorias',
            'Encontre o software para sua empresa',
            route('home.contact'),
            asset('home/assets/images/share.png'));

        return view('home.contact', [
            'head' => $head
        ]);
    }

    public function sendEmail(MailRequest $request)
    {

        $data = [
            'reply_name' => $request->name,
            'reply_email' => $request->email,
            'cell' => $request->cell,
            'message' => $request->message
        ];

        Mail::send(new Contact($data));

        return redirect()->route('home.sendEmailSuccess');
    }

    public function sendEmailSuccess()
    {
        return view('home.contact_success');
    }
}
