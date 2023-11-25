

    <?php $this->load->view('layout/sidebar') ?>

<!-- Main Content -->
<div id="content">

  <?php $this->load->view('layout/navbar') ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">
  
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('usuarios') ?>">Usuários</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
      </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <a title="Voltar" href="<?php echo base_url('usuarios') ?>" class="btn btn-primary btn-sm float-right"><i class="fas fa-arrow-left"></i>&nbsp;Voltar</a>
      </div>
      <div class="card-body">
              <form method="POST" name="form_add">
                  <div class="form-group row">
                        <div class="col-md-4">
                              <label for="nome" class="form-label">Nome</label>
                              <input type="text" class="form-control" name="first_name" aria-describedby="emailHelp" placeholder="Nome" value="<?php echo set_value('first_name'); ?>">
                              <?php echo form_error('first_name','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                        <div class="col-md-4">
                              <label for="Sobrenome" class="form-label">Sobrenome</label>
                              <input type="text" class="form-control" name="last_name" aria-describedby="emailHelp" placeholder="Sobrenome" value="<?php echo set_value('last_name'); ?>">
                              <?php echo form_error('last_name','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                        <div class="col-md-4">
                                <label for="email" class="form-label">E-mail (login)</label>
                                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="E-mail" value="<?php echo set_value('email'); ?>">
                                <?php echo form_error('email','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                  </div>

                  <div class="form-group row">
                      <div class="col-md-4">
                          <label for="usuario" class="form-label">Usuário</label>
                          <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="usuário" value="<?php echo set_value('username'); ?>">
                          <?php echo form_error('username','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                      <div class="col-md-4">
                          <label for="ativo" class="form-label">Ativo</label>
                          <select name="active" class="form-control">
                                <option value="0">Não</option>
                                <option value="1">Sim</option>
                              </select>
                        </div>
                        <div class="col-md-4">
                          <label for="perfil" class="form-label">Perfil de acesso</label>
                          <select name="perfil_usuario" class="form-control">
                                <option value="2">Vendedor</option>
                                <option value="1">Administrador</option>
                              </select>
                        </div>
                  </div>

                  <div class="form-group row">
                        <div class="col-md-6">
                          <label for="senha" class="form-label">Senha</label>
                          <input type="password" class="form-control" name="password" aria-describedby="emailHelp" placeholder="senha">
                          <?php echo form_error('password','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                        <div class="col-md-6">
                          <label for="confirm_password" class="form-label">Confirmar senha</label>
                          <input type="password" class="form-control" name="confirm_password" aria-describedby="emailHelp" placeholder="Confirmar senha">
                          <?php echo form_error('confirm_password','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>

                        </div>
                  </div>
                 
                  <button type="submit" class="btn btn-success btn-sm">Salvar</button>
              </form>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


