<?php

Route::get('/holiday','CalendarController@getHoliday');           // 休日データの取得
Route::post('/holiday','CalendarController@postHoliday');         //POSTで受信した休日データの登録
Route::get('/','CalendarController@index');                       //カレンダー表の表示
Route::get('/holiday/{id}','CalendarController@getHolidayId');
Route::delete('/holiday','CalendarController@deleteHoliday');

// Route::get('/', function () {
//     return view('calendar.holiday');
// });
