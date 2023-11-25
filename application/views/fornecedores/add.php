<?php $this->load->view('layout/sidebar') ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar') ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('fornecedores') ?>">Fornecedores</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php echo $titulo ?>
                </li>
            </ol>
        </nav>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <div class="card-body">
                <form method="POST" name="form_add" class="user">

                    <fieldset class="mb-4 border p-2">
                        <legend class="font-small">Dados pessoais</legend>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="fornecedor_razao" class="form-label">*Razão social</label>
                                <input type="text" class="form-control" name="fornecedor_razao" aria-describedby="emailHelp" value="<?php echo set_value('fornecedor_razao') ?>">
                                <?php echo form_error('fornecedor_razao','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="fornecedor_nome_fantasia" class="form-label">*Nome fantasia</label>
                                <input type="text" class="form-control" name="fornecedor_nome_fantasia" aria-describedby="emailHelp" value="<?php echo set_value('fornecedor_nome_fantasia') ?>">
                                <?php echo form_error('fornecedor_nome_fantasia','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                           
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                    <label for="fornecedor_cnpj" class="form-label">*CNPJ</label>
                                    <input type="text" class="form-control cnpj" name="fornecedor_cnpj" aria-describedby="emailHelp" value="<?php echo set_value('fornecedor_cnpj') ?>">
                                    <?php echo form_error('fornecedor_cnpj','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                           </div>

                            <div class="col-md-3">
                                <label for="fornecedor_telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control sp_celphones" name="fornecedor_telefone" aria-describedby="emailHelp" placeholder="Telefone" value="<?php echo set_value('fornecedor_telefone') ?>">
                                <?php echo form_error('fornecedor_telefone','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>

                            <div class="col-md-3">
                                <label for="fornecedor_celular" class="form-label">Celular</label>
                                <input type="text" class="form-control sp_celphones" name="fornecedor_celular" aria-describedby="emailHelp" placeholder="Celular" value="<?php echo set_value('fornecedor_celular') ?>">
                                <?php echo form_error('fornecedor_celular','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>

                            <div class="col-md-3">
                                <label for="fornecedor_email" class="form-label">*E-mail</label>
                                <input type="email" class="form-control" name="fornecedor_email" aria-describedby="emailHelp" value="<?php echo set_value('fornecedor_email') ?>">
                                <?php echo form_error('fornecedor_email','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                    <label for="fornecedor_contato" class="form-label pessoa_juridica">Contato</label>
                                    <input type="text" class="form-control" name="fornecedor_contato" aria-describedby="emailHelp" value="<?php echo set_value('fornecedor_contato')  ?>">
                                    <?php echo form_error('fornecedor_contato','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="fornecedor_ie" class="form-label pessoa_juridica">IE</label>
                                <input type="text" class="form-control" name="fornecedor_ie" aria-describedby="emailHelp" value="<?php echo set_value('fornecedor_ie')  ?>">
                                <?php echo form_error('fornecedor_ie','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>

                    </fieldset>

                    <button type="submit" class="btn btn-success btn-md"><i class="fas fa-floppy"></i>&nbsp;&nbsp;Salvar</button>
                    <a title="Voltar" href="<?php echo base_url('fornecedores') ?>" class="btn btn-primary btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Voltar</a>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->