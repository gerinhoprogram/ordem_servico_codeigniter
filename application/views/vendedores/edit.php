<?php $this->load->view('layout/sidebar') ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar') ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('clientes') ?>">Clientes</a></li>
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
                <form method="POST" name="form_edit" class="user">
                    <p><strong><i class="fas fa-clock"></i>&nbsp;&nbsp;Última atualização:</strong>
                        <?php echo formata_data_banco_sem_hora($vendedor->vendedor_data_alteracao) ?>
                    </p>
                    <fieldset class="mb-4 border p-2">
                        <legend class="font-small">Dados pessoais</legend>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="vendedor_nome_completo" class="form-label">*Nome completo</label>
                                <input type="text" class="form-control" name="vendedor_nome_completo" aria-describedby="emailHelp" value="<?php echo $vendedor->vendedor_nome_completo ?>">
                                <?php echo form_error('vendedor_nome_completo','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-3">
                                <label for="vendedor_cpf" class="form-label">*CPF</label>
                                <input type="text" class="form-control" name="vendedor_cpf" aria-describedby="emailHelp" value="<?php echo $vendedor->vendedor_cpf ?>">
                                <?php echo form_error('vendedor_cpf','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-3">
                                <label for="vendedor_rg" class="form-label">*RG</label>
                                <input type="text" class="form-control rg" name="vendedor_rg" aria-describedby="emailHelp" value="<?php echo $vendedor->vendedor_rg ?>">
                                <?php echo form_error('vendedor_rg','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="vendedor_email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="vendedor_email" aria-describedby="emailHelp" value="<?php echo $vendedor->vendedor_email ?>">
                                <?php echo form_error('vendedor_email','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-3">
                                <label for="vendedor_telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control sp_celphones" name="vendedor_telefone" aria-describedby="emailHelp" value="<?php echo $vendedor->vendedor_telefone ?>">
                                <?php echo form_error('vendedor_telefone','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-3">
                                <label for="vendedor_celular" class="form-label">Celular</label>
                                <input type="text" class="form-control sp_celphones" name="vendedor_celular" aria-describedby="emailHelp" value="<?php echo $vendedor->vendedor_celular ?>">
                                <?php echo form_error('vendedor_celular','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="vendedor_endereco" class="form-label">Endereço</label>
                                <input type="text" class="form-control" name="vendedor_endereco" aria-describedby="emailHelp" value="<?php echo $vendedor->vendedor_endereco ?>">
                                <?php echo form_error('vendedor_endereco','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="vendedor_numero_endereco" class="form-label">Número</label>
                                <input type="text" class="form-control" name="vendedor_numero_endereco" aria-describedby="emailHelp" value="<?php echo $vendedor->vendedor_numero_endereco ?>">
                                <?php echo form_error('vendedor_numero_endereco','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="vendedor_estado" class="form-label">Estado</label>
                                <input type="text" class="form-control" name="vendedor_estado" aria-describedby="emailHelp" value="<?php echo $vendedor->vendedor_estado ?>">
                                <?php echo form_error('vendedor_estado','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="vendedor_cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" name="vendedor_cidade" aria-describedby="emailHelp" value="<?php echo $vendedor->vendedor_cidade ?>">
                                <?php echo form_error('vendedor_cidade','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="vendedor_bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" name="vendedor_bairro" aria-describedby="emailHelp" value="<?php echo $vendedor->vendedor_bairro ?>">
                                <?php echo form_error('vendedor_bairro','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="vendedor_ativo" class="form-label">Status</label>
                                <select name="vendedor_ativo" class="form-control">
                                    <option value="0" <?php echo ($vendedor->vendedor_ativo == 0) ? 'selected' : '' ?>>Não</option>
                                    <option value="1" <?php echo ($vendedor->vendedor_ativo == 1) ? 'selected' : '' ?>>Sim</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="vendedor_codigo" class="form-label">Matrícula</label>
                                <input type="text" class="form-control" name="vendedor_codigo" aria-describedby="emailHelp" value="<?php echo $vendedor->vendedor_codigo ?>" readonly="">
                                <?php echo form_error('vendedor_codigo','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="vendedor_obs" class="form-label">Observações</label>
                                <textarea class="form-control form-control-user" name="vendedor_obs"><?php echo $vendedor->vendedor_obs ?></textarea> 
                            </div>
                        </div>

                    <input type="hidden" name="vendedor_id" value="<?php echo $vendedor->vendedor_id ?>">

                    <button type="submit" class="btn btn-success btn-md"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
                    <a title="Voltar" href="<?php echo base_url('vendedores') ?>" class="btn btn-primary btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Voltar</a>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->