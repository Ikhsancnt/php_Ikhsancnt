<?php
    if (isset($_POST['buat_form'])) {
        $baris = (int) $_POST['jumlah_baris'];
        $kolom = (int) $_POST['jumlah_kolom'];

        echo "<h3>Silakan Inputkan Data:</h3>";
        echo "<form method='post'>";
        
        for ($i = 1; $i <= $baris; $i++) {
            for ($j = 1; $j <= $kolom; $j++) {
                echo "$i.$j: <input type='text' name='data[$i][$j]' required><br>";
            }
            echo "<hr>";
        }

        echo "<input type='submit' name='proses_data' value='Kirim'>";
        echo "</form>";
    }

    elseif (isset($_POST['proses_data'])) {
        echo "<h3>Hasil Input Data:</h3>";
        foreach ($_POST['data'] as $i => $kolom) {
            foreach ($kolom as $j => $nilai) {
                echo "$i.$j : " . htmlspecialchars($nilai) . "<br>";
            }
        }
    }

    if (!isset($_POST['buat_form']) && !isset($_POST['proses_data'])) {
        ?>
        <div>    
            <h3>Masukkan Jumlah Baris & Kolom</h3>
            <form method="post">
                <p>Baris: <input type="number" name="jumlah_baris" required></p>
                <p>Kolom: <input type="number" name="jumlah_kolom" required></p>
                <input type="submit" name="buat_form" value="SUBMIT">
            </form>
        </div>
        <?php
    }
?>
