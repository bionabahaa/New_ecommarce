<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\MainCategoryRequest;
use DB;
use Illuminate\Support\Str;


class MainCategoriesController extends Controller
{
    public function index()
    {
        //get_default_language دي ال function الي انا عملتها في helpers
        $default_lang = get_default_language();
        // MainCategory::where('translation_lang',$default_lang)->select('id','name','slug','photo','active','translation_lang')->get();

        // بدل بردوا ما اكتب كل جمله ال select دي هعملها في مودل
        $categories = MainCategory::where('translation_lang', $default_lang)->selection()->get();
        return view('admin.main_categories.index', compact('categories'));


    }


    public function create()
    {
        return view('admin.main_categories.create');
    }


//    public  function store(MainCategoryRequest $request)
//    {
//        //return $request ;
//          //$request ->category  // دي الي جيالي من ال form  بتاعت ال create
//        //category :  ده ال name الي موجود في ال form
//        $main_categories =  collect($request -> category);
//
//        $filter = $main_categories -> filter(function ($value,$key){
//
//
//         //$filiter :: كده انا جبت ال default value
//            //بس كده انا اثبتها لازم اخليها متغيره
////            /
//            //return $value['abbr'] == 'ar';
//               //get_default_language : دي الي بتجبلي ال default value
//            // الموجوده في ال helper
//            return $value['abbr'] == get_default_language();
//
//        });
//        // كده دي بترجعلي ال key $ value
//        // فانا عايز من ال object يرجعلي ال value بس
//        return $filter ;
//        //هعمل كده
//        // بس المفروض الي راجعلي object مش array
//        //فانا اقدر احول ال
//        // object to array
//
//        //return array_values($filter);
//
//        return array_values($filter->all());
//
//
//
//    }


    public function store(MainCategoryRequest $request)

