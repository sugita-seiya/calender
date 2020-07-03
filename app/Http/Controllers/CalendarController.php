<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;        //$requestが扱える。
use App\Holiday;                    // Holidayモデルクラスの呼び出し
use App\Calendar;                   //Calendarモデルクラスの呼び出し。

class CalendarController extends Controller
{

    // 休日データ一覧
    public function getHoliday(Request $request)
    {
        $data = new Holiday();
        $list = Holiday::all();
        return view('calendar.holiday', ['list' => $list,'data' => $data]);
    }

    //休日データの編集
    public function getHolidayId($id)
    {
        $data = new Holiday();
        if (isset($id)) {
            $data = Holiday::where('id', '=', $id)->first();
        }
        $list = Holiday::all();
        return view('calendar.holiday', ['list' => $list, 'data' => $data]);
    }

    // POSTで受信した休日データの登録
    public function postHoliday(Request $request)
    {
        // バリデーション設定
        $validatedData = $request->validate([
            'day' => 'required|date_format:Y-m-d',
            'description' => 'required',
        ]);
        if (isset($request->id)) {
            $holiday = Holiday::where('id', '=', $request->id)->first();
            $holiday->day = $request->day;
            $holiday->description = $request->description;
            $holiday->save();
        } else {
            $holiday = new Holiday();
            $holiday->day = $request->day;
            $holiday->description = $request->description;
            $holiday->save();
        }
        // 休日データ取得
        $data = new Holiday();
        $list = Holiday::all();
        return view('calendar.holiday', ['list' => $list, 'data' => $data]);
    }

    // カレンダー表の表示
    public function index(Request $request)
    {
        $list = Holiday::all();
        $cal = new Calendar($list);
        $tag = $cal->showCalendarTag($request->month,$request->year);
        return view('calendar.index',['cal_tag'=>$tag]);
    }

    //休日データの削除
    public function deleteHoliday(Request $request)
    {
        // DELETEで受信した休日データの削除
        if (isset($request->id)) {
            $holiday = Holiday::where('id', '=', $request->id)->first();
            $holiday->delete();
        }
        // 休日データ取得
        $data = new Holiday();
        $list = Holiday::all();
        return view('calendar.holiday', ['list' => $list, 'data' => $data]);
    }
}