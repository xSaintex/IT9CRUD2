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
            'contacts' => Cont::latest()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:conts,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);
    
        if (!auth()->check()) {
            return redirect()->route('contacts.index')->with('error', 'You must be logged in to add a contact.');
        }
    
        Cont::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
    
        return redirect()->route('contacts.index')->with('success', 'Contact added successfully!');
    }
    
    
    public function edit(Cont $contact): View
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Cont $contact): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:conts,email,' . $contact->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        $contact->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully!');
    }

    public function destroy(Cont $contact): RedirectResponse
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully!');
    }
}
