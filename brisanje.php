<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brisanje</title>
</head>
<body>
    <h3>Izaberite korisnika za brisanje iz baze</h3>
    <form action="brisanje.php" method="POST" enctype="multipart/form-data">
        <select name="korisnik" id="korisnik">
            <option value="0">--Izaberite korisnika--</option>
            <?php
                $baza_podataka=mysqli_connect("localhost", "root", "", "aleksa_cv");
                $upit="SELECT id,ime,prezime FROM korisnici";
                $odg_baze=mysqli_query($baza_podataka, $upit);
                if($odg_baze) {
                    while($red=mysqli_fetch_array($odg_baze,MYSQLI_ASSOC)) {
                        echo "<option value='".$red['id']."'>".$red['ime']." ".$red['prezime']."</option>";
                    }
                } else {
                    echo "Greska u konekciji sa bazom: ".mysqli_connect_errno();
                }
                mysqli_close($baza_podataka);
            ?>
        </select>
        <button type="submit" name="dugme">Obrisi</button>
    </form>
    <?php
        $baza_podataka=mysqli_connect("localhost", "root", "", "aleksa_cv");
        if(isset($_POST['dugme'])) {
            $id=$_POST['korisnik'];
            $upit_brisanje="DELETE FROM korisnici WHERE id=$id";
            $odg_baze=mysqli_query($baza_podataka, $upit_brisanje);
            if($odg_baze) {
                echo "Korisnik uspesno obrisan";
            } else {
                echo "Greska u konekciji sa bazom: ".mysqli_connect_errno();
            }
        } else {
            echo "Izaberite korisnika za brsianje.";
        }
        mysqli_close($baza_podataka);
    ?>
</body>
</html>