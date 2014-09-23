set :stage, :production

set :deploy_to, -> { "/homez.333/tvjussie/sites/v5.tvjussieu.com" }

fetch(:default_env).merge!(wp_env: :production)

