<?php
Route::get('pass', function () {
    return bcrypt(123456);
});
Route::pattern('slug','(.*)');
Route::pattern('id','([0-9]*)');

Route::get('', 'Motel\indexController@index')->name('motel.index.index');
Route::post('time-pin-rooms','Motel\indexController@timePinRooms')->name('motel.room.timePinRooms');
Route::get('/recharge', 'Payment\RechargeController@recharge')->name('motel.room.recharge');
Route::post('/recharge', 'Payment\RechargeController@ajaxRecharge')->name('motel.room.recharge');
Route::get('/detail-room/{slug}-{idRoom}', 'Motel\DetailRoomController@detailRoom')->name('motel.room.detail');
Route::get('/customer', 'Motel\CustomerController@index')->name('motel.customer.index');
// Route::get('/book-room/{idRoom}', 'Motel\BookRoomController@bookRoom')->name('motel.room.book_room');
// Route::post('/book-room/{idRoom}', 'Motel\BookRoomController@postBookRoom')->name('motel.room.book_room');
// Route::post('/serviceUpdateAjax', 'Motel\BookRoomController@serviceUpdateAjax')->name('motel.room.serviceUpdateAjax');
// Route::post('/ajaxRentalForm', 'Motel\BookRoomController@ajaxRentalForm')->name('motel.room.ajaxRentalForm');
// Route::post('/checkout', 'Motel\BookRoomController@checkout')->name('motel.room.checkout');

Route::post('/payment','Payment\RechargeController@payment')
->name('motel.room.payment');
//payment vnpay
Route::get('/payment','Payment\RechargeController@getpayment')
->name('payment-vnpay');

Route::prefix('/auth')->group(function(){
    //public 
    Route::get('/login', 'Auth\AuthController@login')->name('motel.auth.login');
    Route::post('/login', 'Auth\AuthController@postLogin')->name('motel.auth.login');
    Route::get('/register', 'Auth\AuthController@register')->name('motel.auth.register');
    Route::post('/register', 'Auth\AuthController@postRegister')->name('motel.auth.register');
    Route::get('/paymentRegister', 'Auth\AuthController@paymentRegister')->name('motel.auth.paymentRegister');
    Route::post('/paymentRegisterAjax', 'Auth\AuthController@paymentRegisterAjax')->name('motel.auth.paymentRegisterAjax');
    Route::post('/ajax', 'Auth\AuthController@priceApp')->name('motel.auth.priceApp');
    //Route::post('/payment', 'Auth\AuthController@payment')->name('motel.auth.payment');

    Route::post('/payment','Auth\AuthController@payment')->name('motel.auth.payment');
    //payment vnpay
    Route::get('/payment','Auth\AuthController@getpayment')->name('payment-vnpay-register');
    Route::get('/logoutAdmin', 'Auth\AuthController@logoutAdmin')->name('auth.auth.logout');
    //system
    Route::get('/loginSystem', 'Auth\AuthController@loginSystem')->name('system.auth.login');
    Route::post('/loginSystem', 'Auth\AuthController@postLoginSystem')->name('system.auth.login');
    
});
       
