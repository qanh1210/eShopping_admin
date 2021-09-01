<?php

namespace App\Http\Controllers;

use App\Components\MenuRecusive;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class MenuController extends Controller
{
    use DeleteModelTrait;
    private $menuRecusive;
    public function __construct(MenuRecusive $menuRecusive, Menu $menu){
        $this->menuRecusive = $menuRecusive;
        $this->menu = $menu;
    }

    public function index(){
        $list = DB::table('menus','m1')
        ->select(
            'm1.id',
            'm1.name',
            'm2.name as parent_name',
        )

        -> leftJoin('menus as m2','m1.parent_id','=','m2.id')
        ->orderBy('m1.created_at', 'ASC')
        ->paginate(5);
        return view('admins.menus.index',compact('list'));
    }

    public function create(){

        $htmlOptions = $this->menuRecusive->menuRecusiveAdd($parent_id='');
        return view('admins.menus.add',compact('htmlOptions'));
    }

    public function store(Request $request){
        $this->menu->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('menus.index');
    }

    public function edit(Request $request,$id){
        $menuEdit = $this->menu->find($id);
        $htmlOptions = $this->menuRecusive->menuRecusiveEdit($menuEdit->parent_id);
        return view('admins.menus.edit',compact('htmlOptions','menuEdit'));
    }

    public function update($id,Request $request){
        $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('menus.index');
    }

    public function delete($id){
      return $this->deleteModelTrait($id,$this->menu);
    }


}
