<?php

class CategoriesController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['store', 'update']]);   
    }


    public function index()
    {
        $data = ['categories' => Categories::notDeleted()->get()];

        return View::make('cms.categories.index', $data);
    }


    // public function show($id)
    // {
    //     $record = News::findOrFail($id);

    //     $data = ['record' => $record];

    //     return View::make('cms.news.show', $data); // return View('pages.about');
    // }


    public function create()
    {
        return View::make('cms.categories.create');
    }


    public function store()
    {
        try 
        {
            Categories::create([
                'name' => Input::get('name'),
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Create Categories] '.$e->getMessage());

            return Redirect::to("cms/categories/create?error=参数有误!");
        }
  
        return Redirect::to("cms/categories/create?success=创建成功");
    }


    public function edit($id)
    {
        $category = Categories::find($id);

        $data = ['category' => $category];

        return View::make('cms.categories.edit', $data);
    }

    public function update($id)
    {
        try 
        {
            Categories::where('id', $id)->update([
                'name' => Input::get('name'),
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Edit Categories] '.$e->getMessage());

            return Redirect::to("cms/categories/{$id}/edit?error=参数有误!");
        }

        return Redirect::to("cms/categories/{$id}/edit?success=创建成功");
    }


    public function destroy($id)
    {
        Categories::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }
}
