<?php

class NewsController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['store', 'update']]);   
    }


    public function index()
    {
        $data = ['news' => News::notDeleted()->get()];

        return View::make('cms.news.index', $data); // return View('pages.about');
    }


    public function show($id)
    {
        $record = News::findOrFail($id);

        $subcategory = Subcategories::findOrFail($record->subcategory_id);

        $category = Categories::findOrFail($subcategory->category_id);

        $data = ['record' => $record, 'subcategory' => $subcategory, 'category' => $category];

        return View::make('pages.news', $data); // return View('pages.about');
    }


    public function create()
    {
        $subcategories = Subcategories::join('categories', 'categories.id', '=', 'subcategories.category_id')->select('subcategories.*', 'categories.name as category')->where('subcategories.status', 'active')->orderBy('categories.id')->orderBy('subcategories.id')->get();

        $data = ['subcategories' => $subcategories];

        return View::make('cms.news.create', $data);
    }


    public function store()
    {
        $upload_document = $this->uploadDocument();

        if ($upload_document === -1) return Redirect::to("cms/news/create?error=文件过大！");

        try 
        {
            News::create([
                'title'          => Input::get('title'),
                'content'        => Input::get('content'),
                'date'           => date('Y-m-d', strtotime(Input::get('date'))),
                'author'         => Input::get('author'),
                'subcategory_id' => Input::get('subcategory_id'),
                'document'       => $upload_document,
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Create News] '.$e->getMessage());

            return Redirect::to("cms/news/create?error=参数有误!");
        }

        return Redirect::to("cms/news/create?success=创建成功");
    }


    public function edit($id)
    {
        $subcategories = Subcategories::join('categories', 'categories.id', '=', 'subcategories.category_id')->select('subcategories.*', 'categories.name as category')->where('subcategories.status', 'active')->orderBy('categories.id')->orderBy('subcategories.id')->get();

        $article = News::find($id);

        $data = ['subcategories' => $subcategories, 'article' => $article];

        return View::make('cms.news.edit', $data);
    }

    public function update($id)
    {
        $upload_document = $this->uploadDocument();

        if ($upload_document === -1) return Redirect::to("cms/news/create?error=文件过大！");

        try 
        {
            News::where('id', $id)->update([
                'title'          => Input::get('title'),
                'content'        => Input::get('content'),
                'date'           => date('Y-m-d', strtotime(Input::get('date'))),
                'author'         => Input::get('author'),
                'subcategory_id' => Input::get('subcategory_id'),
                'document'       => $upload_document,
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Update News] '.$e->getMessage());

            return Redirect::to("cms/news/{$id}/edit?success=参数有误!");
        }

        return Redirect::to("cms/news/{$id}/edit?success=创建成功");
    }


    public function destroy($id)
    {
        News::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }
}
