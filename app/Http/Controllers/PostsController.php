<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Events\AddDiscussions;
use App\Markdown\Markdown;
use Illuminate\Http\Request;
use EndaEditor;
use App\Http\Requests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class PostsController extends Controller
{
    protected $markdown;
    public function __construct(Markdown $markdown)
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'update']]);
        $this->markdown = $markdown;
    }

    public function index()
    {
        $discussions = Discussion::latest()->paginate(5);
        foreach($discussions as &$discussion){
            $discussion->body = $this->markdown->markdown($discussion->body);
        }

                //将其数据存储到reids中
    //        Redis::set('discussions', $discussions);
    //        dd(Redis::get('discussions'));
    //            echo '您好';
       
        return view('forum.index',compact('discussions'));
    }

    /*
     * @param int $id
     * return response
     * */
    public function show($id)
    {
        $discussion = Discussion::findOrFail($id);
        foreach($discussion->comment as &$comments){
            $comments->body = $this->markdown->markdown($comments->body);
        }
        $html = $this->markdown->markdown($discussion->body);
        return view('forum.show', compact('discussion', 'html'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Requests\StoreBlogPostRequest $request)
    {
        $data = [
            'user_id' => \Auth::user()->id,
            'last_user_id' => \Auth::user()->id,
        ];

        $discussion = Discussion::create(array_merge($request->all(), $data));
        //触发监听事件
        \Event::fire(new AddDiscussions($discussion));
        return redirect()->action('PostsController@show', ['id' => $discussion->id]);

    }

    public function edit($id)
    {
        $discussion = Discussion::findOrFail($id);

        if ((int) \Auth::user()->id != (int) $discussion->user_id) {
            return redirect('/');
        }

        return view('forum.edit', compact('discussion'));
    }

    public function update(Requests\StoreBlogPostRequest $request, $id)
    {
        $discussion = Discussion::findOrFail($id);

        $discussion->update($request->all());

        //触发监听事件 
        \Event::fire(new AddDiscussions($discussion));

        return redirect()->action('PostsController@show', ['id' => $discussion->id]);
    }

    public function upload()
    {
        $data = EndaEditor::uploadImgFile('uploads');

        return json_encode($data);
    }
}
