<?php

namespace App\Observers;

use App\Models\MainCategory;

class MainCategoryObserver
{
    /**
     * Handle the main category "created" event.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return void
     */
    public function created(MainCategory $mainCategory)
    {
        //
    }

    /**
     * Handle the main category "updated" event.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return void
     */
    public function updated(MainCategory $mainCategory)
    {
          //اول حاجه جابلي العلاقه ما بين الاقسام والمتاجر عن طريق
        // vendors()  :  الي هي اصلا موجوده عندي داخل المودل
        // يعملي ايه يعمل update
        // لل active بتاع كل ال vendors  زيها زي ال active  الي موجوده في ال main_category
        $mainCategory -> vendors()-> update(['active' => $mainCategory -> active]);



    }

    /**
     * Handle the main category "deleted" event.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return void
     */
    public function deleted(MainCategory $mainCategory)
    {
        //
    }

    /**
     * Handle the main category "restored" event.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return void
     */
    public function restored(MainCategory $mainCategory)
    {
        //
    }

    /**
     * Handle the main category "force deleted" event.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return void
     */
    public function forceDeleted(MainCategory $mainCategory)
    {
        //
    }
}
