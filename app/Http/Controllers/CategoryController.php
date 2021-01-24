<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\testcase;

class CategoryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function manageCategory()
    {
        $categories = Category::where('parent_id', '=', 0)->get();

        $allCategories = Category::all();
        
        $firstcategories = Category::where('parent_id', '=', 0)->first();
        if($firstcategories)
        $testcasevalue = testcase::where('module_id',$firstcategories->id)->get();
    else
        $testcasevalue = collect();

        return view('category.categoryTreeview',compact('categories','allCategories','testcasevalue'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function addCategory(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];

        Category::create($input);
        return back()->with('success', 'New Category added successfully.');

    }

    public function storetask(Request $request)
    {
           // $id=$request->input('id');
            $moduleid=$request->input('module_id');
            $summary=$request->input('summary');
            $description=$request->input('description');
            $module = Category::where('id',$moduleid)->first();
            $token = strtolower(str_random(10));
            $file = $request->file('file');
            $fileupload = new testcase($request->input());
            $fileupload->module=$module->title;
            $fileupload->description=$description;
            $fileupload->summary=$summary;
            $fileupload->module_id=$moduleid;
            $fileupload->fileextension= $file->getClientOriginalExtension();
            $fileupload->filename=$file->getClientOriginalName();
            $filetoStorage = $file->getClientOriginalName();
            $file = $request->file('file');
            $path = $file->storeAs('testcase', $filetoStorage);

         $fileupload->save() ;

     
return back()->with('success', 'New test case added successfully.');

    }
    public function deleteTestcase($id)
    {
        
        testcase::where('id',$id)->delete();
    
       return redirect()->back()->with('success','Deleted Successfully');
    }
   
    public function download($id)
    {
        $entry = testcase::where('id', '=', $id)->first();
       $path = storage_path().'/'.'app'.'/testcase/'.$entry->filename;
    if (file_exists($path)) {
        return response()->download($path);
    }
}
         
    public function destroy($id)
    {
        
        Category::where('id',$id)->delete();
        $childcategory = Category::where('parent_id',$id)->pluck('id');
        Category::where('parent_id',$id)->delete();
        testcase::where('module_id',$id)->delete();
        testcase::whereIn('module_id',$childcategory)->delete();

       return redirect()->back()->with('success','Module Deleted Successfully');
       
    }

    public function viewtestcase($id)
    {
        
     $categories = Category::where('parent_id', '=', 0)->get();

        $allCategories = Category::all();
        $testcasevalue = testcase::where('module_id',$id)->get();

        return view('category.categoryTreeview',compact('categories','allCategories','testcasevalue'));
    }

      public function edittestcase(Request $request,$id)

{
    
    testcase::where('id',$id)->update($request->except('_token'));
        return redirect()->back()->with('success','Info updated successfully');

}
}
