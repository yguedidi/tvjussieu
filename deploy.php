<?php

require 'recipe/common.php';

server('alwaysdata_production', 'ssh-tvjussieu.alwaysdata.net', 22)
	->user('tvjussieu')
	->forwardAgent()
	->stage('production')
	->env('deploy_path', '/home/tvjussieu/site/production');

server('alwaysdata_staging', 'ssh-tvjussieu.alwaysdata.net', 22)
	->user('tvjussieu')
	->forwardAgent()
	->stage('staging')
	->env('deploy_path', '/home/tvjussieu/site/staging');

set('repository', 'file:///home/tvjussieu/tvjussieu.git');

set('shared_dirs', ['web/app/uploads']);
set('shared_files', ['.env', 'web/.htaccess']);

set('writable_dirs', []);

set('keep_releases', 3);

task('deploy', [
	'deploy:prepare',
	'deploy:release',
	'deploy:update_code',
	'deploy:shared',
	'deploy:vendors',
	'deploy:symlink',
	'cleanup',
])->desc('Deploy your project');

after('deploy', 'success');
