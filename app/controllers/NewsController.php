<?php

class NewsController extends BaseController {

    public $current_worker_id;

    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['store', 'update']]);   

        $this->current_worker_id = Session::get('user_name');
    }


    public function index()
    {
        $data = ['news' => News::join('subcategories', 'news.subcategory_id', '=', 'subcategories.id')->join('categories', 'news.category_id', '=', 'categories.id')->select('news.*', 'subcategories.name as subcategory_name', 'categories.name as category_name')->where('news.status', 'active')->get()];

        return View::make('cms.news.index', $data); // return View('pages.about');
    }


    public function show($id)
    {
        $record = News::findOrFail($id);

        $subcategory = Subcategories::findOrFail($record->subcategory_id);

        $category = Categories::findOrFail($subcategory->category_id);

        // Training history:
        $training_history = null;

        if ($record->training_id && $this->current_worker_id)
        {
            $training_history = TrainingsAttendees::where('training_id', $record->training_id)->where('worker_id', $this->current_worker_id)->first();
        }

        $data = [
            'record'            => $record, 
            'subcategory'       => $subcategory, 
            'category'          => $category, 
            'training_history'  => $training_history, 
            'current_worker_id' => $this->current_worker_id
            ];

        return View::make('pages.news', $data); // return View('pages.about');
    }


    public function create()
    {
        $subcategories = Subcategories::join('categories', 'categories.id', '=', 'subcategories.category_id')->select('subcategories.*', 'categories.name as category')->where('subcategories.status', 'active')->orderBy('categories.id')->orderBy('subcategories.id')->get();

        $trainings = Trainings::notDeleted()->notOver()->get();

        $data = ['subcategories' => $subcategories, 'trainings' => $trainings];

        return View::make('cms.news.create', $data);
    }


    public function store()
    {
        $upload_document = $this->uploadDocument();

        if ($upload_document === -1) return Redirect::to("cms/news/create?error=文件过大！");

        try 
        {
            $subcategory = Subcategories::find(Input::get('subcategory_id'));

            News::create([
                'title'          => Input::get('title'),
                'content'        => Input::get('content'),
                'date'           => date('Y-m-d', strtotime(Input::get('date'))),
                'author'         => Input::get('author'),
                'category_id'    => $subcategory->category_id,
                'subcategory_id' => Input::get('subcategory_id'),
                'training_id'    => Input::get('training_id'),
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

        $trainings = Trainings::notDeleted()->notOver()->get();

        $article = News::find($id);

        $data = ['subcategories' => $subcategories, 'article' => $article, 'trainings' => $trainings];

        return View::make('cms.news.edit', $data);
    }

    public function update($id)
    {
        $upload_document = $this->uploadDocument();

        if ($upload_document === -1) return Redirect::to("cms/news/create?error=文件过大！");

        try 
        {
            $subcategory = Subcategories::find(Input::get('subcategory_id'));

            News::where('id', $id)->update([
                'title'          => Input::get('title'),
                'content'        => Input::get('content'),
                'date'           => date('Y-m-d', strtotime(Input::get('date'))),
                'author'         => Input::get('author'),
                'category_id'    => $subcategory->category_id,
                'subcategory_id' => Input::get('subcategory_id'),
                'training_id'    => Input::get('training_id'),
                'document'       => $upload_document,
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Update News] '.$e->getMessage());

            return Redirect::to("cms/news/{$id}/edit?success=参数有误!");
        }

        return Redirect::to("cms/news/{$id}/edit?success=编辑成功");
    }


    public function destroy($id)
    {
        News::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }
}
