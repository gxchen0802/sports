<?php

class MessageController extends BaseController {

    const PER_PAGE = 20;

    const COOL_DOWN = 10; // mins

    public function __construct()
    {
        $this->beforeFilter('worker', ['only' => ['store']]);

        $this->beforeFilter('csrf', ['only' => ['store']]);  
    }

    /**
     * Check if this request flooding
     * 
     * @return boolean [description]
     */
    private function isFlooding()
    {
        $cool_down = date('Y-m-d H:i:s', strtotime('-'.self::COOL_DOWN.' minute'));

        return Messages::where('user_ip', Request::ip())->where('created_at', '>=', $cool_down)->notDeleted()->first();
    }

    public function store()
    {
        $is_flooding = $this->isFlooding();

        if ($is_flooding) return Redirect::back();

        Messages::create([
            'message'  => Input::get('message'),
            'username' => Input::get('uname'),
            'user_ip'  => Request::ip(),
            ]);

        return Redirect::back();
    }

    public function index()
    {
        $is_flooding = $this->isFlooding();

        $messages = Messages::notDeleted()->orderBy('created_at', 'desc')->paginate(self::PER_PAGE);

        $current_page = Input::get('page') ? (int)Input::get('page') : 1;

        $total_pages = $messages->getLastPage();

        $previous_page = ($current_page - 1 <= 0) ? 1 : ($current_page - 1);

        $next_page = ($current_page + 1 > $total_pages) ? $total_pages : ($current_page + 1);

        $start_index = $messages->getFrom();

        $end_index = $messages->getTo();

        $data = [
            'messages'       => $messages,
            'total_pages'    => $total_pages,
            'start_index'    => $start_index,
            'end_index'      => $end_index,
            'current_page'   => $current_page,
            'previous_page'  => $previous_page,
            'next_page'      => $next_page,
            'disable_submit' => $is_flooding ? 'disabled' : '',
            ];

        return View::make('pages.messages', $data);
    }

    public function indexCMS()
    {
        $messages = Messages::notDeleted()->orderBy('created_at', 'desc')->paginate(self::PER_PAGE);

        $current_page = Input::get('page') ? (int)Input::get('page') : 1;

        $total_pages = $messages->getLastPage();

        $previous_page = ($current_page - 1 <= 0) ? 1 : ($current_page - 1);

        $next_page = ($current_page + 1 > $total_pages) ? $total_pages : ($current_page + 1);

        $start_index = $messages->getFrom();

        $end_index = $messages->getTo();

        $data = [
            'messages'       => $messages,
            'total_pages'    => $total_pages,
            'start_index'    => $start_index,
            'end_index'      => $end_index,
            'current_page'   => $current_page,
            'previous_page'  => $previous_page,
            'next_page'      => $next_page,
            ];

        return View::make('cms.messages.index', $data);
    }

    public function indexCMSUnreply()
    {
        $messages = Messages::notDeleted()->unreply()->orderBy('created_at', 'desc')->paginate(self::PER_PAGE);

        $current_page = Input::get('page') ? (int)Input::get('page') : 1;

        $total_pages = $messages->getLastPage();

        $previous_page = ($current_page - 1 <= 0) ? 1 : ($current_page - 1);

        $next_page = ($current_page + 1 > $total_pages) ? $total_pages : ($current_page + 1);

        $start_index = $messages->getFrom();

        $end_index = $messages->getTo();

        $data = [
            'messages'       => $messages,
            'total_pages'    => $total_pages,
            'start_index'    => $start_index,
            'end_index'      => $end_index,
            'current_page'   => $current_page,
            'previous_page'  => $previous_page,
            'next_page'      => $next_page,
            ];

        return View::make('cms.messages.index_unreply', $data);
    }

    public function edit($id)
    {
        $message = Messages::find($id);

        $data['message'] = $message;

        return View::make('cms.messages.edit', $data);
    }

    public function update($id)
    {
        try 
        {
            Messages::where('id', $id)->update([
                'username'     => Input::get('username'),
                'message'      => Input::get('message'),
                'reply'        => Input::get('reply'),
                'reply_author' => Input::get('reply_author'),
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Edit Message] '.$e->getMessage());

            return Redirect::to("cms/messages/{$id}/edit?error=参数有误!");
        }

        return Redirect::to("cms/messages/{$id}/edit?success=编辑成功");
    }

    public function destroy($id)
    {
        Messages::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }
}
