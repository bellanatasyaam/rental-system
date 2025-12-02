<?php

namespace App\Http\Controllers;

use App\Models\PropertyUnit;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyUnitController extends Controller
{
    public function index()
    {
        $units = PropertyUnit::with('property')->paginate(10);
        return view('property_units.index', compact('units'));
    }

    public function create()
    {
        $properties = Property::all();
        return view('property_units.create', compact('properties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_id'     => 'required|exists:properties,id',   // relasi ke properties
            'unit_code'       => 'required|string|max:100',
            'name'            => 'required|string|max:255',
            'type'            => 'nullable|string|max:100',        // ubah ke string, sesuai fillable
            'area'            => 'nullable|numeric',               // decimal → pakai numeric
            'monthly_price'   => 'nullable|numeric',               // decimal → pakai numeric
            'deposit_amount'  => 'nullable|numeric',               // decimal → pakai numeric
            'status'          => 'required|string|max:50',
            'notes'           => 'nullable|string',                // text → pakai string
        ]);

            $data = $request->all();

        // Beri nilai default kalau 'type' kosong
        if (empty($data['type'])) {
            $data['type'] = 'default';  // ganti 'default' sesuai kebutuhan
        }

        PropertyUnit::create($data);

        return redirect()->route('property_units.index')->with('success', 'Property unit added successfully!');
    }

    public function show($id)
    {
        $propertyUnit = PropertyUnit::with('property')->findOrFail($id);
        return view('property_units.show', compact('propertyUnit'));
    }

    public function edit($id)
    {
        $propertyUnit = PropertyUnit::findOrFail($id);
        $properties = Property::all();
        return view('property_units.edit', compact('propertyUnit', 'properties'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'unit_code' => 'required|string|max:100',
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'area' => 'nullable|numeric',
            'monthly_price' => 'nullable|numeric',
            'deposit_amount' => 'nullable|numeric',
            'status' => 'required|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $propertyUnit = PropertyUnit::findOrFail($id);
        $propertyUnit->update($request->all()); // pastikan kolom fillable di model sudah benar

        return redirect()->route('property_units.index')->with('success', 'Property unit updated successfully!');
    }

    public function destroy($id)
    {
        $propertyUnit = PropertyUnit::findOrFail($id);
        $propertyUnit->delete();

        return redirect()->route('property_units.index')->with('success', 'Property unit deleted successfully!');
    }

    public function manage(Request $request)
    {
        $propertyId = $request->get('property_id');

        $properties = Property::all();

        // Ambil semua units + status real-time berdasarkan kontrak
        $units = PropertyUnit::with('contracts')
            ->when($propertyId, function ($query) use ($propertyId) {
                $query->where('property_id', $propertyId);
            })
            ->get()
            ->map(function ($unit) {

                // Simpan status asli dari DB
                $originalStatus = strtolower($unit->status);

                // Kalau maintenance → jangan diapa-apain
                if ($originalStatus === 'maintenance') {
                    $unit->status = 'maintenance';
                    return $unit;
                }

                // Kalau nonaktif → jangan diapa-apain
                if ($originalStatus === 'nonaktif') {
                    $unit->status = 'nonaktif';
                    return $unit;
                }

                // Cek kontrak aktif
                $activeContract = $unit->contracts
                    ->where('status', 'active')
                    ->where('start_date', '<=', now())
                    ->where('end_date', '>=', now())
                    ->first();

                // Kalau ada kontrak aktif → occupied
                if ($activeContract) {
                    $unit->status = 'occupied';
                }

                // Kalau tidak ada kontrak, biarkan status dari database
                return $unit;
            });

        return view('property_units.manage', compact('properties', 'units', 'propertyId'));
    }

    public function bookUnit(Request $request, $id)
    {
        $unit = PropertyUnit::findOrFail($id);

        if ($unit->status === 'occupied') {
            return response()->json(['error' => 'Kamar sudah ditempati!']);
        }

        if ($unit->status === 'nonaktif') {
            return response()->json(['error' => 'Kamar ini nonaktif!']);
        }

        // Ubah status kamar jadi occupied
        $unit->status = 'occupied';
        $unit->save();

        return response()->json(['success' => 'Kamar berhasil dibooking!']);
    }
}
