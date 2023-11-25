

    <?php $this->load->view('layout/sidebar') ?>

<!-- Main Content -->
<div id="content">

  <?php $this->load->view('layout/navbar') ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
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

          <?php if($message = $this->session->flashdata('error')) : ?>
              <div class='row'>
                <div class='col-lg-12'>
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><i class='fas fa-exclamation-triangle'></i></strong>&nbsp;&nbsp; <?php echo $message ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                </div>
              </div>
          <?php endif; ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
              <form method="POST" name="form_edit">
                  <div class="form-group row mb-5">
                        <div class="col-md-4">
                              <label for="sistema_razao_social" class="form-label">Razão social</label>
                              <input type="text" class="form-control" name="sistema_razao_social" aria-describedby="emailHelp" placeholder="Razão social" value="<?php echo $sistema->sistema_razao_social ?>">
                              <?php echo form_error('sistema_razao_social','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                        <div class="col-md-4">
                              <label for="sistema_nome_fantasia" class="form-label">Nome fantasia</label>
                              <input type="text" class="form-control" name="sistema_nome_fantasia" placeholder="Nome fantasia" value="<?php echo $sistema->sistema_nome_fantasia ?>">
                              <?php echo form_error('sistema_nome_fantasia','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                        <div class="col-md-4">
                                <label for="sistema_cnpj" class="form-label">CNPJ</label>
                                <input type="text" class="form-control cnpj" name="sistema_cnpj" placeholder="CNPJ" value="<?php echo $sistema->sistema_cnpj ?>">
                                <?php echo form_error('sistema_cnpj','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                  </div>
                  <div class="form-group row mb-5">
                        <div class="col-md-3">
                              <label for="sistema_ie" class="form-label">Inscrição estatual</label>
                              <input type="text" class="form-control" name="sistema_ie" aria-describedby="emailHelp" placeholder="inscrição estadual" value="<?php echo $sistema->sistema_ie ?>">
                              <?php echo form_error('sistema_ie','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                        <div class="col-md-3">
                              <label for="sistema_telefone_fixo" class="form-label">Telefone</label>
                              <input type="text" class="form-control sp_celphones" name="sistema_telefone_fixo" aria-describedby="emailHelp" placeholder="Telefone" value="<?php echo $sistema->sistema_telefone_fixo ?>">
                              <?php echo form_error('sistema_telefone_fixo','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                        <div class="col-md-3">
                              <label for="sistema_site_url" class="form-label">Site</label>
                              <input type="text" class="form-control" name="sistema_site_url" aria-describedby="emailHelp" placeholder="Site url" value="<?php echo $sistema->sistema_site_url ?>">
                              <?php echo form_error('sistema_site_url','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                        <div class="col-md-3">
                              <label for="sistema_email" class="form-label">E-mail</label>
                              <input type="email" class="form-control" name="sistema_email" aria-describedby="emailHelp" placeholder="E-mail" value="<?php echo $sistema->sistema_email ?>">
                              <?php echo form_error('sistema_email','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                  </div>
                  <div class="form-group row mb-5">
                        <div class="col-md-2">
                              <label for="sistema_estado" class="form-label">Estado</label>
                              <input type="text" class="form-control uf" name="sistema_estado" aria-describedby="emailHelp" placeholder="Estado" value="<?php echo $sistema->sistema_estado ?>">
                              <?php echo form_error('sistema_estado','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                        <div class="col-md-4">
                              <label for="sistema_cidade" class="form-label">Cidade</label>
                              <input type="text" class="form-control" name="sistema_cidade" aria-describedby="emailHelp" placeholder="Cidade" value="<?php echo $sistema->sistema_cidade ?>">
                              <?php echo form_error('sistema_cidade','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                        <div class="col-md-3">
                              <label for="sistema_cep" class="form-label">Cep</label>
                              <input type="text" class="form-control cep" name="sistema_cep" aria-describedby="emailHelp" placeholder="CEP" value="<?php echo $sistema->sistema_cep ?>">
                              <?php echo form_error('sistema_cep','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                        <div class="col-md-3">
                              <label for="sistema_numero" class="form-label">Número</label>
                              <input type="text" class="form-control" name="sistema_numero" aria-describedby="emailHelp" placeholder="Número" value="<?php echo $sistema->sistema_numero ?>">
                              <?php echo form_error('sistema_numero','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                  </div>
                  <div class="form-group row mb-5">
                        <div class="col-md-5">
                              <label for="sistema_endereco" class="form-label">Endereço</label>
                              <input type="text" class="form-control" name="sistema_endereco" aria-describedby="emailHelp" placeholder="Endereço" value="<?php echo $sistema->sistema_endereco ?>">
                              <?php echo form_error('sistema_endereco','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                  </div>
                  <div class="form-group row mb-5">
                        <div class="col-md-12">
                              <label for="sistema_endereco" class="form-label">Texto da ordem de serviço</label>
                              <textarea class="form-control" name="sistema_txt_ordem_servico" aria-describedby="emailHelp" placeholder="Ordem de serviço"></textarea>
                              <?php echo form_error('sistema_txt_ordem_servico','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                  </div>

                  <input type="hidden" name="id" value="<?php echo $sistema->id ?>">
                 
                  <button type="submit" class="btn btn-success btn-sm">Salvar</button>
              </form>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


