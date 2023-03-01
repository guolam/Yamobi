<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use App\Models\View;
use Auth;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $views = View::getAllOrderByUpdated_at();
        return response()->view('view.index', compact('views'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('view.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'view' => 'required | max:191',
            'description' => 'required',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('view.create')
                ->withInput()
                ->withErrors($validator);
        }
        // create()は最初から用意されている関数
        // 戻り値は挿入されたレコードの情報
        $result = View::create($request->all());
        // ルーティング「view.index」にリクエスト送信（一覧ページに移動）
        return redirect()->route('view.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $view = View::find($id);
        return response()->view('view.show', compact('view'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $view = View::find($id);
        return response()->view('view.edit', compact('view'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'view' => 'required | max:191',
            'description' => 'required',
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('view.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }
        //データ更新処理
        $result = View::find($id)->update($request->all());
        return redirect()->route('view.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $result = View::find($id)->delete();
        return redirect()->route('view.index');
    }

    public function mydata()
    {
        // Userモデルに定義したリレーションを使用してデータを取得する．
        $views = User::query()
            ->find(Auth::user()->id)
            ->userViews()
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->view('view.index', compact('views'));
    }
}
