<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Components\Recusive;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    use DeleteModelTrait;

    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index(Request $request)
    {
        // $list = $this->category->latest()->paginate(5);
        $list = DB::table('categories', 'c1')
            ->select(
                'c1.id',
                'c1.name',
                'c2.name as parent_name',
                'c1.slug'
            )
            ->leftJoin('categories as c2', 'c1.parent_id', '=', 'c2.id')
            ->orderBy('c1.id', 'ASC')
            ->simplePaginate(15);
        if($request->ajax()){
            return view('admins.category.list',compact('list'))->render();
        }
        return view('admins.category.index', compact('list'));

    }

    public function create()
    {
        $htmlOptions = $this->getCategory($parent_id = '');
        return view('admins.category.add', compact('htmlOptions'));
    }

    public function store(Request $request)
    {
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => $request->slug
        ]);
        return redirect()->route('categories.index');
    }

    public function storeNewParent(Request $request)
    {
        $this->category->create([
            'name' => $request->name,
            'parent_id' => 0,
            'slug' => $request->slug
        ]);
        return redirect()->route('categories.create');
    }

    public function getCategory($parent_id)
    {
//        $data = $this->category->all();
        $data = Category::all(['id', 'name','parent_id']);
        $recursive = new Recusive($data);
        $htmlOptions = $recursive->categoryRecusive($parent_id);
        return $htmlOptions;
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $category = Category::select(['id', 'name','slug'])->find($id);
        $htmlOptions = $this->getCategory($category->parent_id);
        return view('admins.category.edit', compact('category', 'htmlOptions'));
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->category);
    }

    public function update(Request $request, $id)
    {
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => $request->slug
        ]);
        return redirect()->route('categories.index');

    }

    public function destroy($id)
    {
        //
    }
}
