<?php

use Includes\Modules\Agents\Agents;

/**
 * Created by PhpStorm.
 * User: Bryan
 * Date: 9/22/2017
 * Time: 5:08 PM
 */

//DEFAULT FORM VARS
$yourname            = (isset($_GET['your_name']) ? $_GET['your_name'] : '');
$youremail           = (isset($_GET['your_email']) ? $_GET['your_email'] : '');
$phone               = (isset($_GET['phone']) ? $_GET['phone'] : '');
$reason              = (isset($_GET['reason']) ? $_GET['reason'] : '');
$mlsnumber           = (isset($_GET['mls_number']) ? $_GET['mls_number'] : '');
$emailformattedbadly = false;
$passCheck           = false;
$message             = '';
$agentOptions        = '';

//IS USER LOGGED IN?
$currentUser     = get_user_meta(get_current_user_id());
$currentUserInfo = get_userdata(get_current_user_id());
$yourname        = ($currentUser['first_name'][0] != '' ? $currentUser['first_name'][0] : $yourname);
$yourname        = ($currentUser['last_name'][0] != '' ? $yourname . ' ' . $currentUser['last_name'][0] : $yourname);
$youremail       = (isset($currentUserInfo->user_email) ? $currentUserInfo->user_email : $youremail);
$phone           = (isset($currentUser['phone1'][0]) ? $currentUser['phone1'][0] : $phone);
$selectedAgent   = (isset($currentUser['selected_agent'][0]) ? $currentUser['selected_agent'][0] : null); //get agent from user data.
$selectedAgent   = (isset($_GET['selected_agent']) ? $_GET['selected_agent'] : $selectedAgent); //IF GET, then override.

//SELECT OPTIONS
$agents     = new Agents();
$agentArray = $agents->getAgentNames();
$agentOptions = '<option value="first">First Available</option>';
foreach ($agentArray as $agent) {
    $agentOptions .= '<option value="' . $agent . '" ' . ($selectedAgent == $agent ? 'selected' : '') . ' >' . $agent . '</option>';
}

$reasonArray = array(
    'reachingout' => 'Just reaching out',
    'selling'     => 'Thinking about selling',
    'inquiry'     => 'Property inquiry'
);
$reasonOptions = '';
foreach($reasonArray as $reasonValue => $reasonText){
    $reasonOptions .= '<option value="'.$reasonText.'" '.($reason == $reasonText ? 'selected' : '').' >'.$reasonText.'</option>';
}

$formID        = (isset($_POST['formID']) ? $_POST['formID'] : '');
$securityFlag  = (isset($_POST['secu']) ? $_POST['secu'] : '');
$formSubmitted = ($formID == 'requestinfo' && $securityFlag == '' ? true : false);
if ($formSubmitted) { //FORM WAS SUBMITTED
    //TODO...
}

?>
<a id="request-info-form" class="pad-anchor"></a>
<form class="form leadform" enctype="multipart/form-data" method="post" action="#request-info-form" id="requestinfo">
    <input type="hidden" name="formID" value="requestinfo">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="your_name" class="sr-only">Name<span class="req">*</span></label>
                <input name="your_name" type="text"
                       class="form-control <?php echo($yourname == '' && $formSubmitted ? 'has-error' : ''); ?>"
                       value="<?php echo($yourname != '' ? $yourname : ''); ?>" required placeholder="Name *">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="your_email" class="sr-only">Email address<span class="req">*</span></label>
                <input name="your_email" type="email"
                       class="form-control <?php echo($youremail == '' && $formSubmitted || $emailformattedbadly ? 'has-error' : ''); ?>"
                       value="<?php echo(! $passCheck ? $youremail : ''); ?>" required placeholder="Email address *">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="phone" class="sr-only">Phone Number</label>
                <div class="phone-group">
                    <input type="tel" name="phone" class="form-control ph"
                           value="<?php echo(! $passCheck ? $phone : ''); ?>" placeholder="Phone Number">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group <?php echo($reason == '' && $formSubmitted ? 'has-error' : ''); ?>">
                <label for="reason" class="sr-only">Reason for contact<span class="req">*</span></label>
                <select class="form-control custom-select" name="reason" id="reason" required>
                    <option value="">Reason for contact *</option>
                    <?php echo $reasonOptions; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group q-mls mb-3 <?php echo($mlsnumber == '' ? 'hidden-xs-up' : ''); ?>">
                <div style="width:100px;" class="input-group-addon">MLS#</div>
                <input type="text" class="form-control" value="<?php echo($mlsnumber != '' ? $mlsnumber : ''); ?>"
                       name="mls_number" placeholder="MLS number"/>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <p style="margin-bottom: 1.75rem;">Select an agent or contact.</p>
            <div class="form-group <?php echo($selectedAgent == '' && $formSubmitted ? 'has-error' : ''); ?>"
                 id="agent-select-dd" >
                <label for="your_agent" class="sr-only">Your Agent</label>
                <select class="form-control custom-select" name="your_agent" required>
                    <?php echo $agentOptions; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="additional_info" class="sr-only">Additional Info</label>
                <textarea name="additional_info" rows="4" class="form-control" placeholder="Message"
                          style="height: 110px;"><?php echo($message != '' ? stripslashes($message) : ''); ?></textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <input type="text" name="secu" style="position: absolute; height: 1px; top: -50px; left: -50px; width: 1px; padding: 0; margin: 0; visibility: hidden;">
                <button type="submit" class="btn btn-primary btn-block btn-outlined">SEND</button>
            </div>
        </div>
    </div>
</form>
