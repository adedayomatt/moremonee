<?php

Route::get('/', \Domain\Commerce\Actions\ProductList::class)->name('commerce');
Route::get('/checkout', \Domain\Commerce\Actions\Checkout::class)->name('commerce.checkout');
