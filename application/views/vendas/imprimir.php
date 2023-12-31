<?php $this->load->view('layout/sidebar') ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar') ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('vendas') ?>">Vendas</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php echo $titulo ?>
                </li>
            </ol>
        </nav>

        <?php if($message = $this->session->flashdata('sucesso')) : ?>
              <div class='row'>
                <div class='col-lg-12'>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class='far fa-smile-wink'></i></strong>&nbsp;&nbsp; <?php echo $message ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                </div>
              </div>
          <?php endif; ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3"></div>
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-4">
                        <a href="<?php echo base_url('vendas/pdf/'.$venda->venda_id) ?>" class="btn btn-dark btn-icon-split btn-lg">
                            <span class="icon text-white-50"><i class="fas fa-print"></i></span>
                            <span class="text">Imprimir Venda</span>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="<?php echo base_url('vendas/adicionar') ?>" class="btn btn-success btn-icon-split btn-lg">
                            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                            <span class="text">Cadastrar nova venda</span>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="<?php echo base_url('vendas') ?>" class="btn btn-info btn-icon-split btn-lg">
                            <span class="icon text-white-50"><i class="fas fa-list-ol"></i></span>
                            <span class="text">Listar ondens</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->