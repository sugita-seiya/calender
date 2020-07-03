<?php

Route::get('/holiday','CalendarController@getHoliday');           // 休日データ一覧
Route::post('/holiday','CalendarController@postHoliday');         //POSTで受信した休日データの登録
Route::get('/','CalendarController@index');                       //カレンダー表の表示
Route::get('/holiday/{id}','CalendarController@getHolidayId');    //休日データの編集
Route::delete('/holiday','CalendarController@deleteHoliday');     //休日データの削除

// Route::get('/', function () {
//     return view('calendar.holiday');
// });
