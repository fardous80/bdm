<?php 

function form($method, $opt){

	return \App\Utils\Form::$method($opt);

}

function hook($key, $value=null){
	
	if(!$value) return \App\Utils\Hook::$key();

	return \App\Utils\Hook::$key($value);
}

function thumb($url, $size=50){
	return str_replace('.jpg', "-{$size}.jpg", $url);
}

function age($date){
	return \Carbon\Carbon::createFromFormat('Y-m-d', $date)
            ->diffInYears(\Carbon\Carbon::now());
}

function firstname($name){
	return explode(' ', $name)[0];
}

function _u($key, $user=null){
	$user = $user??auth()->user();
	return $user->{$key};
}

function _m($key, $user=null){
	if(!auth()->check()) return '';
	$user = $user??auth()->user();
	return $user->usermeta->{$key};
}

function _id(){
	return _u('id');
}

function _username(){
	return _u('username');
}

function _thumb($user=null){
	$user = $user??auth()->user();
	if(!is_null($user->usermeta->profile_image))
		return thumb($user->usermeta->profile_image);
	else
		return errorImage( $user->usermeta->gender, 50);
}

function imageExists($url){
	return \App\Utils\Image::exists( $url );
}

function _avatar($user=null){
	$user = $user ?? auth()->user();

	if( !is_null( $user->usermeta->profile_image) ){
		return $user->usermeta->profile_image;
	}else{
		return errorImage( $user->usermeta->gender, 260 );
	}
}

function errorImage($gender, $size){
	return '/img/' . strtolower($gender) . '-' . $size . '.jpg';  
}

function is_online($last){
	return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $last)
            ->diffInMinutes(\Carbon\Carbon::now()) < config('matrimony.is_online_duration');
}