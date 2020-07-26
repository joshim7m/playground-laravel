<?php


Route::get('tasks', ['uses'=>'TaskController@index', 'as'=>'tasks.index']);
Route::Group(['prefix' => 'task'], function(){
  Route::post('/', ['uses'=>'TaskController@store', 'as'=>'task.store']);
  Route::get('/{id}', ['uses'=>'TaskController@edit', 'as'=>'task.edit']);
  Route::put('/{id}', ['uses'=>'TaskController@update', 'as'=>'task.update']);
  Route::delete('/{id}', ['uses'=>'TaskController@destroy', 'as'=>'task.destroy']);
});



Route::get('customer', 'CustomerController@index')->name('customer.index');
Route::post('customer', 'CustomerController@store')->name('customer.store');



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




// Route::get('/sms/send/{to}', function(\Nexmo\Client $nexmo, $to){
//    $message = $nexmo->message()->send([
//         'to' => '+8801738354877',
//         'from' => '+8801875496520',
//         'text' => 'Sending SMS from Laravel'
//     ]);
//     Log::info('sent message: ' . $message['message-id']);
// })->name('sms/send');