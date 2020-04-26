<?php














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