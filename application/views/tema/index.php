<?php $this->load->view('tema/header') ?>
<style>
	.content-wrapper {
		background-image: url(<?= base_url('assets/dist/img/background.jpg') ?>);
		background-repeat: no-repeat;
		background-size: cover;
	}
</style>

<body class="hold-transition">
	<div class="wrapper">

		<?php $this->load->view('tema/navbar') ?>
		<?php $this->load->view('tema/sidebar') ?>

		<div class="content-wrapper">
			<?php $this->load->view('tema/breadcrumb') ?>

			<div class="content">
				<div class="container-fluid">
					<?= $contents ?>
				</div>
			</div>
		</div>
		<?php $this->load->view('tema/footer') ?>


	</div>


	<?php $this->load->view('tema/js') ?>
</body>

</html>