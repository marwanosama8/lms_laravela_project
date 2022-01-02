<?php

namespace App\Http\Controllers\Sections;


use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSection;



class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $Grades = Grade::with('Sections')->get();
    $list_Grades = Grade::all();

    return view('pages.Sections.Sections',compact('list_Grades','Grades'));

    }

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSection $request)
    {
        try {

      $validated = $request->validated();
      $Sections = new Section();

      $Sections->Name_sections = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
      $Sections->Grade_id = $request->Grade_id;
      $Sections->Class_id = $request->Class_id;
      $Sections->Status = 1;
      $Sections->save();
      toastr()->success(trans('messages.success'));

      return redirect()->route('section.index');


        } catch (Exception $e) {
                  return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

      
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSection $request)
{

    try {
      $validated = $request->validated();
      $Sections = Section::findOrFail($request->id);

      $Sections->Name_sections = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
      $Sections->Grade_id = $request->Grade_id;
      $Sections->Class_id = $request->Class_id;

      if(isset($request->status)) {
        $Sections->status = 1;
      } else {
        $Sections->status = 2;
      }

      $Sections->save();
      toastr()->success(trans('messages.Update'));

      return redirect()->route('section.index');
  }
  catch
  (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  }

  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
  {


    try {
        
    Section::findOrFail($request->id)->delete();
    toastr()->error(trans('messages.Delete'));
    return redirect()->route('section.index');

    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

  }



    public function getclasses($id)
    {
        $List_Classes = Classroom::where('Grade_id',$id)->pluck('Name_Class','id');

        return $List_Classes;
    }

}