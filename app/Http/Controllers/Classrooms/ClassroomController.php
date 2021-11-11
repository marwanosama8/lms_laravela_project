<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassrooms;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $My_Classes = Classroom::all();
      $Grades = Grade::all();
      return view('pages.My_Classes.My_Classes',compact('My_Classes','Grades'));  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreClassrooms $request)
  {
    $List_Classes = $request->List_Classes;
    try {
      $validated = $request->validated();

      
      foreach ($List_Classes as $List_Class) {
        $Classroom = new Classroom;
   
        $Classroom->Name_Class = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']];
        $Classroom->Grade_id = $List_Class['Grade_id'];
        $Classroom->save(); 
      }
      
    
      toastr()->success(trans('messages.success'),trans('messages.title'));
      return redirect()->route('Classrooms.index');
    } catch (Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }


  }


 
  public function update(StoreClassrooms $request)
      {

        try {

            $Classroom = Classroom::findOrFail($request->id);

            $Classroom->update([

                $Classroom->Name_Class = ['ar' => $request->Name, 'en' => $request->Name_en],
                $Classroom->Grade_id = $request->Grade_id,
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Classrooms.index');
        }

        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }


   public function destroy(Request $request)
  {
    $Classroom = Classroom::findOrFail($request->id);
    $Classroom->delete();
    toastr()->success(trans('messages.Delete'));
    return redirect()->route('Classrooms.index');
  }
  

    public function delete_all(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        Classroom::whereIn('id', $delete_all_id)->Delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Classrooms.index');
    }
    

    public function Filter_Classes(Request $request)
    {
      $Grades = Grade::all();
      
      // ****here we filter and returning all Grade_id thats selected from the Modal
      $Search = Classroom::select('*')->where('Grade_id', '=' ,$request->Grade_id)->get();


      return view('pages.My_Classes.My_Classes',compact('Grades'))->withDetails($Search);
    }

}


 
?>