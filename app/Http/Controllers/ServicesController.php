<?php

namespace App\Http\Controllers;

use App\Models\Servic;
use App\Models\ServicCategory;
use App\Models\ServicReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    public function index()
    {
        $cates = ServicCategory::all();
        return view('control.servicesCategories', ['cates' => $cates]);
    }
    public function services($id)
    {
        $cate = ServicCategory::find($id);
        $services = Servic::where('servicCategory_id', $id)->get();
        return view('control.services', ['services' => $services, 'cate' => $cate]);
    }
    public function addServicePage($id)
    {
        $cate = ServicCategory::find($id);
        return view('/control/addService', ['cate' => $cate]);
    }
    public function addService(Request $request, $id)
    {
        $cate = ServicCategory::find($id);
        $request->validate([
            'ar_name' => 'required|max:50',
            'en_name' => 'required|max:50',
            'des' => 'required|max:255',
            'image' => 'nullable|mimes:png,jpg,jpeg,csv,txt,pdf|max:2048'
        ]);
        $data = [
            'ar_name' => $request->input('ar_name'),
            'en_name' => $request->input('en_name'),
            'des' => $request->input('des'),
            'servicCategory_id' => $id
        ];
        $service = Servic::create($data);
        if ($service != null) {
            if ($request->hasFile('image')) {

                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $path = $request->file('image')->storeAs('services', $fileName, 'public');
                $service->image = $path;
                $service->save();
            }
            return back()->with(['success' => 'تم إضافة الخدمة بنجاح']);
        }
        return back()->withErrors(['error' => 'خطأ غير معروف']);
    }
    public function getRequests()
    {
        $requests = DB::table('servic_reservations')
            ->join('servics', 'servic_reservations.servic_id', '=', 'servics.id')
            ->join('servic_categories', 'servics.servicCategory_id', '=', 'servic_categories.id')
            ->select('servics.id as id', 'servics.ar_name as servic_name', 'servic_categories.ar_name as cate_name', 'servic_reservations.created_at')
            ->paginate(20);
        return view('control.serviceRequests', ['requests' => $requests]);
    }
    public function requestDetails($id)
    {
        $data = ServicReservation::find($id);
        return view('control.requestDetails', ['details' => $data]);
    }
    public function updatePage($id)
    {
        $service = Servic::find($id);
        return view('control.updateService', ['service' => $service]);
    }
    public function update(Request $request, $id)
    {
        $service = Servic::find($id);
        $request->validate([
            'ar_name' => 'required|max:50',
            'en_name' => 'required|max:50',
            'des' => 'required|max:255',
            'image' => 'nullable|mimes:png,jpg,jpeg,csv,txt,pdf|max:2048'
        ]);
        $data = [
            'ar_name' => $request->input('ar_name'),
            'en_name' => $request->input('en_name'),
            'des' => $request->input('des'),
        ];
        $service->update($data);
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $path = $request->file('image')->storeAs('services', $fileName, 'public');
            $service->image = $path;
            $service->save();
        }
        return back()->with(['success' => 'تم إضافة الخدمة بنجاح']);
    }
    public function delete($id){
        $service = Servic::find($id);
        $service->delete();
        return back()->with(['success' => 'تم الحذف بنجاح']);
    }
}
