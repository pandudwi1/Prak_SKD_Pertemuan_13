<!DOCTYPE html>
<html>
<head>
	<title>KRIPTOGRAFI RSA</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    $hasil="";
    if(isset($_POST['enkrip'])){
        $n=$_POST['n'];
        $e=$_POST['e'];
        $teks=$_POST['teks'];
        //pesan dikodekan menjadi kode ascii, kemudian di enkripsi per karakter
        for($i=0;$i<strlen($teks);++$i){
            //rumus enkripsi <enkripsi>=<pesan>^<e>mod<n>
            $hasil.=(gmp_mod(gmp_pow(ord($teks[$i]),$e),$n));
            //antar tiap karakter dipisahkan dengan "."
        if($i!=strlen($teks)-1){
            $hasil.=".";
        }
        }
    }
    ?>
	<div class="main">
		<h2 class="judul">ENKRIPSI RSA</h2>
		<form id="enkripsi" name="enkripsi" method="post" action="encrypt.php">			
			<input type="text" class="teks" name="teks" id="teks" autocomplete="off" placeholder="Masukkan Plain Teks">
            <input type="text" class="bil" name="n" id="n" placeholder="Nilai n" value="" />
            <input type="text" class="bil2" name="e" id="e" placeholder="Nilai e" value="" />
			<input type="submit" name="enkrip" id="enkrip" value="Enkripsi" class="tombol_enk">											
		</form>
        <br>
		<?php if(isset($_POST['enkrip'])){ ?>
			<label for="enkrip" class="label">Cipher Teks</label><input type="text" value="<?php echo $hasil; ?>" class="teks2">
		<?php }else{ ?>
			<label for="enkrip" class="label">Cipher Teks</label><input type="text" value="0" class="teks2">
		<?php } ?>			
	</div>
</body>
</html>