<?php

Route::get('/{currency?}', \Domain\Commerce\Actions\ProductList::class)->name('commerce');

Route::prefix('_')->group(function () {
    Route::post('/checkout', \Domain\Commerce\Actions\Checkout::class)->name('checkout');
    Route::get('/checkout', \Domain\Commerce\Actions\CheckoutView::class)->name('checkout.view');
    Route::get('/orders/{email?}', \Domain\Commerce\Actions\OrderList::class)->name('orders');
    Route::post('/create-order', \Domain\Commerce\Actions\OrderCreate::class)->name('order.create');
    Route::put('/order/{reference}/cancel', \Domain\Commerce\Actions\OrderCancel::class)->name('order.cancel');
    Route::put('/order/{reference}/update', \Domain\Commerce\Actions\OrderUpdate::class)->name('order.update');
    Route::get('/order/{reference}/payment', \Domain\Commerce\Actions\OrderPaymentView::class)->name('order.pay.view');
    Route::get('/order/{reference}', \Domain\Commerce\Actions\OrderView::class)->name('order.view');
    Route::post('/order/{reference}/payment', \Domain\Commerce\Actions\OrderPayment::class)->name('order.pay');
    Route::post('/transaction/{reference}/verify', \Domain\Commerce\Actions\TransactionVerify::class)->name('transaction.verify');
    Route::post('/transaction/{reference}/otp', \Domain\Commerce\Actions\ValidateOtp::class)->name('otp.validate');
    Route::post('/flw/callback/{reference}', \Domain\Commerce\Actions\PostFlwCallback::class)->name('post.flw.callback');
});

Route::get('/flw/callback', \Domain\Commerce\Actions\GetFlwCallback::class)->name('get.flw.callback');
