<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Http\Requests\ProductAddRequest;
use App\Models\Collections;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;


class AdminProductController extends Controller
{
    use DeleteModelTrait;
    use StorageImageTrait;

    private $category;
    private $product;
    private $productImage;
    private $tags;
    private $productTag;
    private $collection;

    public function __construct(Category $category, Product $product, ProductImage $productImage,
                                Tag      $tag, ProductTag $productTag, Collections $collection)
    {
        $this->product = $product;
        $this->category = $category;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
        $this->collection = $collection;
    }

    public function index(Request $request)
    {
        $list = $this->product->select('id', 'name', 'price', 'feature_image_path', 'category_id')->latest('id')->simplePaginate(5);
//        $list = Product::all(['id','name','price','feature_image_path','category_id']);
//        $list = DB::table('products')->select('id','name','price','feature_image_path','category_id')->get();
        if($request->ajax()){
            return view('admins.product.list',compact('list'))->render();
        }
        return view('admins.product.index', compact('list'));
    }

    public function create()
    {
        $parent_categories = $this->category->select('id', 'name')->where('parent_id', 0)->get();
        $htmlOptions = $this->getCategory($parent_id = '');
        $collections = $this->collection->select('id', 'name')->get();
        return view('admins.product.add', compact('htmlOptions', 'parent_categories', 'collections'));

    }

    public function getCategory($parent_id)
    {
        $data = $this->category->select('id', 'name', 'parent_id')->get();
        $recursive = new Recusive($data);
        $htmlOptions = $recursive->categoryRecusive($parent_id);
        return $htmlOptions;
    }

    public function store(ProductAddRequest $request)
    {
        try {
            DB::beginTransaction();
            //insert product to table Product
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => Auth::user()->id,
                'category_id' => $request->category_id,
            ];
            $dataUploadImage = $this->storageTraitUpload($request, 'feature_image', 'product');
            if (!empty($dataUploadImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadImage['file_path'];
            }

            $product = $this->product->create($dataProductCreate);

            //insert image detail to table Product_image
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }
            //insert tags for product
            $tagId = [];
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagId[] = $tagInstance->id;
                }
            }
            $product->tags()->attach($tagId);

            // insert collections
            $collectionId = [];
            if (!empty($request->collections)) {
                foreach ($request->collections as $collectionItem) {
                    $collectionInstance =  $this->collection->firstOrCreate(['name' => $collectionItem]);
                    $collectionId[] = $collectionInstance->id;
                }
            }
            $product->getCollections()->attach($collectionId);
            DB::commit();
            return redirect()->route('product.index');

        } catch (\Exception $exception) {
            DB::rollback();
            Log::error('Message: ' . $exception->getMessage() . 'Line: ' . $exception->getLine());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productEdit = $this->product->find($id);
        $htmlOptions = $this->getCategory($productEdit->category_id);
        $collections = $this->collection->select('id', 'name')->get();
        return view('admins.product.edit', compact('productEdit', 'htmlOptions','collections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            //edit product to table Product
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => Auth::user()->id,
                'category_id' => $request->category_id,
            ];
            $dataUploadImage = $this->storageTraitUpload($request, 'feature_image', 'product');
            if (!empty($dataUploadImage)) {
                $dataProductUpdate['feature_image_name'] = $dataUploadImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadImage['file_path'];
            }

            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);

            //edit image detail to table Product_image
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }


            //edit tags for product
            $tagId = [];
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagId[] = $tagInstance->id;
                }
            }
            $product->tags()->sync($tagId);

            //edit collections for product
            $collectionId = [];
            if (!empty($request->collections)) {
                foreach ($request->collections as $collectionItem) {
                    $collectionInstance = $this->collection->firstOrCreate(['name' => $collectionItem]);
                    $collectionId[] = $collectionInstance->id;
                }
            }
            $product->getCollections()->sync($collectionId);
            DB::commit();
            return redirect()->route('product.index');

        } catch (\Exception $exception) {
            DB::rollback();
            Log::error('Message: ' . $exception->getMessage() . 'Line: ' . $exception->getLine());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->product);
    }
}
