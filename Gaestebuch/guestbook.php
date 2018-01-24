<?php

$name=$_POST[name];
$mail=$_POST[email];
$beitrag=$_POST[beitrag];
$sent=$_POST[sent];

$verbindung=mysql_connect("localhost","<user>",">passwort>") or die("Keine Verbindung moeglich");
mysql_select_db('gaestebuch');

$sql = "SELECT * FROM eintraege ORDER BY id DESC;"; 
$daten=mysql_query($sql);

while($datensatz=mysql_fetch_array($daten)) {

		echo "<b>Name:</b>".$datensatz[0]."<br />";
		echo "<b>email:</b>".$datensatz[1]."<br />";
		echo "<b>Beitrag:</b><br />".$datensatz[2]."<br />";
		echo "<hr />";
}

if ((empty($name) or empty($mail) or empty($beitrag)) and $sent==1) {
		echo "<br />Bitte alle Felder ausfuellen!<p />";
}

else {
	$full=1;
}

echo '<html>';
echo '<body>';
echo '<form action="guestbook.php" method="POST">';
echo '<label>Name:</label>';
echo '<input type="text" name="name"/><br />';
echo '<label>Email:</label>';
echo '<input type="text" name="email"/><br /><br />';
echo '<label>Beitrag:</label><br />';
echo '<TEXTAREA COLS="40" ROWS="6"  wrap="virtual" name="beitrag"></TEXTAREA><br />';
echo '<input type="submit" value="Beitrag posten"/>';
echo '<input type="hidden" value="1" name="sent"';
echo '</form>';
echo '</body>';
echo '</html>';

$sql = "INSERT INTO `gaestebuch`.`eintraege` (
	`name`, 
	`email`,
	`beitrag`,
	`id`
) 
VALUES (
	'$name',
	'$mail',
	'$beitrag', 
	NULL
);
";

if ($sent==1 and $full==1) {
	mysql_query($sql);
	echo "<br />Ihr Eintrag wurde gespeichert.<br />";
	$sent=0;
	$full=0;
}	
	mysql_close($verbindung);
?>

