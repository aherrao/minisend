<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clients\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    private $client;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Client $client)
    {
        return view('admin.clients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $input = $request->all();
        $input['created_by'] = auth()->id();
        $input['updated_by'] = auth()->id();
        if ($this->userDetailModel->create($input)) {
            Session
            ::flash('flash_message', 'User details created successfully.');
            return redirect()->route('users.index');
        }
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userDetail = $this->userDetailModel->find($id);
        return view('users.show')
        ->withUserDetail($userDetail)
        ->withUsers($this->users)
        ->withUserTypes($this->userTypes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clients\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $userDetail = $this->userDetailModel->find($id);
        return view('users.show')
        ->withUserDetail($userDetail)
        ->withUsers($this->users)
        ->withUserTypes($this->userTypes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clients\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $userDetail = $this->userDetailModel->find($id);
        return view('users.edit')
        ->withUserDetail($userDetail)
        ->withUsers($this->users)
        ->withUserTypes($this->userTypes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clients\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {

        $input = $request->all();
        $input['updated_by'] = auth()->id();
        $userDetail = $this->userDetailModel->findOrFail($id);
        if ($userDetail->fill($input)->save()) {
            Session::flash('flash_message', 'User details updated successfully.');
            return redirect()->route('users.index');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clients\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
