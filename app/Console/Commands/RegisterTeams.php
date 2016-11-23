<?php

namespace App\Console\Commands;

use App\Models\Team;
use Illuminate\Console\Command;

class RegisterTeams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:team';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register Teams in Database ange get logo and t-shirt image.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	    $base = 'http://fantasy.90tv.ir/';
	    $teams = json_decode(\File::get(storage_path('json/teams.json')), true);
	
	    foreach($teams as $key => $team) {
		    if(!\File::exists(public_path('assets/images/team/logo')))
			    \File::makeDirectory(public_path('assets/images/team/logo'), 493, true);
		    \File::put(public_path($team['logo']), file_get_contents($base . $team['logo']));
		    
		    $team['avatar'] = asset($team['logo']);
		    $teams[$key] = collect($team)->only('name', 'avatar', 'url')->toArray();
		     Team::create($team);
	    }
	    $this->info('ok');
    }
}
