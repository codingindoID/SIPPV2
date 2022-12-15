<?php $this->load->view('tema/header') ?>

<body class="hold-transition sidebar-mini">
	<div class="wrapper">

		<?php $this->load->view('tema/navbar') ?>
		<?php $this->load->view('tema/sidebar') ?>

		<div class="content-wrapper">
			<?php $this->load->view('tema/breadcrumb') ?>

			<div class="content">
				<div class="container-fluid">

				</div>
			</div>
		</div>
		<?php $this->load->view('tema/footer') ?>


	</div>


	<?php $this->load->view('tema/js') ?>
</body>

</html>