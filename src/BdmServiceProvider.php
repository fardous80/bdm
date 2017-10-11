<?php 

namespace Bdm;

use Illuminate\Support\ServiceProvider;

class BdmServiceProvider extends ServiceProvider{

	public function boot()
	{
		
	}

	public function register()
	{
		// register routes
		$this->loadRoutesFrom(__DIR__.'/routes.php');
}