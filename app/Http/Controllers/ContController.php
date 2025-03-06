<?php

namespace App\Http\Controllers;

use App\Models\Cont;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContController extends Controller
{
    public function index(): View
    {
        return view('contacts.index', [
            'contacts' => Cont::with('user')->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:conts,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);
    
        if (!auth()->check()) {
            return response()->json(['error' => 'You must be logged in to add a contact.'], 403);
        }
        $validated['user_id'] = $request->user()->id;
    
        $contact = Cont::create($validated);
    
        if ($request->headers->has('HX-Request')) {
            return view('partials.contacts_row', ['contact' => $contact]);
        }
    
        return redirect(route('contacts.index'))->with('success', 'Contact created successfully!');
    }
    
    public function edit(Cont $contact): View
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $contact = Cont::findOrFail($id);
        $contact->update($request->all());
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:conts,email,' . $contact->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);
    
        $contact->update($validated);
    
        return redirect()->route('contacts.index');
    }

    public function destroy(Cont $contact)
    {
        $contact->delete();
        return response('', 200);
    }
}
