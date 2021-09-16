<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SliderAddRequest;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteModelTrait;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use DeleteModelTrait;
    use StorageImageTrait;
    private $slider;
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }
    public function index()
    {
        $list = $this->slider->latest()->paginate(5);
        return view('admins.slider.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.slider.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'slogan' => $request->slogan,
                'description' => $request->description
            ];

            $dataImage = $this->storageTraitUpload($request, 'image_path', 'slider');
            if (!empty($dataImage)) {
                $data['image_name'] = $dataImage['file_name'];
                $data['image_path'] = $dataImage['file_path'];
            };
            $this->slider->create($data);
            DB::commit();
            return redirect()->route('slider.index');
        } catch (\Exception $exception) {
            DB::rollback();
            Log::error('Message: ' . $exception->getMessage() . 'Line: ' . $exception->getLine());
        }
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
        $sliderEdit = $this->slider->find($id);
        return view('admins.slider.edit', compact('sliderEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataUpdate = [
                'name' => $request->name,
                'slogan' => $request->slogan,
                'description' => $request->description
            ];

            $dataImageUpdate = $this->storageTraitUpload($request, 'image_path', 'slider');
            if (!empty($dataImageUpdate)) {
                $dataUpdate['image_name'] = $dataImageUpdate['file_name'];
                $dataUpdate['image_path'] = $dataImageUpdate['file_path'];
            };
            $this->slider->find($id)->update($dataUpdate);
            DB::commit();
            return redirect()->route('slider.index');
        } catch (\Exception $exception) {
            DB::rollback();
            Log::error('Message: ' . $exception->getMessage() . 'Line: ' . $exception->getLine());
        }
    }

    public function delete($id)
    {
       return $this->deleteModelTrait($id,$this->slider);
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
}