Route::prefix('admin')->middleware('role')->group(function () {
    Route::get('', 'Admin\AdminIndexController@index')->name('admin.index.index');
    Route::post('/checkRoom', 'Admin\AdminIndexController@addCheckRoom')->name('admin.index.addCheckRoom');
    Route::post('/ajaxRentalForm', 'Admin\AdminIndexController@ajaxRentalForm')->name('admin.index.ajaxRentalForm');
    Route::post('/serviceUpdateAjax', 'Admin\AdminIndexController@serviceUpdateAjax')->name('admin.index.serviceUpdateAjax');
    Route::post('/revenue', 'Admin\AdminIndexController@revenueAjax')->name('admin.index.revenueAjax');
    Route::post('/yearOrderAjax', 'Admin\AdminIndexController@yearOrderAjax')->name('admin.index.yearOrderAjax');
    
    Route::prefix('/floor')->group(function(){
        Route::get('', 'Admin\AdminFloorController@index')->name('admin.floor.index');
        Route::get('/add', 'Admin\AdminFloorController@add')->name('admin.floor.add');
        Route::post('/add', 'Admin\AdminFloorController@postAdd')->name('admin.floor.add');
        Route::get('/edit/{Id_floor}', 'Admin\AdminFloorController@edit')->name('admin.floor.edit');
        Route::post('/edit/{Id_floor}', 'Admin\AdminFloorController@postEdit')->name('admin.floor.edit');
        Route::get('/delete/{Id_floor}', 'Admin\AdminFloorController@delete')->name('admin.floor.delete');
        Route::post('/ajax', 'Admin\AdminFloorController@ajaxstatus')->name('admin.floor.ajaxStatus');
    });
    Route::prefix('/room-type')->group(function(){
        Route::get('', 'Admin\AdminRoomTypeController@index')->name('admin.roomtype.index');
        Route::get('/add', 'Admin\AdminRoomTypeController@add')->name('admin.roomtype.add');
        Route::post('/add', 'Admin\AdminRoomTypeController@postAdd')->name('admin.roomtype.add');
        Route::get('/edit/{Id_roomtype}', 'Admin\AdminRoomTypeController@edit')->name('admin.roomtype.edit');
        Route::post('/edit/{Id_roomtype}', 'Admin\AdminRoomTypeController@postEdit')->name('admin.roomtype.edit');
        Route::get('/delete/{Id_roomtype}', 'Admin\AdminRoomTypeController@delete')->name('admin.roomtype.delete');
        Route::post('/ajax', 'Admin\AdminRoomTypeController@ajaxstatus')->name('admin.roomtype.ajaxstatus');
    });
    Route::prefix('/service')->group(function(){
        Route::get('', 'Admin\AdminServiceController@index')->name('admin.service.index');
        Route::get('/add', 'Admin\AdminServiceController@add')->name('admin.service.add');
        Route::post('/add', 'Admin\AdminServiceController@postAdd')->name('admin.service.add');
        Route::get('/edit/{id_service}', 'Admin\AdminServiceController@edit')->name('admin.service.edit');
        Route::post('/edit/{id_service}', 'Admin\AdminServiceController@postEdit')->name('admin.service.edit');
        Route::get('/delete/{id_service}', 'Admin\AdminServiceController@delete')->name('admin.service.delete');
        Route::post('/ajax', 'Admin\AdminServiceController@ajaxstatus')->name('admin.service.ajaxstatus');
    });
    Route::prefix('/room')->group(function(){
       Route::get('', 'Admin\AdminRoomController@index')->name('admin.room.index');
       Route::get('/add', 'Admin\AdminRoomController@add')->name('admin.room.add');
       Route::post('/add', 'Admin\AdminRoomController@postAdd')->name('admin.room.add');
       Route::get('/edit/{idRoom}', 'Admin\AdminRoomController@edit')->name('admin.room.edit');
       Route::post('/edit/{idRoom}', 'Admin\AdminRoomController@postEdit')->name('admin.room.edit');
       Route::get('/delete/{idRoom}', 'Admin\AdminRoomController@delete')->name('admin.room.delete');
       Route::post('/ajax', 'Admin\AdminRoomController@ajaxstatus')->name('admin.room.ajaxstatus');
       Route::post('/pinRooms', 'Admin\AdminRoomController@pinRooms')->name('admin.room.pinRooms');
    });
    Route::prefix('/order-Room')->group(function(){
        Route::get('', 'Admin\AdminOrderRoomController@index')->name('admin.order.index');
        Route::post('/ajax', 'Admin\AdminOrderRoomController@ajaxstatus')->name('admin.order.ajaxstatus');
        Route::post('/date-ajax', 'Admin\AdminOrderRoomController@searchDate')->name('admin.order.searchDate'); 
    });
    Route::prefix('/room-live-in')->group(function(){
        Route::post('/payment', 'Admin\AdminOrderRoomController@payment')->name('admin.order_room.payment');
        Route::post('/dien-nuoc', 'Admin\AdminOrderRoomController@thanhToanDienNuoc')->name('admin.order_room.paymentAjax');
        Route::post('/print-dN', 'Admin\AdminOrderRoomController@printFast')->name('admin.order_room.printFast');
        Route::post('/payment-room', 'Admin\AdminOrderRoomController@paymentRoom')->name('admin.order_room.paymentRoom');
        Route::post('/thanhToan', 'Admin\AdminOrderRoomController@thanhToan')->name('admin.order_room.thanhToan');
        Route::post('/print', 'Admin\AdminOrderRoomController@print')->name('admin.order_room.print');  
    });
    Route::prefix('/customer')->group(function(){
        Route::get('', 'Admin\AdminCustomerController@index')->name('admin.customer.index');
    });
});


Route::prefix('system')->middleware('loginSystem')->group(function () {
    Route::get('', 'System\SystemIndexController@index')->name('system.index.index');
    Route::post('/revenue', 'System\SystemIndexController@revenueAjax')->name('system.index.revenueAjax');
    Route::post('/yearOrderAjax', 'System\SystemIndexController@yearOrderAjax')->name('system.index.yearOrderAjax');

    Route::prefix('/user')->group(function(){
        Route::get('', 'System\SystemUserController@index')->name('system.user.index');
    });

    Route::prefix('/bank-user')->group(function(){
        Route::get('', 'System\SystemBankUserController@index')->name('system.bankUser.index');
    });

});

