<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveUserRequest;
use App\Models\Users\User;
use App\Traits\UserTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use UserTrait;
    private $objUser;
    protected $arrOptions;

    public function __construct(User $objUser)
    {
        $this->objUser = $objUser;
        $this->arrOptions = [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recordsPerPage = config('common.recPerPage');
        $arrObjUsers = null ;        
        $arrWhereCondition = [];
        //echo $request->get('projectname').'=='.$request->get('key').'=='.$request->get('url');

        if( $request->get('name') != null && $request->get('name')!='' ){            
            $name = $request->get('name');
            $arrWhereCondition[] = ['name', 'like' , '%'.$name.'%'];
        }
        if( $request->get('email') != null && $request->get('email')!='' ){
            $email = $request->get('email');
            $arrWhereCondition[] = ['email', 'like' , '%'.$email.'%'];
        }
        /*if( $request->get('sprint') != null && $request->get('sprint')!='' ){
            $sprint = $request->get('sprint');
            $arrWhereCondition[] = ['sprint', 'like' , '%'.$sprint.'%'];
        }*/

        if( !empty( $arrWhereCondition ) && count( $arrWhereCondition )>0 ){
            $arrObjUsers = $this->objUser->where($arrWhereCondition)->paginate($recordsPerPage);
            //print_r($arrObjProjects);
        }else{
            $arrObjUsers = $this->objUser->paginate($recordsPerPage);    
            /*echo '<pre>';
            print_r($arrObjUsers);
            exit();*/
            //$arrObjProjects = $this->objProject->all();
        }        

        if($request->ajax()){
            return $arrObjUsers->toJson();
        } else {
            $this->getCommonDetails();                 
            return view('clients.users.index')
            ->with('jsonUsers', $arrObjUsers->toJson())
            ->with('options', $this->arrOptions->toJson());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arrUserOptions = User::all(['id', DB::raw("CONCAT(name, ' (', email, ')') AS label")]);

        return view('clients.users.create')
        ->with('objUser', $this->objUser)
        ->with('arrUserOptions', $arrUserOptions->toJson());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $objRequest
     * @return \Illuminate\Http\Response
     */
    public function store(SaveUserRequest $objRequest)
    {
        if ($this->objUser->saveUser($objRequest)) {
            return parent::passResponse('User created successfully.');
        }

        return parent::failedResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Users\User $objUser
     * @return \Illuminate\Http\Response
     */
    public function show($intId)
    {
        return $this->edit($intId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Users\User $objUser
     * @return \Illuminate\Http\Response
     */
    public function edit($intId)
    {
        $objUser = $this->objUser->find($intId);

        $arrUserOptions = User::all(['id', DB::raw("CONCAT(name, ' (', email, ')') AS label")]);

        return view('clients.users.create')
        ->with('objUser', $objUser)
        ->with('arrUserOptions', $arrUserOptions->toJson());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $objRequest
     * @param \App\Models\Users\User $objUser
     * @return \Illuminate\Http\Response
     */
    public function update($intId, SaveUserRequest $objRequest)
    {
        if ($this->objUser->saveUser($objRequest, $intId)) {
            return parent::passResponse('User updated successfully.');
        }

        return parent::failedResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Users\User $objUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $objUser)
    {
        //
    }
}
