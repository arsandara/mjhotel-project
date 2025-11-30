<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LandingPageController extends Controller
{
    /**
     * Display landing page management
     */
    public function index()
    {
        // Load rooms
        $rooms = Room::with(['images' => function($query) {
            $query->orderBy('sort_order', 'asc');
        }])->get();
        
        return view('admin.landing', compact('rooms'));
    }

    /**
     * Show form untuk create room baru
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store room baru - DIPERBAIKI
     */
    public function store(Request $request)
    {
        // Log request untuk debugging
        Log::info('Store room request', [
            'room_name' => $request->room_name,
            'room_type' => $request->room_type,
            'has_images' => $request->hasFile('images'),
            'image_count' => $request->hasFile('images') ? count($request->file('images')) : 0
        ]);

        $validated = $request->validate([
            'room_name' => 'required|string|max:255',
            'room_type' => 'required|string|max:100',
            'room_price' => 'required|numeric|min:0',
            'room_capacity' => 'nullable|integer|min:1',
            'room_facility' => 'nullable|string',
            'room_rules' => 'nullable|string',
            'images' => 'required|array|min:3|max:5',
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            // ✅ PERBAIKAN: Generate room_id yang unik
            $roomId = 'room_' . uniqid() . '_' . time();
            
            // Create room dengan room_id
            $room = Room::create([
                'room_id' => $roomId, // ✅ TAMBAHKAN INI
                'room_name' => $validated['room_name'],
                'room_type' => $validated['room_type'],
                'room_price' => $validated['room_price'],
                'room_capacity' => $validated['room_capacity'] ?? 2,
                'room_facility' => $validated['room_facility'] ?? null,
                'room_rules' => $validated['room_rules'] ?? null,
                'room_amount' => 1, // ✅ TAMBAHKAN INI karena required di migration
                'room_image' => 'main.jpg' // ✅ TAMBAHKAN INI karena ada default di migration
            ]);

            Log::info('Room created', ['room_id' => $room->room_id]);

            // Handle multiple images upload dengan urutan yang benar
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    
                    // Pastikan folder ada
                    $uploadPath = public_path('images/rooms');
                    if (!file_exists($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }
                    
                    $image->move($uploadPath, $filename);
                    
                    $room->images()->create([
                        'image_path' => $filename,
                        'sort_order' => $index
                    ]);
                    
                    Log::info('Image uploaded', [
                        'filename' => $filename,
                        'sort_order' => $index
                    ]);
                }
            }

            Log::info('Room created successfully', ['room_id' => $room->room_id]);

            // ✅ PERBAIKAN: Return redirect yang proper
            return redirect()
                ->route('admin.landing')
                ->with('success', 'Kamar berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            Log::error('Failed to create room', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan kamar: ' . $e->getMessage());
        }
    }

    /**
     * Show form untuk edit room
     */
    public function edit($id)
    {
        // Cari room berdasarkan room_id (bukan id auto increment)
        $room = Room::where('room_id', $id)->with(['images' => function($query) {
            $query->orderBy('sort_order');
        }])->firstOrFail();
        
        // Format images untuk blade
        $images = $room->images->map(function($img) {
            return [
                'id' => $img->id,
                'image_path' => $img->image_path,
                'sort_order' => $img->sort_order
            ];
        })->sortBy('sort_order')->values();
        
        return view('admin.edit', compact('room', 'images'));
    }

    /**
    * Update room
    */
    public function update(Request $request, $id)
    {
        $room = Room::where('room_id', $id)->with('images')->firstOrFail();
        $currentImageCount = $room->images->count();
        
        $validated = $request->validate([
            'room_name' => 'required|string|max:255',
            'room_type' => 'required|string|max:100',
            'room_price' => 'required|numeric|min:0',
            'room_capacity' => 'nullable|integer|min:1',
            'room_facility' => 'nullable|string',
            'room_rules' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'existing_order' => 'nullable|json'
        ]);

        try {            
            $room->update([
                'room_name' => $validated['room_name'],
                'room_type' => $validated['room_type'],
                'room_price' => $validated['room_price'],
                'room_capacity' => $validated['room_capacity'] ?? 2,
                'room_facility' => $validated['room_facility'] ?? null,
                'room_rules' => $validated['room_rules'] ?? null,
            ]);

            // Update urutan existing images
            if ($request->has('existing_order')) {
                $existingOrder = json_decode($request->existing_order, true);
                
                Log::info('Updating image order:', ['order' => $existingOrder]);
                
                if (is_array($existingOrder)) {
                    foreach ($existingOrder as $item) {
                        $updated = RoomImage::where('id', $item['id'])
                            ->where('room_id', $room->room_id)
                            ->update(['sort_order' => $item['sort_order']]);
                        
                        Log::info('Updated image', [
                            'id' => $item['id'],
                            'new_sort_order' => $item['sort_order'],
                            'rows_affected' => $updated
                        ]);
                    }
                }
            }

            // Upload new images
            if ($request->hasFile('images')) {
                $newImages = $request->file('images');
                $newImagesCount = count($newImages);
                
                if ($currentImageCount + $newImagesCount > 5) {
                    return back()->withErrors(['images' => 'Total gambar tidak boleh lebih dari 5.'])->withInput();
                }
                
                $totalImages = $currentImageCount + $newImagesCount;
                if ($totalImages < 3) {
                    return back()->withErrors(['images' => 'Minimal 3 gambar diperlukan.'])->withInput();
                }
                
                $maxOrder = $room->images()->max('sort_order') ?? 0;
                
                foreach ($newImages as $index => $image) {
                    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/rooms'), $filename);
                    
                    $room->images()->create([
                        'image_path' => $filename,
                        'sort_order' => $maxOrder + $index + 1
                    ]);
                }
            }

            // Validasi final
            $finalImageCount = $room->images()->count();
            if ($finalImageCount < 3) {
                return back()->withErrors(['images' => 'Kamar harus memiliki minimal 3 gambar.'])->withInput();
            }

            Log::info('Room updated successfully', ['room_id' => $room->room_id]);
            
            return redirect()->route('admin.landing')->with('success', 'Kamar berhasil diupdate!');
        } catch (\Exception $e) {
            Log::error('Update error:', ['message' => $e->getMessage()]);
            return back()->with('error', 'Gagal mengupdate kamar: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Delete room
     */
    public function destroy($id)
    {
        try {
            // ✅ PERBAIKAN: Cari berdasarkan room_id, bukan auto-increment ID
            $room = Room::where('room_id', $id)->with('images')->firstOrFail();
            
            Log::info('Deleting room', ['room_id' => $id, 'room_name' => $room->room_name]);
            
            // Hapus semua gambar dari storage
            foreach ($room->images as $image) {
                $imagePath = public_path('images/rooms/' . $image->image_path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                    Log::info('Deleted image file', ['path' => $imagePath]);
                }
            }
            
            // Delete room
            $room->delete();
            
            Log::info('Room deleted successfully', ['room_id' => $id]);
            
            return response()->json([
                'success' => true,
                'message' => 'Kamar berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to delete room', [
                'room_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove specific image from room (hapus gambar dari landing page)
     */
    public function removeImage($id)
    {
        try {
            // ✅ PERBAIKAN: Cari berdasarkan room_id
            $room = Room::where('room_id', $id)->with('images')->firstOrFail();
            
            Log::info('Removing image from room', ['room_id' => $id]);
            
            // Hapus gambar pertama
            $firstImage = $room->images->first();
            
            if ($firstImage) {
                $imagePath = public_path('images/rooms/' . $firstImage->image_path);
                
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                    Log::info('Deleted image file', ['path' => $imagePath]);
                }
                
                $firstImage->delete();
                Log::info('Image record deleted', ['image_id' => $firstImage->id]);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to remove image', [
                'room_id' => $id,
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete specific image by ID (untuk halaman edit)
     */
    public function deleteImage($imageId)
    {
        try {
            $image = RoomImage::findOrFail($imageId);
            
            $imagePath = public_path('images/rooms/' . $image->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            
            $image->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil dihapus'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Foto tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}