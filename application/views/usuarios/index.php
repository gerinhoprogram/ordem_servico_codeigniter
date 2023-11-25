

    <?php $this->load->view('layout/sidebar') ?>

      <!-- Main Content -->
      <div id="content">

        <?php $this->load->view('layout/navbar') ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- breadcrumb -->
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
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
            <div class="card-header py-3">
              <a title="Cadastrar" href="<?php echo base_url('usuarios/adicionar'); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-user-plus"></i>&nbsp;Novo</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Usuário</th>
                      <th>Login</th>
                      <th>Perfil</th>
                      <th>Ativo</th>
                      <th class="text-right no-sort">Ações</th>
                    </tr>
                  </thead>
                  <!-- <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Usuário</th>
                      <th>Login</th>
                      <th>Ativo</th>
                      <th>Ações</th>
                    </tr>
                  </tfoot> -->
                  <tbody>
                    <?php foreach($usuarios as $item) : ?>
                    <tr>
                      <td><?php echo $item->id ?></td>
                      <td><?php echo $item->username ?></td>
                      <td><?php echo $item->email ?></td>
                      <td><?php echo ($this->ion_auth->is_admin($item->id) ? 'Administrador' : 'Vendedor') ?></td>
                      <td><?php echo $item->active ==  1 ? 'Sim' : 'Não' ?></td>
                      <td class="text-right">
                        <a title="Editar" href="<?php echo base_url('usuarios/editar/'.$item->id) ?>" class="btn btn-sm btn-primary"><i class='fas fa-user-edit'></i></a>
                        <a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#user<?php echo $item->id; ?>" class="btn btn-sm btn-danger"><i class='fas fa-user-times'></i></a>
                      </td>
                    </tr>

                      <!-- Logout Modal-->
                      <div class="modal fade" id="user<?php echo $item->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja excluir?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <div class="modal-body">Para excluir este usuário clica em "Sim".</div>
                              <div class="modal-footer">
                                <button class="btn btn-success btn-sm" type="button" data-dismiss="modal">Não</button>
                                <a class="btn btn-danger btn-sm" href="<?php echo base_url('usuarios/deletar/'.$item->id) ?>">Sim</a>
                              </div>
                            </div>
                          </div>
                        </div>

                    <?php endforeach; ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     
