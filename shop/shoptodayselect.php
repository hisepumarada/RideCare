<?php
include "../db_conn.php";
$output = '';
$sql = "SELECT * FROM appointment WHERE date = CURDATE() AND status = 'approved'";
$result = mysqli_query($conn, $sql);
$output .= '<style>.kaliwa { float: left; }</style> 
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
            <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">    
            <div class="order"> 
                <table id="example" class="table table-striped" style="font-size: 15px; width:100%">
                    <thead>              
                        <tr>  
                            <th style="font-size: 20px;">&nbsp;&nbsp;ID&nbsp;&nbsp;</th>                    
                            <th style="font-size: 20px;">Date</th>  
                            <th style="font-size: 20px;" >Name</th>  
                            <th style="font-size: 20px;">Email</th> 
                            <th style="font-size: 20px;">Mobile</th> 
                            <th style="font-size: 20px;">Service</th>  
                            <th style="font-size: 20px;">Status</th>  
                        </tr>
                    </thead>
                    <tbody>';

while ($row = mysqli_fetch_array($result)) {
    $output .= '
        <tr>  
            <td>&nbsp;&nbsp;' . $row["id"] . '&nbsp;&nbsp;</td>  
            <td>' . date('F j, Y', strtotime($row["date"])) . '</td>   
            <td>&nbsp;&nbsp;' . $row["name"] . '&nbsp;&nbsp;</td>  
            <td>&nbsp;&nbsp;' . $row["email"] . '&nbsp;&nbsp;</td>  
            <td>&nbsp;&nbsp;' . $row["mobile"] . '&nbsp;&nbsp;</td>  
            <td>' . $row["service"] . '</td> 
            <td>
                <select style="color: black; font-size:18px;" class="status" onchange="getval(this)" data-id4="' . $row["id"] . '" contenteditable >
                    <option selected disabled> Process </option>
                    <option>Completed</option>
                    <option>Reject</option>
                </select>
            </td> 
        </tr>';
}

$output .= '</tbody></table></div>';
echo $output;
?>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.js"></script>

<script>
    $(document).ready(function () {
        // DataTable initialization
        var table = $('#example').DataTable();


        // Add the export buttons to the DataTable
        table.buttons().container().appendTo($('.kaliwa'));
    });
</script>
