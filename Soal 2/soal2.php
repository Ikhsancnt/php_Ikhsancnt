<?php
    include 'testdb.php';

    $selectedHobi = isset($_GET['hobi']) ? $_GET['hobi'] : '';

    $sqlHobi = "SELECT DISTINCT hobi FROM hobi ORDER BY hobi ASC";
    $resultHobi = $conn->query($sqlHobi);

    if ($selectedHobi != '') {
        $sql = "SELECT hobi, COUNT(person_id) AS jumlah_person 
                FROM hobi 
                WHERE hobi = '" . $conn->real_escape_string($selectedHobi) . "'
                GROUP BY hobi";
    } else {
        $sql = "SELECT hobi, COUNT(person_id) AS jumlah_person 
                FROM hobi 
                GROUP BY hobi 
                ORDER BY jumlah_person DESC";
    }
    $result = $conn->query($sql);
?>

<html>
    <div style="text-align:center; font-size:20px; margin-top: 50px;">
        <form method="get">
            <label for="hobi">Filter by Hobi:</label>
            <select name="hobi" id="hobi" onchange="this.form.submit()">
                <option value="">-- Semua Hobi --</option>
                <?php
                    if ($resultHobi->num_rows > 0) {
                        while($row = $resultHobi->fetch_assoc()) {
                            $selected = ($row["hobi"] == $selectedHobi) ? "selected" : "";
                            echo "<option value='".htmlspecialchars($row["hobi"])."' $selected>"
                                    .htmlspecialchars($row["hobi"])
                                ."</option>";
                        }
                    }
                ?>
            </select>
        </form>
    </div>

    <br>

    <table border="1" style="margin: auto; text-align: center; width: 500px; font-size: 20px;">
        <thead>
            <tr>
                <th>Hobi</th>
                <th>Jumlah Person</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["hobi"]) . "</td>";
                        echo "<td>" . $row["jumlah_person"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No data found</td></tr>";
                }
                $conn->close();
            ?>
        </tbody>
    </table>
</html>
