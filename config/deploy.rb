set :application, 'TV Jussieu'
set :scm, :copy

server 'ftp.tvjussieu.com', user: 'tvjussie', port: 22, password: 'ueissujvt14', roles: %w{web app db}

set :log_level, :info

set :linked_files, %w{.env web/.htaccess}
set :linked_dirs, %w{web/app/uploads}

set :exclude_dir, [".env", "web/.htaccess", "web/app/uploads"]

before "deploy:starting", :composer_for_prod do
  run_locally do
    execute "composer update --ansi --no-interaction --no-dev"
  end
end

after "deploy:finished", :composer_for_dev do
  run_locally do
    execute "composer update --ansi --no-interaction --dev"
  end
end
