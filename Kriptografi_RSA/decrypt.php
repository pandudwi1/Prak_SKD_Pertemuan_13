<!DOCTYPE html>
<html>
<head>
	<title>KRIPTOGRAFI RSA</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    $hasil="";
    if(isset($_POST['dekrip'])){
        $n=$_POST['n'];
        $d=$_POST['d'];
        //pesan enkripsi dipecah menjadi array dengan batasan "."
        $teks=explode(".",$_POST['teks']);
        foreach($teks as $nilai){
            //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
            $hasil.=chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n)));
        }
    }
    ?>
	<div class="main">
		<h2 class="judul">DEKRIPSI RSA</h2>
		<form id="enkripsi" name="enkripsi"  method="post" action="decrypt.php">			
			<input type="text" name="teks" id="teks" class="teks" autocomplete="off" placeholder="Masukkan Cipher Teks">
            <input type="text" class="bil" name="n" id="n" placeholder="Nilai n" value="" />
            <input type="text" class="bil2" name="d" id="d" placeholder="Nilai d" value="" />
			<input type="submit" name="dekrip" id="dekrip" value="Dekripsi" class="tombol_dek">											
		</form>
        <br>
		<?php if(isset($_POST['dekrip'])){ ?>
			<label for="enkrip" class="label">Plain Teks</label><input type="text" value="<?php echo $hasil; ?>" class="teks2">
		<?php }else{ ?>
			<label for="enkrip" class="label">Plain Teks</label><input type="text" value="0" class="teks2">
		<?php } ?>			
	</div>
</body>
</html>