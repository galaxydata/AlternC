<?php
require_once("../class/config_nochk.php");

header ("Content-Type:text/xml");

# Test it :
# wget -O - -q  http://FQDN/mailautoconfig_thunderbird.php?emailaddress=test@example.tld

if (empty($_GET['emailaddress'])) die(_("Error: Missing GET of emailaddress"));

$emailDomain = explode('@', rawurldecode($_GET['emailaddress']));
if (empty($emailDomain)) die(_('Error: Empty $emailDomain'));
?>
<clientConfig version="1.1">
<emailProvider id="<?php echo $L_FQDN ?>">
<domain><?php echo $emailDomain[1];?></domain>
<displayName><?php echo $L_FQDN ?></displayName>
<displayShortName><?php echo $L_FQDN ?></displayShortName>
	<incomingServer type="imap">
		<hostname><?php echo $mail->srv_imap ;?></hostname>
		<port>993</port>
		<socketType>SSL</socketType>
		<authentication>password-cleartext</authentication>
		<username>%EMAILADDRESS%</username>
	</incomingServer>
	<incomingServer type="pop3">
		<hostname><?php echo $mail->srv_imaps;?></hostname>
		<port>995</port>
		<socketType>SSL</socketType>
		<authentication>password-cleartext</authentication>
		<username>%EMAILADDRESS%</username>
	</incomingServer>
	<outgoingServer type="smtp">
		<hostname><?php echo $mail->srv_smtp;?></hostname>
		<port>587</port>
		<socketType>STARTTLS</socketType>
		<username>%EMAILADDRESS%</username>
		<authentication>password-cleartext</authentication>
	</outgoingServer>
	<outgoingServer type="smtp">
		<hostname><?php echo $mail->srv_smtps;?></hostname>
		<port>465</port>
		<socketType>SSL</socketType>
		<authentication>password-cleartext</authentication>
		<username>%EMAILADDRESS%</username>
	</outgoingServer>
</emailProvider>
</clientConfig>
