
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8; image/gif" />
	<title> WELCOME | SPORT NATION | WORLD WIDE </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body style="margin: 0; padding: 0; font-family: sans-serif, Tahoma;">
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
		<tr>
			<td align="center" bgcolor="#6C6599" style="padding: 40px 40 30px 0; border-bottom: 2px solid #888;"> 
				<h3 style="color: #fff;"> Welcome </h2> 
			</td>
		</tr>
		<tr>
			<td align="center" bgcolor="#eee" style="padding: 40px 0 40px 0;">
				
					<img src="<?= WEBROOT; ?>public/img/email/logo.gif" alt="Profil activation" width="300" height="230" style="display: block; border-top: 1px solid black;" >
				
				<a style="padding: 15px; border: 1px solid #555; background-color: #328396; border-radius: 10px; color: #fff; text-decoration: none;" href="<?= User::getEmailLink("subscribe"); ?>"> Confirm your profil </a>;
			</td>
		</tr>
		<tr>
			<td bgcolor="#eee" style="padding: 20px 30px 40px 20px; border-top: 2px solid #888;">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<img src="<?= WEBROOT; ?>public/img/email/flux.gif" alt="flux rss" width="300" height="230" style="display: block; border-top: 1px solid black;" />
						<h5 style="color: #aaa;"> Our Flux Rss </h5>

					</tr>
					<tr>
						<td width="260" valign="top">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td>
										<img src="<?= WEBROOT; ?>public/img/email/volleyball.gif" alt="" width="100%" height="140" style="display: block;" />
									</td>
								</tr>
								<tr>
									<td style="padding: 25px 0 0 50px;"> Flux Team </td>
								</tr>
							</table>
						</td>
					<td style="font-size: 0; line-height: 0;" width="20"> &nbsp; </td>
						<td width="260" valign="top">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td>
									<img src="<?= WEBROOT; ?>public/img/email/footing.gif" alt="" width="100%" height="140" style="display: block;" />
								</td>
							</tr>
								<tr>
									<td style="padding: 25px 0 0 50px;"> Flux Event </td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td bgcolor="#444" style="padding: 30px 30px 30px 30px;">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td align="right">
							<table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td>
										<a href="http://www.twitter.com/">
											<img src="<?= WEBROOT; ?>public/img/email/twitter.gif" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
										</a>
									</td>
									<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
										<td>
											<a href="http://www.instagram.com/">
												<img src="<?= WEBROOT; ?>public/img/email/instagram.gif" alt="Instagram" width="38" height="38" style="display: block;" border="0" />
											</a>
										</td>
									<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
									<td>
										<a href="http://www.facebook.com/">
											<img src="<?= WEBROOT; ?>public/img/email/facebook.gif" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
										</a>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
