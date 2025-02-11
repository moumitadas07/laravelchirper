<?php
namespace App\Http\Controllers;
use App\Http\Controllers\RedirectResponse;
use App\Models\Chirps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ChirpsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chirps=Chirps::all();
        //return response("Hello, World!");
        return view('chirps.index',compact('chirps'));
     
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'message'=>'required|string|max:255',
        ]);
        $request->user()->chirps()->create($validated);
        return redirect()->route('chirps.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(Chirps $chirps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirps $chirp)
    {
       // Gate::authorize('update', $chirp);
        return view('chirps.edit', [
            'chirp' => $chirp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirps $chirp)
    {
        //Gate::authorize('update', $chirp);
 
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $chirp->update($validated);
 
        return redirect()->route('chirps.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirps $chirp)
    {
        //
       // Gate::authorize('delete', $chirp);
 
        $chirp->delete();
 
        return redirect()->route('chirps.index');
    }
}
