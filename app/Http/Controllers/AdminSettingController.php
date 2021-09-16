<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSettingRequest;
use App\Models\Setting;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use DeleteModelTrait;
    private $setting;
    public function __construct(Setting $setting){
        $this->setting = $setting;
    }
    public function index()
    {
        $list = $this->setting->latest()->get();
        return view('admins.setting.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.setting.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddSettingRequest $request)
    {
        $this->setting -> create([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
            'type' => $request->type
        ]);
        return redirect()->route('setting.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $settingEdit = $this->setting->find($id);
        return view('admins.setting.edit', compact('settingEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddSettingRequest $request, $id)
    {
        $this->setting->find($id)->update([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
        ]);
        return redirect()->route('setting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id){
        return $this->deleteModelTrait($id,$this->setting);
    }
}
