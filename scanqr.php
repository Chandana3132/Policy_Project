<!DOCTYPE html>
<html>
	<head>
		<title>Digital Tourist Guide | Scan QR & View Place</title>
		<?php
			include 'links.php';
		?>
	</head>
	<script src="./qr_packed.js">
	</script>
	<script type="text/javascript">
		function openQRCamera(node) {
		  var reader = new FileReader();
		  reader.onload = function() {
		    node.value = "";
		    qrcode.callback = function(res) {
		      if(res instanceof Error) {
		        alert("No QR code found. Please make sure the QR code is within the camera's frame and try again.");
		      } else {
		        node.parentNode.previousElementSibling.value = res;
		      }
		    };
		    qrcode.decode(reader.result);
		  };
		  reader.readAsDataURL(node.files[0]);
		}
		function showQRIntro() {
		  return confirm("Use your camera to take a picture of a QR code.");
		}

	</script>
	<style type="text/css">
		.qrcode-text-btn {
		  display: inline-block;
		  height: 1.5em;
		  width: 2em;
		  background: url(./img/qr.png) 50% 50% no-repeat;background-size: cover;
		  cursor: pointer;
		}

		.qrcode-text-btn > input[type=file] {
		  position: absolute;
		  overflow: hidden;
		  width: 2px;
		  height: 2px;
		  opacity: 0;
		}
		.qrcode-text {
		  padding-right: 1.7em;
		  margin-right: 0;
		  vertical-align: middle;
		}

		.qrcode-text + .qrcode-text-btn {
		  width: 1.7em;
		  margin-left: -1.7em;
		  vertical-align: middle;
		}
	</style>
	<body>
		<?php include 'navbar.php'; ?>
		<div class="login">
			<form method="POST" action="scanqr.php">
				<h1>SCAN QR & VIEW PLACE</h1>
				SELECT PLACE : <input type="text" name="place" style="background-color: transparent;" class="qrcode-text" id="place" placeholder="Click Button right to this box" required="">
				<label class=qrcode-text-btn>
					<input type="file" accept="image/*" capture=environment onclick="return showQRIntro();" onchange="openQRCamera(this);" tabindex=-1>
				</label><br><br>
				<input type="submit" name="submit" value="VIEW"><br><br>
			</form>
			<?php
				if (isset($_POST['submit'])) {
					$place_name =($_POST['place']);
					$place_id;
					$sql="select * from places where place_name='".$place_name."' ";
					$result=mysqli_query($conn, $sql);
					if ($result-> num_rows >0) {
						$row= $result-> fetch_assoc();
						$place_id=$row['id'];
					}

					$sql="select * from places where id='".$place_id."' ";
					$result=$conn->query($sql);
					if ($result-> num_rows >0) {
						$row= $result-> fetch_assoc();
						?>
						<div align="center">
							<hr>
							<h3><u>Place Name</u></h3>
							<h1><u><?php echo $row['place_name']; ?></u></h1>
							<h4><?php echo $row['description']; ?></h4><hr>
						</div>
						<?php
					}




					$sql="select * from videos where place_id='".$place_id."'";
					$result=mysqli_query($conn, $sql);
					if ($result-> num_rows >0) {
						?><h1 align="center">Videos</h1><?php
						while ($row= $result-> fetch_assoc()) {
							$name=$row['video_name'];
							echo "<div align='center'><video width='480' src='./admin/videos/".$name."' controls><embed src='videos/".$name."' autostart='false' type='video/x-matroska'></embed></video>";
						}
						echo "</div>";	
					}
					else
					{
						echo "No Videos Uploaded for this place<br>";
					}

					echo "<hr>";

					$sql="select * from images where place_id='".$place_id."'";
					$result=mysqli_query($conn, $sql);
					if ($result-> num_rows >0) {
						echo "<br>";
						?><h1 align="center">Pictures</h1><?php
						while ($row= $result-> fetch_assoc()) {
							$name=$row['image_name'];
							echo "<div align='center'><img src='./admin/images/".$name."' width='480'></img>";
						}
						echo "</div>";
						
					}
					else
					{
						echo "No Image Uploaded for this place<br>";
					}
				}
			?>
		</div>
	</body>
</html>