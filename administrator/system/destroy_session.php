<?
	$UserId = $_SESSION['UserId'];
	$username = $_SESSION['admin_username'];
	$permission = $_SESSION['permission'];
	session_destroy();
	if($_GET['fin']==7){
		?>
		<script>
			window.location = 'index.php?page=destroy_s&U=<?=$UserId?>&Us=<?=$username?>&t=<?=$permission?>&fin=<?=$_GET['fin']?>';
		</script>
		<?
	}
?>
	<script>
		window.location = 'index.php?page=destroy_s&U=<?=$UserId?>&Us=<?=$username?>&t=<?=$permission?>';
	</script>