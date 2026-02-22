<a href="index.php?menupont=ujvelemeny" class="ujvelemeny butn Primary">
    <i class="fa-solid fa-plus"></i> Vélemény írása
</a>

<div>
<?php
        include("php/dashboard.php");

		$SQLlekerdezes = "SELECT * FROM ertekelesek WHERE deleted = 0";
        $this->naplo->_bejegyez($SQLlekerdezes);

        $SQLeredmeny = mysqli_query($this->db_kapcsolat->_kapcsolat(), $SQLlekerdezes);

        if ($SQLeredmeny)
        {
            while ($row = mysqli_fetch_assoc($SQLeredmeny)) 
            {
                    $HTMLSorok .= "<tr>
                    <td>".$row['csillag']."</td>
                    <td>".$row['velemeny']."</td>
                    <td>".$row['letrehozva']."</td>
                </tr>";
            }
        }
        else 
        {
            $this->naplo->_bejegyez(mysqli_error($this->db_kapcsolat->_kapcsolat()));
        }
 
?>
</div>