    {
        try {


            // code here transection


            //return $request;

            $main_categories = collect($request->category);

            $filter = $main_categories->filter(function ($value, $key) {
                return $value['abbr'] == get_default_language();
            });

            $default_category = array_values($filter->all()) [0];


            $filePath = "";
            if ($request->has('photo')) {
                //maincategories  :  ده ال folder الي انا عملته في
                // filesystem   -- > لحفظ مسار الصوره
                $filePath = uploadImage('maincategories', $request->photo);

            }

            DB::beginTransaction();

            // اول حاجه بعمل حفظ لل id  بتاع
            //default language
            // insertGetId  : function دي بتعملي حفظ لاول لغه باستخدام id
            $default_category_id = MainCategory::insertGetId([

                //abbr : دي الي هي en  or ar  وبعملها حفظ
                'translation_lang' => $default_category['abbr'],
                'translation_of' => 0,
                'name' => $default_category['name'],
                'slug' => $default_category['name'],
                'photo' => $filePath
            ]);

            //الخطوه الي فوق اول حاجه عملتها حفظت اول لغه عندي علشان اقدر اخد ال id بتاعها هحطه في باقي اللغات
            // الخطوه الي بعد كده

            // $categories : دي هتجبلي بقيت اللغات الي عندي


            $categories = $main_categories->filter(function ($value, $key) {
                return $value['abbr'] != get_default_language();
            });

            // هنا انا عايز اجمع بقيت اللغات وبعمل عليهم foreach وبحطهم في array واحفظهم مره واحده
            if (isset($categories) && $categories->count()) {

                $categories_arr = [];
                foreach ($categories as $category) {
                    $categories_arr[] = [
                        'translation_lang' => $category['abbr'],

                        //$default_category_id : ده ال id بتاع ال default lang
                        'translation_of' => $default_category_id,
                        'name' => $category['name'],
                        'slug' => $category['name'],
                        'photo' => $filePath
                    ];
                }

                // insert :  array استخدمتها هي الي بتحفظ a
                MainCategory::insert($categories_arr);
            }


            DB::commit();
            return redirect()->route('admin.main_categories')->with(['success' => 'تم الحفظ بنجاح']);

        }catch (\Exception $ex)
        {

            // دي معناها ايه معناها متحفظش ابي حاجه من فوق سواء واحده صح او غلط
           DB::rollback();

            return redirect()->route('admin.main_categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }
    }


    public function edit($main_categ_id)
    {
        //get specific categories and its translations

        //هنا دي رجعلي كل ال selection بتاعي معاه كمان
        // categories :  relation الي انا عملتها في ال مودل بتاعي ولازم اتاكد ان ال forgin key راجع معايا في ال
        // //  selection()  دي
        $mainCategory = MainCategory::with('categories')
            ->selection()
            ->find($main_categ_id);

          $mainCategory =   MainCategory::selection()->find($main_categ_id);

        if(!$mainCategory)
            return redirect()->route('admin.main_categories')->with(['error' => 'هذا القسم غير موجود']);

        return view('admin.main_categories.edit', compact('mainCategory'));



    }



    public  function  update($mainCat_id,MainCategoryRequest $request)
    {

        //return $request;
        // validation

        try {
            $main_category = MainCategory::find($mainCat_id);

            if (!$main_category)
                return redirect()->route('admin.main_categories')->with(['error' => 'هذا القسم غير موجود ']);
            // update data

            //$category   :الجمله دي المفروض بترحعلي الحاجات االي انا عليزاها تتعدل بس

            // الي هي كده
            //{ name .....
            $category = array_values($request->category) [0];

            // ده معناه ايه ان لو مش جاي معاك active  حطها ب 0 غير كده خليها ب 1
            // category.0.active  :  ده ال name  اللي جاي من ال form

            if (!$request->has('category.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            MainCategory::where('id', $mainCat_id)
                ->update([
                    'name' => $category['name'],
                    'active' => $request->active,

                ]);

            if ($request->has('photo')) {
                $filePath = uploadImage('maincategories', $request->photo);
                MainCategory::where('id', $mainCat_id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }

            return redirect()->route('admin.main_categories')->with(['success' => 'تم التحديث بنجاح']);
        }

        catch (\Exception $ex)
        {
            return redirect()->route('admin.main_categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }

    }



    public function destroy($id)
    {

        try {
            $maincategory = MainCategory::find($id);
            if (!$maincategory)
                return redirect()->route('admin.main_categories')->with(['error' => 'هذا القسم غير موجود ']);

              // لازم اتاكد ان القسم ده ملوش تجار
            //vendors()  دي ال relation  الي انا عملتها في مودل بتاع
            //main category
            $vendors = $maincategory->vendors();

            if (isset($vendors) && $vendors->count() > 0) {
                return redirect()->route('admin.main_categories')->with(['error' => 'لأ يمكن حذف هذا القسم  ']);
            }

              //Str : دي بتقطعلي الصوره من بعد الفولدر الي انا حطاها ده
            // لان الmethod  الي انا عملاها في ال model
            //getphotoAttribute  : دي اصلا لازم بتجيب ال path كله من اول
            // http
            $image = Str::after($maincategory->photo, 'assets/');

                //base_path : دي بستخدمها علشان تجبلي ال path كله من الجهاز يعني من اول
            //C:\xampp\htdocs\new_ecommarce\assets\images\maincategories
            $image = base_path('assets/' . $image);
            unlink($image); //delete from folder

            //categories()  :  دي العلاقه الي انا عملتها داخل المودل بتعمل ايه بتجبلي كل اللغات بتاعتي الي تبع اللغه الافتراضيه الي انا  ضفتها تبع القسم
            // فانا المفروض لما باجي امسح بمسح ازاي بمسح اللغه الافتراضيه ومعاها اللغات االي انا ضفتها
            $maincategory-> categories()->delete();

            $maincategory->delete();
            return redirect()->route('admin.main_categories')->with(['success' => 'تم حذف القسم بنجاح']);

        } catch (\Exception $ex) {

            return $ex;
            return redirect()->route('admin.main_categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }



    public function changeStatus($id)
    {
        try {
            $maincategory = MainCategory::find($id);

            if (!$maincategory)
                return redirect()->route('admin.main_categories')->with(['error' => 'هذا القسم غير موجود ']);

            $status =  $maincategory -> active  == 0 ? 1 : 0;

            $maincategory -> update(['active' => $status ]);

            return redirect()->route('admin.main_categories')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.main_categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }





















}

