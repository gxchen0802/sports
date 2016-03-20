<?php

class QuestionairesController extends BaseController {

    const PER_PAGE = 20;

    public function __construct()
    {
        $this->beforeFilter('admin');

        $this->beforeFilter('csrf', ['only' => ['store', 'vote']]);  
    }

    public function create()
    {
        return View::make('cms.questionaires.create');
    }

    public function store()
    {
        try 
        {
            $questionaire_id = Questionaires::insertGetId([
                'title'       => Input::get('name'),
                'start_time'  => Input::get('startTime'),
                'end_time'    => Input::get('endTime'),
                // 'type'        => Input::get('type'),
                'status'      => Input::get('status'),
                'description' => Input::get('description'),
                ]);

            $questions = Input::get('undefined');

            foreach ($questions as $q) 
            {
                $question = $q['title'];  // string

                // Insert Questions:
                $question_id = Questions::insertGetId([
                        'questionaire_id' => $questionaire_id,
                        'question'        => $question,
                    ]);

                // Insert Answers:
                $answers = explode(' ', $q['option']); // array

                $rows = [];

                foreach ($answers as $answer) 
                {
                    $row = [];
                    $row['questionaire_id'] = $questionaire_id;
                    $row['question_id']     = $question_id;
                    $row['answer']          = trim($answer);

                    $rows[]= $row;                    
                }

                Answers::insert($rows);
            }
        } 
        catch (Exception $e) 
        {
            Log::error('[Create Questionaires] '.$e->getMessage());

            $error_response = [
                'code'    => 400,
                'message' => '创建失败',
                'result'  => $e->getMessage()
            ];

            return $error_response;
        }

        $response = [
            'code'    => 200,
            'message' => '创建成功',
            'result'  => 'success'
        ];

        return $response;
    }

    public function index()
    {
        $questionaires = Questionaires::notDeleted()->orderBy('created_at', 'desc')->paginate(self::PER_PAGE);

        $current_page = Input::get('page') ? (int)Input::get('page') : 1;

        $total_pages = $questionaires->getLastPage();

        $previous_page = ($current_page - 1 <= 0) ? 1 : ($current_page - 1);

        $next_page = ($current_page + 1 > $total_pages) ? $total_pages : ($current_page + 1);

        $start_index = $questionaires->getFrom();

        $end_index = $questionaires->getTo();

        $data = [
            'questionaires' => $questionaires,
            'total_pages'   => $total_pages,
            'start_index'   => $start_index,
            'end_index'     => $end_index,
            'current_page'  => $current_page,
            'previous_page' => $previous_page,
            'next_page'     => $next_page,
            ];

        return View::make('cms.questionaires.index', $data);
    }

    public function show($questionaire_id)
    {
        $data = [];

        $questionaire = Questionaires::where('id', $questionaire_id)->notExpire()->isActive()->first();

        $vote_history = VoteHistory::where('questionaire_id', $questionaire_id)->where('ip', Request::ip())->first();

        $data['questionaire_expired'] = false;
        $data['already_voted']        = false;

        if ( ! $questionaire) 
        {
            $data['questionaire_expired'] = true;

            return View::make('pages.questionaires', $data);
        }
        elseif ($vote_history) 
        {
            $data['already_voted'] = true;

            return View::make('pages.questionaires', $data);
        }
        else
        {
            $data['questionaire'] = $questionaire;
        }

        if ($questionaire->type == 'multiple') 
        {
            $data['radio_checkbox'] = 'checkbox';
        }
        else 
        {
            $data['radio_checkbox'] = 'radio';
        }

        // Format the questions to be : 
        // 
        // ['question_id' => ['answer_id', 'answer', 'question'],
        //  ...
        // ]
        $quesitons = Questions::join('questionaires_answers', 'questionaires_questions.id', '=', 'questionaires_answers.question_id')
            ->select(
                'questionaires_questions.id as question_id', 
                'questionaires_questions.question as question', 
                'questionaires_answers.id as answer_id', 
                'questionaires_answers.answer')
            ->where('questionaires_questions.questionaire_id', $questionaire_id)->get();

        $quesitons_array = [];

        foreach ($quesitons as $q) 
        {
            $a = ['answer_id' => $q->answer_id, 'answer' => $q->answer, 'question' => $q->question];

            $quesitons_array[$q->question_id][] = $a;
        }

        $data['questions'] = $quesitons_array;

        return View::make('pages.questionaires', $data);

    }

    public function vote($questionaire_id)
    {
        $rows = [];

        foreach (Input::all() as $key => $value) 
        {
            if ($key == '_token') continue;

            $row = [];
            $row['questionaire_id'] = $questionaire_id;
            $row['question_id']     = $key;
            $row['answer_id']       = $value;

            $rows[]= $row;
        }        

        try 
        {
            VoteHistory::create([
                'questionaire_id' => $questionaire_id,
                'ip' => Request::ip(),
                ]);

            Votes::insert($rows);
        } 
        catch (Exception $e) 
        {
            Log::error('[Questionaires Vote] '.$e->getMessage());

            return Redirect::to("/questionaires/{$questionaire_id}?result=error");
        }

        return Redirect::to("/questionaires/{$questionaire_id}?result=success");
    }

    public function edit($questionaire_id)
    {
        $questionaire = Questionaires::find($questionaire_id);

        $data['questionaire'] = $questionaire;

        return View::make('cms.questionaires.edit', $data);
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
        Questionaires::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }
}
