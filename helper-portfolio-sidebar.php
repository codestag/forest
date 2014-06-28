<div class="project-sidebar grid-3">
	<?php

	$project_details = array(
		'client' => esc_attr( get_post_meta(get_the_ID(), '_stag_portfolio_client', true) ),
		'date'   => get_post_meta(get_the_ID(), '_stag_portfolio_date', true),
		'url'    => esc_url( get_post_meta(get_the_ID(), '_stag_portfolio_url', true) )
	);

	$skills = get_the_terms(get_the_ID(), 'skill');
	$project_date = stag_date('m', $project_details['date']) .'/'. stag_date('d', $project_details['date']) . '/'. stag_date('Y', $project_details['date']);

	if( array_filter( $project_details ) || $skills) {
		?>
		<h4><?php _e('Project Details', 'stag'); ?></h4>
		<?php

		$skill = '';

		if ( $skills ) {
			foreach( $skills as $ski ) {
				$skill[] .= $ski->name;
			}
			$skill = implode($skill, ', ');
		}

		if($skill != ''){
			echo "<li><span>". __('Category', 'stag') .": </span>{$skill}</li>";
		}

		if($project_details['date'] != ''){
			echo "<li><span>". __('Project Date', 'stag') .": </span>{$project_date}</li>";
		}

		if($project_details['client'] != ''){
			echo "<li><span>". __('Client', 'stag') .": </span>{$project_details['client']}</li>";
		}

		if($project_details['url'] != ''){
			echo "<li><a href='{$project_details['url']}' target='_blank' class='button'>". __('Go to Project', 'stag') ."</a></li>";
		}
	}

	?>
</div>
