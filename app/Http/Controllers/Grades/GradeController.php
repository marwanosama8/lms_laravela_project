<?php 

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Http\Requests\StoreGrade;

use Illuminate\Http\Request;

class GradeController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $Grade = Grade::all();
    return view('pages.Grades.Grades',compact('Grade'));
    
  }

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

  //****** Geting the request from StoreGrade Request Validation (new in Laravel 8.0x)
  public function store(StoreGrade $request)
  {
    
     // cheacking if the requst Name ('en' and 'ar') not have same value in database

      if (Grade::where('Name->ar', $request->Name)->orWhere('Name->en',$request->Name_en)->exists()) {

          return redirect()->back()->withErrors(trans('Grades_trans.exists'));
      }



    // making new object from GradeModel to pass in it the requst validation we recive it after validate it in the StoreGrade ( new in laraevel 8.0x)
    
    try{
    
    $validated = $request->validated();
    
    $Grade = new Grade();
    
    $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
    
    $Grade->Notes = $request->Notes;

    $Grade->save();
    
    toastr()->success(trans('messages.success'),trans('messages.title'));
     return redirect()->route('Grades.index');
    }
    // here we sending error in view by blade @error
    catch(\Exception $e){

      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }


    

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(StoreGrade $request)
  {
    try {
      $validated = $request->validated();

      $Grades = Grade::findOrFail($request->id);

      $Grades->update([
        $Grades->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
        $Grades->Notes = $request->Notes
      ]);

    toastr()->success(trans('messages.Update'),trans('messages.title'));
    return redirect()->route('Grades.index');
    } catch (Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
    $Grades = Grade::findOrFail($request->id)->delete();
    toastr()->success(trans('messages.Delete'),trans('messages.title'));
    return redirect()->route('Grades.index');
  }
  
}

?>