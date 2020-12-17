<?php
	wp_enqueue_style( 'plugin-install' );
	wp_enqueue_script( 'plugin-install' );
	wp_enqueue_script( 'updates' );
	

if( !empty($this->required_plugins) ) {
	
		?>
		<div class="recomended-plugin-wrap ap-required-plugins">
		<?php
		foreach($this->required_plugins['free_plugins'] as $plugin) {
			
			$info = $this->call_plugin_api($plugin['slug']);

			$icon_url = $this->check_for_icon($info->icons);
			$status = $this->get_plugin_active($plugin);
			$btn_url = $this->generate_plugin_url($status, $plugin);

			switch($status) {
				case 'install' :
					$btn_class = 'install button';
					$label = $this->strings['install_n_activate'];
					break;

				case 'inactive' :
					$btn_class = 'deactivate button';
					$label = $this->strings['deactivate'];
					break;

				case 'active' :
					$btn_class = 'activate button button-primary';
					$label = $this->strings['activate'];
					break;
			}

			?>
				<div class="recom-plugin-wrap">
					<div class="recom-plugin-inner-wrap">
						<div class="plugin-img-wrap">
							<img src="<?php echo esc_url($icon_url); ?>" />
							
						</div>
						<div class="plugin-title-install clearfix">
							<?php if( $info->name ){ ?>
								<span class="title" title="<?php echo esc_attr($info->name); ?>">
									<?php echo esc_html($info->name); ?>
								</span>
							<?php } ?>

							<?php if( isset($plugin['info']) ){ ?>
								<p class="plugin-info">
									<?php echo esc_html($plugin['info']); ?>
								</p>
							<?php } ?>
								
							<span class="plugin-action-btn plugin-btn-wrapper plugin-card-<?php echo esc_attr($plugin['slug']); ?>" action_button>
								<a class="<?php echo esc_attr($btn_class); ?>" data-file="<?php echo esc_attr($plugin['filename']); ?>" data-slug="<?php echo esc_attr($plugin['slug']); ?>" href="<?php echo esc_url($btn_url); ?>"><?php echo esc_html($label); ?></a>
							</span>
							<div class="version-author-info free">
								<span class="version"><?php echo esc_html__('Version ', 'punte') . esc_html($info->version); ?></span>
								<span class="seperator">|</span>
								<span class="author"><?php echo wp_kses_post($info->author); ?></span>
							</div>
						</div>
					</div>
				</div>
			<?php
		} ?>
		</div>
	<?php
	}