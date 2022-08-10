<?php

use Includes\Modules\Agents\Agents;
use Includes\Modules\Leads\RequestInfo;

//DEFAULT FORM VARS
$yourname            = (isset($_GET['full_name']) ? $_GET['full_name'] : '');
$youremail           = (isset($_GET['email_address']) ? $_GET['email_address'] : '');
$phone               = (isset($_GET['phone_number']) ? $_GET['phone_number'] : '');
$reason              = (isset($_GET['reason_for_contact']) ? $_GET['reason_for_contact'] : '');
$mlsnumber           = (isset($_GET['mls_number']) ? $_GET['mls_number'] : '');
$emailformattedbadly = false;
$passCheck           = false;
$message             = '';
$agentOptions        = '';

//IS USER LOGGED IN?
$currentUser     = get_user_meta(get_current_user_id());
$currentUserInfo = get_userdata(get_current_user_id());
$yourname        = (isset($currentUser['first_name'][0]) && $currentUser['first_name'][0] != '' ? $currentUser['first_name'][0] : $yourname);
$yourname        = (isset($currentUser['last_name'][0]) && $currentUser['last_name'][0] != '' ? $yourname . ' ' . $currentUser['last_name'][0] : $yourname);
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

$leads = new RequestInfo();
if ($formSubmitted) { //FORM WAS SUBMITTED
    $leads->handleLead($_POST);
}

?>
<a id="request-info-form" class="pad-anchor"></a>
<form class="form leadform" enctype="multipart/form-data" method="post" action="#request-info-form" id="requestinfo">
    <input type="hidden" name="user_agent" value="<?php echo $_SERVER['HTTP_USER_AGENT']; ?>" >
    <input type="hidden" name="ip_address" value="<?php echo $leads->getIP(); ?>" >
    <input type="hidden" name="referrer" value="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ''; ?>" >
    <input type="hidden" name="formID" value="requestinfo">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="full_name" class="sr-only">Name<span class="req">*</span></label>
                <input name="full_name" type="text"
                       class="form-control <?php echo($yourname == '' && $formSubmitted ? 'has-error' : ''); ?>"
                       value="<?php echo($yourname != '' ? $yourname : ''); ?>" required placeholder="Name *">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="email_address" class="sr-only">Email address<span class="req">*</span></label>
                <input name="email_address" type="email"
                       class="form-control <?php echo($youremail == '' && $formSubmitted || $emailformattedbadly ? 'has-error' : ''); ?>"
                       value="<?php echo(! $passCheck ? $youremail : ''); ?>" required placeholder="Email address *">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="phone_number" class="sr-only">Phone Number</label>
                <div class="phone-group">
                    <input type="tel" name="phone_number" class="form-control ph phone-mask"
                           value="<?php echo(! $passCheck ? $phone : ''); ?>" placeholder="Phone Number">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group <?php echo($reason == '' && $formSubmitted ? 'has-error' : ''); ?>">
                <label for="reason_for_contact" class="sr-only">Reason for contact<span class="req">*</span></label>
                <select class="form-control custom-select" name="reason_for_contact" id="reason" required>
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
                <label for="selected_agent" class="sr-only">Your Agent</label>
                <select class="form-control custom-select" name="selected_agent" required>
                    <?php echo $agentOptions; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="message" class="sr-only">Additional Info</label>
                <textarea name="message" rows="4" class="form-control" placeholder="Message"
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
