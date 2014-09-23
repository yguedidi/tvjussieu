set :stage, :staging

set :deploy_to, -> { "/homez.333/tvjussie/sites/test.tvjussieu.com" }

fetch(:default_env).merge!(wp_env: :staging)

