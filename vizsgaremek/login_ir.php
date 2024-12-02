<?php

    session_start() ;

    print_r( $_POST ) ;

    include( "kapcsolat.php" ) ;


	




	//$pw = md5( $_POST['pw'] ) ; AND     password   ='$pw'

	$userek = mysqli_query( $adb , "
					SELECT * FROM user 
					WHERE  (uemail='$_POST[email]')
					AND     password   ='$_POST[pw]'
	" ) ;

	if( mysqli_num_rows($userek)==0 )
	{
	    print "<script> alert('Hibás belépési adatok!') </script>" ;
	}
	else
	{
	    $user = mysqli_fetch_array($userek) ;
	    $_SESSION['uid']  = $user['uid'] ;
		$_SESSION['username']  = $user['username'] ;

	}

	$logip = $_SERVER['REMOTE_ADDR'];
	$logsess = substr(session_id(), 0 , 8);

	mysqli_query($adb,
	"INSERT INTO login (	logid, 	 logdate,   logip, 	 logsession,               luid) 
	VALUES 				 (   NULL,     NOW(),'$logip',   '$logsess', '$_SESSION[uid]')");


    mysqli_close( $adb ) ;

    print "<script> parent.location.href = './' </script>" ;

?>