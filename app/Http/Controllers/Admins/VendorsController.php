<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Requests\VendorRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VendorCreated;
use DB;
use Illuminate\Support\Str;

class VendorsController extends Controller
{
    public function index()
    {
        $vendors = Vendor::selection()->paginate(PAGINATION_COUNT);

        return view('admin.vendors.index', compact('vendors'));
    }
    public function create()
    {
        // اول حاجه هجيب كل الاقسام الي عندي الي ال admin مفعلها
        $categories = MainCategory::where('translation_of','0')->active()->get();
        return view('admin.vendors.create', compact('categories'));
    }

    public  function store(VendorRequest $request)
    {
        //return $request  ;


        try{

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);



            $filePath = "";
            if ($request->has('logo')) {
                $filePath = uploadImage('vendors', $request->logo);
            }


            $vendor = Vendor::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'active' => $request->active,
                'address' => $request->address,
                'logo' => $filePath,
                'password' => $request->password,
                'category_id' => $request->category_id,


            ]);

           // Notification::send($vendor, new VendorCreated($vendor));


            return redirect()->route('admin.vendors')->with(['success' => 'تم الحفظ بنجاح']);




        }catch(\Exception $ex)
        {   //return $ex ;
            return redirect()->route('admin.vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function edit($id)
    {
        try {

            $vendor = Vendor::Selection()->find($id);
            if (!$vendor)
                return redirect()->route('admin.vendors')->with(['error' => 'هذا المتجر غير موجود او ربما يكون محذوفا ']);

            $categories = MainCategory::where('translation_of', 0)->active()->get();

            return view('admin.vendors.edit', compact('vendor', 'categories'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id, VendorRequest $request)
    {

        try {

            $vendor = Vendor::Selection()->find($id);
            if (!$vendor)
                return redirect()->route('admin.vendors')->with(['error' => 'هذا المتجر غير موجود او ربما يكون محذوفا ']);

          //   DB::beginTransaction(); في البدايه حطيت ده علشان بعمل كذا عمليه مع بعض
            DB::beginTransaction();
            //photo
            if ($request->has('logo') ) {
                $filePath = uploadImage('vendors', $request->logo);
                Vendor::where('id', $id)
                    ->update([
                        'logo' => $filePath,
                    ]);
            }


            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            //$data : ده كل ال request ما عدا الحاجات دي
            // لام مش كل مره اغير ال password

            $data = $request->except('_token', 'id', 'logo', 'password');

            // لو الباسورد موجود ومش فاضي اعمله ابديت
            if ($request->has('password') && !is_null($request->  password)) {

                $data['password'] = $request->password;
            }

            Vendor::where('id', $id)
                ->update(
                    $data
                );

            DB::commit();
            return redirect()->route('admin.vendors')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            DB::rollback();
            return redirect()->route('admin.vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }




    public function destroy($id)
    {

        try {
            $vendor = Vendor::find($id);
            if (!$vendor)
                return redirect()->route('admin.vendors')->with(['error' => 'هذا المتجر غير موجود ']);


            $image = Str::after($vendor->logo, 'assets/');


            $image = base_path('assets/' . $image);
            unlink($image); //delete from folder


            $vendor->delete();
            return redirect()->route('admin.vendors')->with(['success' => 'تم حذف المتجر بنجاح']);

        } catch (\Exception $ex) {

            return $ex;
            return redirect()->route('admin.vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }






    public function changeStatus($id)
    {
        try {
            $vendor = Vendor::find($id);
            if (!$vendor)
                return redirect()->route('admin.vendors')->with(['error' => 'هذا القسم غير موجود ']);

            $status =  $vendor -> active  == 0 ? 1 : 0;

            $vendor -> update(['active' => $status ]);

            return redirect()->route('admin.vendors')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }






}
