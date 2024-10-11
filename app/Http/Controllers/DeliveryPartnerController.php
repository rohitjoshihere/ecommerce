<?php

namespace App\Http\Controllers;

use App\DeliveryPartner;
use Illuminate\Http\Request;

class DeliveryPartnerController extends Controller
{
    public function index()
    {
        $deliveryPartners = DeliveryPartner::paginate(10);
        return view('backend.delivery.index', compact('deliveryPartners'));
    }
    // Display the form for creating a new delivery partner
    public function create()
    {
        return view('backend.delivery.create'); // Return the form view
    }

    // Store a new delivery partner in the database
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'vehicle_number' => 'required|string|max:50',
            'address' => 'nullable|string',
            'availability' => 'required|in:active,inactive',
        ]);
        // Create a new delivery partner

        DeliveryPartner::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'vehicle_number' => $request->vehicle_number,
            'address' => $request->address,
            'availability' => $request->availability,
        ]);

        // dd('helo');

        // Redirect or show a success message
        return redirect()->route('delivery-partners.index')->with('success', 'Delivery partner added successfully.');
    }

    public function edit($id)
    {
        $deliveryPartner = DeliveryPartner::findOrFail($id); // Find the delivery partner
        return view('backend.delivery.edit', compact('deliveryPartner')); // Return the edit view
    }

    // Update a delivery partner in the database
    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'vehicle_number' => 'required|string|max:50',
            'address' => 'nullable|string',
            'availability' => 'required|in:active,inactive',
        ]);

        // Find the delivery partner
        $deliveryPartner = DeliveryPartner::findOrFail($id);

        // Update the delivery partner details
        $deliveryPartner->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'vehicle_number' => $request->vehicle_number,
            'address' => $request->address,
            'availability' => $request->availability,
        ]);

        // Redirect or show a success message
        return redirect()->route('delivery-partners.index')->with('success', 'Delivery partner updated successfully.');
    }


    public function destroy($id)
    {
        $deliveryPartners = DeliveryPartner::findOrFail($id);
        $status = $deliveryPartners->delete();

        if ($status) {
            request()->session()->flash('success', 'Product deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting product');
        }
        return redirect()->route('delivery-partners.index');
    }
}
