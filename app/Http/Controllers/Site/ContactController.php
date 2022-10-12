<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ContactRequest;
use App\Models\Page;
use App\Models\Setting;
use App\Services\Site\ContactService;

class ContactController extends Controller
{
    protected $contact;

    public function __construct(ContactService $ContactService)
    {
        $this->contact = $ContactService;
    }

    public function index()
    {
        $nav = 'contact';
        $data['setting'] = Setting::first();
        return view('site.contact.index', compact('nav'), $data);
    }

    public function post(ContactRequest $request)
    {
        $nav = 'contact';
        $this->contact->sentEmail($request->validated());
        return redirect('contact')->with('message', 'Thank you for contacting. We will contact you asap!');
    }

}
