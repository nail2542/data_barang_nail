<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Document</title>
</head>
<body>
<div class="et-hero-tabs-container">
	<a class="et-hero-tab" href="index.php">DASBOARD</a>
      <a class="et-hero-tab" href="peminjaman.php">PEMINJAMAN BARANG</a>
      <a class="et-hero-tab" href="barang.php">DATA BARANG</a>
      <a class="et-hero-tab" href="pengguna.php">USER</a>
      <a class="et-hero-tab" href="#tab-angular">LOGOUT</a>
      
    </div>


  <!-- Main -->
 
  </main>
</body>

<style>
	body {
		font-family: "Century Gothic", 'Lato', sans-serif;
}

a {
	text-decoration: none;
}

.et-hero-tabs,
.et-slide {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    position: relative;
    background: #eee;
		text-align: center;
		padding: 0 2em;
    h1 {
        font-size: 2rem;
        margin: 0;
        letter-spacing: 1rem;
    }
    h3 {
        font-size: 1rem;
        letter-spacing: 0.3rem;
        opacity: 0.6;
    }
}

.et-hero-tabs-container {
    display: flex;
    flex-direction: row;
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 70px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    background: #fff;
    z-index: 10;
    &--top {
        position: fixed;
        top: 0;
    }
}

.et-hero-tab {
    display: flex;
    justify-content: center;
    align-items: center;
    flex: 1;
    color: #000;
    letter-spacing: 0.1rem;
		transition: all 0.5s ease;
		font-size: 0.8rem;
	  &:hover {
			color:white;
      background: rgba(102,177,241,0.8);
			transition: all 0.5s ease;
    }
}

.et-hero-tab-slider {
    position: absolute;
    bottom: 0;
    width: 0;
    height: 6px;
    background: #66B1F1;
    transition: left 0.3s ease;
}

@media (min-width: 800px) {
	.et-hero-tabs,
	.et-slide {
    h1 {
        font-size: 3rem;
    }
    h3 {
        font-size: 1rem;
    }
	}
	.et-hero-tab {
		font-size: 1rem;
	}
}
</style>

<script>
	class StickyNavigation {
	
	constructor() {
		this.currentId = null;
		this.currentTab = null;
		this.tabContainerHeight = 70;
		let self = this;
		$('.et-hero-tab').click(function() { 
			self.onTabClick(event, $(this)); 
		});
		$(window).scroll(() => { this.onScroll(); });
		$(window).resize(() => { this.onResize(); });
	}
	
	onTabClick(event, element) {
		event.preventDefault();
		let scrollTop = $(element.attr('href')).offset().top - this.tabContainerHeight + 1;
		$('html, body').animate({ scrollTop: scrollTop }, 600);
	}
	
	onScroll() {
		this.checkTabContainerPosition();
    this.findCurrentTabSelector();
	}
	
	onResize() {
		if(this.currentId) {
			this.setSliderCss();
		}
	}
	
	checkTabContainerPosition() {
		let offset = $('.et-hero-tabs').offset().top + $('.et-hero-tabs').height() - this.tabContainerHeight;
		if($(window).scrollTop() > offset) {
			$('.et-hero-tabs-container').addClass('et-hero-tabs-container--top');
		} 
		else {
			$('.et-hero-tabs-container').removeClass('et-hero-tabs-container--top');
		}
	}
	
	findCurrentTabSelector(element) {
		let newCurrentId;
		let newCurrentTab;
		let self = this;
		$('.et-hero-tab').each(function() {
			let id = $(this).attr('href');
			let offsetTop = $(id).offset().top - self.tabContainerHeight;
			let offsetBottom = $(id).offset().top + $(id).height() - self.tabContainerHeight;
			if($(window).scrollTop() > offsetTop && $(window).scrollTop() < offsetBottom) {
				newCurrentId = id;
				newCurrentTab = $(this);
			}
		});
		if(this.currentId != newCurrentId || this.currentId === null) {
			this.currentId = newCurrentId;
			this.currentTab = newCurrentTab;
			this.setSliderCss();
		}
	}
	
	setSliderCss() {
		let width = 0;
		let left = 0;
		if(this.currentTab) {
			width = this.currentTab.css('width');
			left = this.currentTab.offset().left;
		}
		$('.et-hero-tab-slider').css('width', width);
		$('.et-hero-tab-slider').css('left', left);
	}
	
}

new StickyNavigation();
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
</head>
<body>

<h2>Tabel Pengguna</h2>
<br>

<a class="btn btn-primary" href="tambah.php" role="button">Tambah Data</a>
<br>
<br>

<table class="table">
  <thead>
    <tr>
	  <th scope="col"></th>
	  <th scope="col">Id_pengguna</th>
	  <th scope="col">nama_pengguna</th>
	  <th scope="col">jenis_kelamin</th>
	  <th scope="col">email</th>
    </tr>
  </thead>
  <?php
  // Koneksi ke database
  $koneksi = new mysqli("localhost", "root", "", "nail_peminjamanbarang");

  // Periksa koneksi
  if ($koneksi->connect_error) {
      die("Koneksi gagal: " . $koneksi->connect_error);
  }

  // Query data pengguna
  $sql = "SELECT * FROM pengguna";
  $result = $koneksi->query($sql);

  if ($result->num_rows > 0) {
      $no = 1;
      while($row = $result->fetch_assoc()) {
  ?>
  <tr>
	<td><?php echo $no++; ?></td>
    <td><?php echo $row['id_pengguna']; ?></td>
	<td><?php echo $row['nama_pengguna']; ?></td>
    <td><?php echo $row['jenis_kel']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td>
        <a href="edit.php?id=1" class="btn btn-primary">Edit</a> <a href="deleteee.php" class="btn btn-primary">Hapus</a>
    </td>
  </tr>
  <?php
      }
  } else {
      echo "";
  }

  // Tutup koneksi
  $koneksi->close();
  ?>
</table>

</body>
</html>