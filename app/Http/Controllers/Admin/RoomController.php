<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = RoomBooking::orderBy('created_at', 'desc')->get();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $roomTypes = [
            'Suite Room',
            'Deluxe Room', 
            'Superior Room',
            'Standard Room'
        ];
        
        return view('admin.rooms.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_booking_name' => 'required|string|max:255',
            'room_booking_type' => 'required|string|max:100',
            'room_booking_price' => 'required|numeric|min:0',
            'room_booking_capacity' => 'required|string|max:50',
            'room_booking_facility' => 'required|string',
            'room_booking_rules' => 'required|string',
            'room_booking_amount' => 'required|integer|min:1',
            'room_booking_number' => 'required|string',
            'room_booking_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate room_booking_id
        $roomType = strtoupper(Str::slug(explode(' ', $request->room_booking_type)[0]));
        $count = RoomBooking::where('room_booking_type', $request->room_booking_type)->count() + 1;
        $roomId = 'room_booking_' . $count;

        // Handle image upload
        if ($request->hasFile('room_booking_image')) {
            $image = $request->file('room_booking_image');
            $imageName = Str::slug($request->room_booking_name) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('rooms', $imageName, 'public');
        }

        // Create room
        $room = RoomBooking::create([
            'room_booking_id' => $roomId,
            'room_booking_name' => $request->room_booking_name,
            'room_booking_type' => $request->room_booking_type,
            'room_booking_price' => $request->room_booking_price,
            'room_booking_capacity' => $request->room_booking_capacity,
            'room_booking_facility' => $request->room_booking_facility,
            'room_booking_rules' => $request->room_booking_rules,
            'room_booking_amount' => $request->room_booking_amount,
            'room_booking_number' => $request->room_booking_number,
            'room_booking_image' => $imagePath ?? 'default-room.jpg',
            'room_booking_status' => 'Ready',
        ]);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Kamar berhasil ditambahkan');
    }

    public function edit($id)
    {
        $room = RoomBooking::findOrFail($id);
        $roomTypes = [
            'Suite Room',
            'Deluxe Room',
            'Superior Room', 
            'Standard Room'
        ];
        
        return view('admin.rooms.edit', compact('room', 'roomTypes'));
    }

    public function update(Request $request, $id)
    {
        $room = RoomBooking::findOrFail($id);

        $request->validate([
            'room_booking_name' => 'required|string|max:255',
            'room_booking_type' => 'required|string|max:100',
            'room_booking_price' => 'required|numeric|min:0',
            'room_booking_capacity' => 'required|string|max:50',
            'room_booking_facility' => 'required|string',
            'room_booking_rules' => 'required|string',
            'room_booking_amount' => 'required|integer|min:1',
            'room_booking_number' => 'required|string',
            'room_booking_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('room_booking_image')) {
            // Delete old image if exists
            if ($room->room_booking_image && $room->room_booking_image !== 'default-room.jpg') {
                Storage::disk('public')->delete($room->room_booking_image);
            }
            
            $image = $request->file('room_booking_image');
            $imageName = Str::slug($request->room_booking_name) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('rooms', $imageName, 'public');
        }

        $room->update([
            'room_booking_name' => $request->room_booking_name,
            'room_booking_type' => $request->room_booking_type,
            'room_booking_price' => $request->room_booking_price,
            'room_booking_capacity' => $request->room_booking_capacity,
            'room_booking_facility' => $request->room_booking_facility,
            'room_booking_rules' => $request->room_booking_rules,
            'room_booking_amount' => $request->room_booking_amount,
            'room_booking_number' => $request->room_booking_number,
            'room_booking_image' => $imagePath ?? $room->room_booking_image,
        ]);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Kamar berhasil diperbarui');
    }

    public function destroy($id)
    {
        $room = RoomBooking::findOrFail($id);
        
        // Delete image if exists
        if ($room->room_booking_image && $room->room_booking_image !== 'default-room.jpg') {
            Storage::disk('public')->delete($room->room_booking_image);
        }
        
        $room->delete();

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Kamar berhasil dihapus');
    }
}