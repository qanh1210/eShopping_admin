<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\Recusive;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    use DeleteModelTrait;
    private $category;
    public function __construct(Category $category){
        $this->category = $category;

    }
    public function index()
    {
        // $list = $this->category->latest()->paginate(5);
        $list = DB::table('categories','c1')
        ->select(
            'c1.id',
            'c1.name',
            'c2.name as parent_name',
        )

        -> leftJoin('categories as c2','c1.parent_id','=','c2.id')
        ->orderBy('c1.created_at', 'ASC')
        ->paginate(5);

        return view('admins.category.index',compact('list'));
    }




    public function create()
    {
        $htmlOptions = $this->getCategory($parent_id='');
        return view('admins.category.add',compact('htmlOptions'));
    }

    public function store(Request $request)
    {
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        //
    }

    public function getCategory($parent_id){
        $data = $this->category->all();
        $recursive = new Recusive($data);
        $htmlOptions = $recursive -> categoryRecusive($parent_id);
        return $htmlOptions;
    }

    public function edit($id)
    {
        $category = $this->category->find($id);
        $htmlOptions = $this->getCategory($category->parent_id);
        return view('admins.category.edit',compact('category','htmlOptions'));
    }

    public function delete($id)
    {
      return $this->deleteModelTrait($id,$this->category);
    }

    public function update(Request $request,$id)
    {
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('categories.index');

    }

    public function destroy($id)
    {
        //
    }
}
