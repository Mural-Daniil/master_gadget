<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(){

        $services=Service::all();
        return Inertia::render('Service/Services', [
            'services' => $services
        ]);
    }

    public function create(){
        return Inertia::render('Service/AddService'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'about' => 'required|string',
            'min_price' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        Service::create($request->all());

        return redirect()->back()->with('status', 'Service added!');
    }

    public function edit($id)
    {
        $service = Service::find($id);
        return Inertia::render('Service/Service', [
            'service' => $service
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'about' => 'required|string',
            'min_price' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $service = Service::findOrFail($id);
        $service->update($request->all());

        return redirect()->back()->with('status', 'Service updated!');
    }

    public function delete($id)
    {
        Service::find($id)->delete();
        return redirect()->route('services')->with('status', 'Service deleted!');
    }
}
