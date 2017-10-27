<?php
/**
 * Created by PhpStorm.
 * User: Bryan
 * Date: 9/22/2017
 * Time: 11:14 AM
 */
?>
<div class="card mini-agent" >
	<div class="card-image">
		<img class="card-img-top" src="<?php echo ($agent['thumbnail'] != '' ? $agent['thumbnail'] : get_template_directory_uri().'/img/agent-placeholder.jpg' ); ?>" alt="<?php echo $agent['name']; ?>" >
	</div>
	<div class="card-block">
		<h4 class="card-title"><?php echo $agent['name']; ?></h4>
		<h5 class="card-subtitle"><?php echo ($agent['title'] != '' ? $agent['title'] : 'Realtor' ); ?></h5>
		<ul class="contact-info">
			<?php if($agentEmail != ''){?><li class="email"><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:<?php echo $agentEmail; ?>" ><?php echo $agentEmail; ?></a></li><?php }else{ ?><li class="blank"></li><?php } ?>
			<?php if($agentPhone != ''){?><li class="phone"><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:<?php echo $agentPhone; ?>" ><?php echo $agentPhone; ?></a></li><?php }else{ ?><li class="blank"></li><?php } ?>
		</ul>

	</div>
	<div class="card-footer">
		<form class="form form-inline" action="/contact/" method="get" style="display:inline-block;" >
			<input type="hidden" name="reason" value="Just reaching out" />
			<input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>" />
			<input type="hidden" name="selected_agent" value="<?php echo $agent['name']; ?>" />
			<button type="submit" class="btn btn-primary btn-rounded" >Contact Me</button>
		</form>
		<a href="<?php echo $agent['link']; ?>" class="btn btn-primary btn-rounded">view profile</a>
	</div>
</div>
