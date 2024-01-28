<?php 
session_start();
include "../db_conn.php";
$page = 'shopbook';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">

	<!-- My CSS -->
	<title>RideCare SHOP: APPOINTMENTS</title>
</head>
<body>


	<!-- SIDEBAR -->
<?php include '../inc/sidebarshop.php';  ?>
	<!-- SIDEBAR -->
	
		<main>

		<div class="head-title">
				<div class="left">
					<h1>Today's Appointment</h1>
					<ul class="breadcrumb">
						<li>
						<a class="active" href="shopdashboard.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="hide" href="shopbook.php">Appointment</a>
						</li>
                        <li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="hide" href="shopbook.php">Appointment for Today</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="table-data">
				<div class="order">
                    <div class="head"><h1 style="font-size: 50px;">Appointments for Today</h1></div>  
                    <span id="result"></span>
				<div id="live_data"></div> 
		</div></div>
    </body>  
</html>  
<script>  
$(document).ready(function(){  
    function fetch_data()  
    {  
        $.ajax({  
            url:"shoptodayselect.php",  
            method:"POST",  
            success:function(data){  
				$('#live_data').html(data);  
            }  
        });  
    }  
    fetch_data();  
	$(document).on('click', '#btn_add', function(){ 
    var name = $('#name').text();  
    var service = $('#service').text(); 
	var status = $('#status').val(); 
	if(name == '')  
        {  
            alert("Enter First Name");  
            return false;  
        }  
        if(service == '')  
        {  
            alert("Enter Last Name");  
            return false;  
        }  
        $.ajax({  
            url:"shopapprovalinsert.php",  
            method:"POST",  
            data:{name:name, service:service, status:status},  
            dataType:"text",  
            success:function(data)  
            {  
                alert(data);  
                fetch_data();  
            }  
        })  
    });
	function edit_data(id, text, column_name)  
    {  
        $.ajax({  
            url:"shopedit.php",  
            method:"POST",  
            data:{id:id, text:text, column_name:column_name},  
            dataType:"text",  
            success:function(data){  
                //alert(data);
				$('#result').html("<div class='alert alert-success'>"+data+"</div>");
            }  
        });  
    }  
    $(document).on('blur', '.name', function(){  
        var id = $(this).data("id1");  
        var name = $(this).text();  
        edit_data(id, name, "name");  
    });  
    $(document).on('blur', '.service', function(){  
        var id = $(this).data("id2");  
        var service = $(this).text();  
        edit_data(id, service, "service");  
    }); 
	$(document).on('change', '.status', function(){  
    var id = $(this).data("id4");  
    var status = $(this).val();  // Use .val() instead of .value()
    edit_data(id, status, "status");  
});
    $(document).on('click', '.btn_delete', function(){  
        var id=$(this).data("id3");  
        if(confirm("Are you sure you want to delete this?"))  
        {  
            $.ajax({  
                url:"adminbookdelete.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"text",  
                success:function(data){  
                    alert(data);  
                    fetch_data();  
                }  
            });  
        }  
    });  
});  
</script>
