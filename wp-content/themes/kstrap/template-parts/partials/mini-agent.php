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
		<img class="card-img-top" src="<?php echo $agentData['thumbnail']; ?>" alt="<?php echo $agentData['name']; ?>" >
	</div>
	<div class="card-block">
		<h4 class="card-title"><?php echo $agentData['name']; ?></h4>
		<h5 class="card-subtitle"><?php echo ($agentData['title'] != '' ? $agentData['title'] : 'Realtor' ); ?></h5>
		<ul class="contact-info">
			<?php if($agentData['email_address'] != ''){?><li class="email"><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:<?php echo $agentData['email_address']; ?>" ><?php echo $agentData['email_address']; ?></a></li><?php } ?>
			<?php if($agentData['cell_phone'] != ''){?><li class="phone"><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:<?php echo $agentData['cell_phone']; ?>" ><?php echo $agentData['cell_phone']; ?></a></li><?php } ?>
		</ul>

	</div>
	<div class="card-footer">
		<form class="form form-inline" action="/contact/" method="get" style="display:inline-block;" >
			<input type="hidden" name="reason" value="Just reaching out" />
			<input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>" />
			<input type="hidden" name="selected_agent" value="<?php echo $agentData['name']; ?>" />
			<button type="submit" class="btn btn-primary btn-rounded" >Contact Me</button>
		</form>
		<a href="<?php echo $agentData['link']; ?>" class="btn btn-primary btn-rounded">view profile</a>
	</div>
</div>
