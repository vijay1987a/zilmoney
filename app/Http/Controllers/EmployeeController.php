<?php
//Employee Controller used for create update employee records
namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Languages;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    //index or report page
    public function index(Request $request)
    {
        //check if had filter 
        $from_date=$request->has("from_date")?$request->from_date:Date("Y-m-d");
        $to_date=$request->has("from_date")?$request->to_date:Date("Y-m-d");

        $cols=["name"=>"Last Name","willing_to_relocate"=>"Willing To Relocate","language"=>"Language Known"];
        $data=Employees::select([DB::raw("concat(first_name,' ',last_name) as name"),
        DB::raw("(case when willing_to_work = 1 then 'true' else 'false' end) as willing_to_relocate"),"language","Employees.id"])
        ->join("languages","languages.id","language_known")
        ->whereDate("created_at",">=",$from_date)
        ->whereDate("created_at","<=",$to_date)
        ->paginate();

        //print_r($data);
        $total=count($data);
        return view("employees.list",["data"=>$data,"total"=>$total,"cols"=>$cols]);

    }

    //get options
    public function wrap_options($data,$col)
    {
        $res="";

        foreach($data as $iter)
        $res.="<option value='".$iter["id"]."'>".$iter[$col]."</option> ";

        return $res;
    }
    //create
    public function create(Request $request,$err=false,$validatorErr=[])
    {
        $language_known_opt=$this->wrap_options(Languages::select("id","language")->get(),"language");

        if($err)
        return view("employees.create",["title"=>"Create","language_known_opt"=>$language_known_opt])->withErrors($validatorErr); //title used for pass key in same view page and sent to backend for identify whether it is create or update

        return view("employees.create",["title"=>"Create","language_known_opt"=>$language_known_opt]); //title used for pass key in same view page and sent to backend for identify whether it is create or update
    }

        //edit
    public function edit(Request $request,$id,$err=false,$validatorErr=[])
    {
        $language_known_opt=$this->wrap_options(Languages::select("id","language")->get(),"language");
        $data=Employees::where("id",$request->id)->first();

        if(!$data)
        return "No data found";

        if($err)
        return view("employees.create",["title"=>"Update","data"=>$data,"language_known_opt"=>$language_known_opt,"id"=>$request->id])->withErrors($validatorErr); //title used for pass key in same view page and sent to backend for identify whether it is create or update

        return view("employees.create",["title"=>"Update","data"=>$data,"language_known_opt"=>$language_known_opt,"id"=>$request->id]); //title used for pass key in same view page and sent to backend for identify whether it is create or update
    }
        //view
    public function view(Request $request,$id)
    {
        $cols=["name"=>"Last Name","willing_to_relocate"=>"Willing To Relocate","language"=>"Language Known"];
        
        $data=Employees::select([DB::raw("concat(first_name,' ',last_name) as name"),
        DB::raw("(case when willing_to_work = 1 then 'true' else 'false' end) as willing_to_relocate"),"language","Employees.id"])
       
        ->join("languages","languages.id","language_known")
        ->where("Employees.id",$id)->first();

        if(!$data)
        return "No data found";

        return view("employees.view",["title"=>"View","data"=>$data,"cols"=>$cols]); //title used for pass key in same view page and sent to backend for identify whether it is create or update
    }

        //insert
    public function insert(Request $request)
    {
        $rules=[
            "first_name"=>"required|max:100",
            "last_name"=>"required|max:100",
            "willing_to_work"=>"required|int|in:0,1",
            "language_known"=>"required|int|exists:languages,id"
        ];
        $validator=Validator::make($request->all(), $rules);
        if($validator->fails())
        {
            return $this->create($request,true,$validator);
        }

        Employees::insert(
            [
                "first_name"=>$request->first_name,
                "last_name"=>$request->last_name,
                "willing_to_work"=>$request->willing_to_work,
                "language_known"=>$request->language_known,
                "created_at"=>Date("Y-m-d H:i:s")
            ]
            );

            return redirect()->route("EmployeeList");

    }

        //update
    public function update(Request $request)
    {
        $rules=[
            "id"=>"required|int",
            "first_name"=>"required|max:100",
            "last_name"=>"required|max:100",
            "willing_to_work"=>"required|int|in:0,1",
            "language_known"=>"required|int|exists:languages,id"
        ];
        $validator=Validator::make($request->all(), $rules);
        if($validator->fails())
        {
        return $this->edit($request,$request->id,true,$validator);
       
        }

        Employees::insert(
            [
                "first_name"=>$request->first_name,
                "last_name"=>$request->last_name,
                "willing_to_work"=>$request->willing_to_work,
                "language_known"=>$request->language_known
            ]
            );

            return redirect()->route("EmployeeList");

    }

    //delete
    public function delete(Request $request)
    {
        if(!$request->has("id"))
        return ["status"=>false,"errMsg"=>"Id not found"];

         Employees::where("id",$request->id)->delete();

         return ["status"=>true,"errMsg"=>""];

    }
}
