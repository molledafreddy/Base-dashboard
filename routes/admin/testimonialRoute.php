<?php
/**
 * Batch Route Management
 **/


Route::get('testimonials', [
	'uses' => 'Admin\TestimonialController@index',
	'as' => 'admin.testimonial.index',
]);

Route::post('testimonial/store', [
	'uses' => 'Admin\TestimonialController@store',
	'as' => 'admin.testimonial.store',
]);

Route::put('testimonial/update/{id}', [
	'uses' => 'Admin\TestimonialController@update',
	'as' => 'admin.testimonial.update',
]);

Route::match(['get','post','put'],'/testimonial/{action}/{id?}', [
	'uses' => 'Admin\TestimonialController@handler',
	'as' => 'admin.testimonial.async',
]);

?>