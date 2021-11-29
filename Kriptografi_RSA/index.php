<!DOCTYPE html>
<html>
<head>
	<title>KRIPTOGRAFI RSA</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    if(isset($_POST['generate'])){
        $p=$_POST['p'];
        $q=$_POST['q'];
        //menghitung&menampilkan n=p*q
        $n=gmp_mul($p,$q);

        //menghitung&menampilkan totient/phi=(p-1)(q-1)
        $totient=gmp_mul(gmp_sub($p,1),gmp_sub($q,1));
        //echo 'totient='.gmp_strval($totient). "\n";

        //mencari e, dimana e merupakan coprime dari totient
        //e dikatakan coprime dari totient jika gcd/fpb dari e dan totient/phi = 1
        for($e=2;$e<100;$e++){  //mencoba perulangan max 100 kali, 
            $gcd = gmp_gcd($e, $totient);
            if(gmp_strval($gcd)=='1')
                break;
        }
        //menampilkan gcd
        //echo 'gcd = '.gmp_strval($gcd) . "\n";
        //menampilkan e
        //echo 'e='.gmp_strval($e). "\n";

        //cari d
        // d.e mod totient =1
        // d.e = totient*x + 1
        // d.e = totient*1 + 1
        // d = (totient *1 + 1)/e

        //menghitung & menampilkan d
        $i=1;
        do{
            $res = gmp_div_qr(gmp_add(gmp_mul($totient,$i),1), $e);
            //echo '((totient*'.$i.') + 1) / e='.gmp_strval($res[0])." ; sisa= ".gmp_strval($res[1])."\n";
            $i++;
            if($i==10000) //maksimal percobaan 10000
                break;
        }while(gmp_strval($res[1])!='0');
        $d=$res[0];
    }else if(isset($_POST['auto'])){
        $rand1=rand(1000,2000);
        $rand2=rand(1000,2000);

        // mencari bilangan prima selanjutnya dari $rand1 &rand2
        $p = gmp_nextprime($rand1); 
        $q = gmp_nextprime($rand2);
        //menghitung&menampilkan n=p*q
        $n=gmp_mul($p,$q);

        //menghitung&menampilkan totient/phi=(p-1)(q-1)
        $totient=gmp_mul(gmp_sub($p,1),gmp_sub($q,1));
        //echo 'totient='.gmp_strval($totient). "\n";

        //mencari e, dimana e merupakan coprime dari totient
        //e dikatakan coprime dari totient jika gcd/fpb dari e dan totient/phi = 1
        for($e=2;$e<100;$e++){  //mencoba perulangan max 100 kali, 
            $gcd = gmp_gcd($e, $totient);
            if(gmp_strval($gcd)=='1')
                break;
        }
        //menampilkan gcd
        //echo 'gcd = '.gmp_strval($gcd) . "\n";
        //menampilkan e
        //echo 'e='.gmp_strval($e). "\n";

        //cari d
        // d.e mod totient =1
        // d.e = totient*x + 1
        // d.e = totient*1 + 1
        // d = (totient *1 + 1)/e

        //menghitung & menampilkan d
        $i=1;
        do{
            $res = gmp_div_qr(gmp_add(gmp_mul($totient,$i),1), $e);
            //echo '((totient*'.$i.') + 1) / e='.gmp_strval($res[0])." ; sisa= ".gmp_strval($res[1])."\n";
            $i++;
            if($i==10000) //maksimal percobaan 10000
                break;
        }while(gmp_strval($res[1])!='0');
        $d=$res[0];
    }
    ?>
	<div class="main">
		<h2 class="judul">GENERATE PRIVATE DAN PUBLIC KEY</h2>
		<form id="enkripsi" name="enkripsi" method="post" action="index.php">
            <?php if(isset($_POST['auto'])){ ?>
                <input type="text" class="bil" name="p" id="p" placeholder="Nilai p" value="<?php echo $p; ?>" />
            <?php }else{ ?>
                <input type="text" class="bil" name="p" id="p" placeholder="Nilai p" value="" />
            <?php } ?>				
            <?php if(isset($_POST['auto'])){ ?>
                <input type="text" class="bil2" name="q" id="q" placeholder="Nilai q" value="<?php echo $q; ?>" />
            <?php }else{ ?>
                <input type="text" class="bil2" name="q" id="q" placeholder="Nilai q" value="" />
            <?php } ?>	
			<input type="submit" name="generate" id="generate" value="Generate Key" class="tombol">												
            <input type="submit" name="auto" id="auto" value="Auto Generate Key" class="tombol">	
		</form>
        <br>
		<?php if(isset($_POST['generate'])||isset($_POST['auto'])){ ?>
			<label for="enkrip" class="label">Nilai n</label><input type="text" value="<?php echo $n; ?>" class="teks2">
		<?php }else{ ?>
			<label for="enkrip" class="label">Nilai n</label><input type="text" value="0" class="teks2">
		<?php } ?>			
        <?php if(isset($_POST['generate'])||isset($_POST['auto'])){ ?>
			<label for="enkrip" class="label">Public Key e</label><input type="text" value="<?php echo $e; ?>" class="teks2">
		<?php }else{ ?>
			<label for="enkrip" class="label">Public Key e</label><input type="text" value="0" class="teks2">
		<?php } ?>			
        <?php if(isset($_POST['generate'])||isset($_POST['auto'])){ ?>
			<label for="enkrip" class="label">Private Key d</label><input type="text" value="<?php echo $d; ?>" class="teks2">
		<?php }else{ ?>
			<label for="enkrip" class="label">Private Key d</label><input type="text" value="0" class="teks2">
		<?php } ?>
        <br>
        <br>
        <a href="encrypt.php" target="_blank" rel="nofollow"><input type="submit" value="Enkripsi" class="tombol2"></a>											
        <a href="decrypt.php" target="_blank" rel="nofollow"><input type="submit" value="Dekripsi" class="tombol3"></a>
	</div>
</body>
</html>