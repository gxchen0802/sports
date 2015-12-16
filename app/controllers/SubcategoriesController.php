<?php

class SubcategoriesController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['store', 'update']]);   
    }


    public function index()
    {
        $subcategories = Subcategories::join('categories', 'categories.id', '=', 'subcategories.category_id')->select('subcategories.*', 'categories.name as category')->where('subcategories.status', 'active')->orderBy('categories.id')->orderBy('subcategories.id')->get();

        $data = ['subcategories' => $subcategories];

        return View::make('cms.subcategories.index', $data);
    }


    // public function show($id)
    // {
    //     $record = News::findOrFail($id);

    //     $data = ['record' => $record];

    //     return View::make('cms.news.show', $data); // return View('pages.about');
    // }


    public function create()
    {
        $categories = Categories::distinct('name')->notDeleted()->get();

        $data['categories'] = $categories;

        return View::make('cms.subcategories.create', $data);
    }


    public function store()
    {
        try 
        {
            Subcategories::create([
                'category_id'    => Input::get('category_id'),
                'name'           => Input::get('name'),
                'single_article' => Input::get('single_article'),
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Create Subcategories] '.$e->getMessage());

            return Redirect::to("cms/subcategories/create?error=参数有误!");
        }
  
        return Redirect::to("cms/subcategories/create?success=创建成功");
    }


    public function edit($id)
    {
        $categories = Categories::distinct('name')->notDeleted()->get();

        $subcategory = Subcategories::find($id);

        $data = [
            'categories'  => $categories,
            'subcategory' => $subcategory,
            ];

        return View::make('cms.subcategories.edit', $data);
    }

    public function update($id)
    {
        try 
        {
            Subcategories::where('id', $id)->update([
                'category_id'    => Input::get('category_id'),
                'name'           => Input::get('name'),
                'single_article' => Input::get('single_article'),
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Edit Subcategories] '.$e->getMessage());

            return Redirect::to("cms/subcategories/{$id}/edit?error=参数有误!");
        }

        return Redirect::to("cms/subcategories/{$id}/edit?success=创建成功");
    }


    public function destroy($id)
    {
        Subcategories::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }
}
