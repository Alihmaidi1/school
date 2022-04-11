<?php
namespace App\Http\Controllers\Grades;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreGrades;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\repo\interfaces\grade as gradeinterface;
class GradeController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */

   public $gradeinterface;
   public function __construct(gradeinterface $gradeinterface)
   {

    $this->gradeinterface=$gradeinterface;
   }
  public function index()
  {
      $Grades = $this->gradeinterface->GetAllGrade();
    return view('pages.Grades.Grades',compact('Grades'));
  }



  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreGrades $request)
  {
      try {
          $validated = $request->validated();
          $grade=$this->gradeinterface->store($request);
          toastr()->success(trans('messages.success'));
          return redirect()->route('Grades.index');
      }
      catch (\Exception $e){
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
   public function update(StoreGrades $request)
 {
   try {
       $validated = $request->validated();
       $arr=Cache::get("grades");
        if($arr[$request->id]){
            $this->gradeinterface->update($request);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Grades.index');
        }else{
       return redirect()->back()->withErrors(['error' => trans("messages.record not exist")]);
        }

   }
   catch(\Exception $e) {
       return redirect()->back()->withErrors(['error' => $e->getMessage()]);
   }
 }


  public function destroy(Request $request)
  {

    try{

        $arr=Cache::get("grades");
        if($arr[$request->id]){
            $this->gradeinterface->delete($request);
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('Grades.index');
        }else{
        return redirect()->route('Grades.index')->withErrors(["error"=>trans("messages.record not exist")]);
        }

    }catch(\Exception $ex){

        return redirect()->route('Grades.index')->withErrors(["error"=>$ex->getMessage()]);

    }
  }



  public function show_details($id){


    $arr=Cache::get("grades");
    $stages=$this->gradeinterface->GetAllGrade();
    return view("pages.Grades.show_details",["grade"=>$arr[$id],"stages"=>$stages]);


  }

}

?>
