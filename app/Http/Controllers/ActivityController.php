<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::all();
        return view('activities.index', compact('activities'));
    }

    public function show($id)
    {
        $activity = Activity::findOrFail($id);

        $otherActivities = Activity::where('museum', $activity->museum)
            ->where('id', '!=', $id)
            ->get();

        $relatedActivities = Activity::where('museum', $activity->museum)
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->take(3)
            ->get();
        
        if ($relatedActivities->isEmpty()) {
            $relatedActivities = Activity::where('id', '!=', $id)
                ->inRandomOrder()
                ->take(3)
                ->get();
        }

        $testimonials = $activity->testimonials ?? [];
        $previousImages = $activity->previous_images ?? [];

        return view('activities.show', compact(
            'activity', 'otherActivities', 'relatedActivities', 'testimonials', 'previousImages'
        ));
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'museum' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'required|date',
            'time' => 'required|string',
            'location' => 'required|string',
            'ticket_price' => 'required|string',
            'contact' => 'required|string',
            'registration_link' => 'required|url',
        ]);

        $activity = new Activity();
        $activity->title = $validated['title'];
        $activity->museum = $validated['museum'];

        if ($request->hasFile('image')) {
            $activity->image = $request->file('image')->store('images', 'public');
        }

        $activity->date = $validated['date'];
        $activity->time = $validated['time'];
        $activity->location = $validated['location'];
        $activity->ticket_price = $validated['ticket_price'];
        $activity->contact = $validated['contact'];
        $activity->registration_link = $validated['registration_link'];
        $activity->save();

        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $activity = Activity::findOrFail($id);
        return view('activities.edit', compact('activity'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'museum' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'required|date',
            'time' => 'required|string',
            'location' => 'required|string',
            'ticket_price' => 'required|string',
            'contact' => 'required|string',
            'registration_link' => 'required|url',
        ]);

        $activity = Activity::findOrFail($id);
        $activity->title = $validated['title'];
        $activity->museum = $validated['museum'];

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($activity->image && \Storage::disk('public')->exists($activity->image)) {
                \Storage::disk('public')->delete($activity->image);
            }
            $activity->image = $request->file('image')->store('images', 'public');
        }

        $activity->date = $validated['date'];
        $activity->time = $validated['time'];
        $activity->location = $validated['location'];
        $activity->ticket_price = $validated['ticket_price'];
        $activity->contact = $validated['contact'];
        $activity->registration_link = $validated['registration_link'];
        $activity->save();

        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);

        if ($activity->image && \Storage::disk('public')->exists($activity->image)) {
            \Storage::disk('public')->delete($activity->image);
        }

        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil dihapus');
    }
}
