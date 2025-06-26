<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manual;
use Illuminate\Support\Facades\Storage;

class ManualController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $manuals = Manual::when($query, function ($q) use ($query) {
            return $q->where('machine_name', 'like', "%$query%");
        })->get();

        return view('manuals.index', compact('manuals', 'query'));
    }



    public function create()
    {
        return view('manuals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'machine_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pdf_file' => 'required|mimes:pdf|max:2048',
        ]);

        $filePath = $request->file('pdf_file')->store('manuals', 'public');

        Manual::create([
            'machine_name' => $request->machine_name,
            'description' => $request->description,
            'pdf_path' => $filePath,
        ]);

        return redirect()->route('manuals.index')->with('success', 'Manual uploaded successfully!');
    }

    public function show(Manual $manual)
    {
        return view('manuals.show', compact('manual'));
    }

    public function destroy(Manual $manual)
    {
        Storage::disk('public')->delete($manual->pdf_path);
        $manual->delete();

        return redirect()->route('manuals.index')->with('success', 'Manual deleted successfully!');
    }

    public function edit(Manual $manual)
    {
        return view('manuals.edit', compact('manual'));
    }

    public function update(Request $request, Manual $manual)
    {
        $request->validate([
            'machine_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pdf_file' => 'nullable|mimes:pdf|max:2048', // Optional PDF update
        ]);

        // Update fields
        $manual->machine_name = $request->machine_name;
        $manual->description = $request->description;

        // If a new PDF is uploaded, replace the old one
        if ($request->hasFile('pdf_file')) {
            // Delete old file
            Storage::disk('public')->delete($manual->pdf_path);

            // Store new file
            $filePath = $request->file('pdf_file')->store('manuals', 'public');
            $manual->pdf_path = $filePath;
        }

        $manual->save();

        return redirect()->route('manuals.index')->with('success', 'Manual updated successfully!');
    }
}
