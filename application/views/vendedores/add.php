<?php $this->load->view('layout/sidebar') ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar') ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('vendedores') ?>">Vendedores</a></li>
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
                            <div class="col-md-4">
                                <label for="vendedor_nome_completo" class="form-label">*Nome</label>
                                <input type="text" class="form-control" name="vendedor_nome_completo" aria-describedby="emailHelp" value="<?php echo set_value('vendedor_nome_completo') ?>">
                                <?php echo form_error('vendedor_nome_completo','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="vendedor_cpf" class="form-label">*CPF</label>
                                <input type="text" class="form-control cpf" name="vendedor_cpf" aria-describedby="emailHelp" value="<?php echo set_value('vendedor_cpf') ?>">
                                <?php echo form_error('vendedor_cpf','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                    <label for="vendedor_rg" class="form-label">*RG</label>
                                    <input type="text" class="form-control cpf" name="vendedor_rg" aria-describedby="emailHelp" value="<?php echo set_value('vendedor_rg') ?>">
                                    <?php echo form_error('vendedor_rg','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="vendedor_email" class="form-label">*E-mail</label>
                                <input type="email" class="form-control" name="vendedor_email" aria-describedby="emailHelp" placeholder="E-mail" value="<?php echo set_value('vendedor_email') ?>">
                                <?php echo form_error('vendedor_email','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="vendedor_telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control sp_celphones" name="vendedor_telefone" aria-describedby="emailHelp" placeholder="Telefone" value="<?php echo set_value('vendedor_telefone') ?>">
                                <?php echo form_error('vendedor_telefone','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="vendedor_celular" class="form-label">Celular</label>
                                <input type="text" class="form-control sp_celphones" name="vendedor_celular" aria-describedby="emailHelp" placeholder="Celular" value="<?php echo set_value('vendedor_celular') ?>">
                                <?php echo form_error('vendedor_celular','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mb-4 border p-2">
                        <legend class="font-small"> Dados de endereço</legend>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="vendedor_cep" class="form-label">*CEP</label>
                                <input type="text" class="form-control cep" name="vendedor_cep" aria-describedby="emailHelp" placeholder="CEP" value="<?php echo set_value('vendedor_cep') ?>">
                                <?php echo form_error('vendedor_cep','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-2">
                                <label for="vendedor_estado" class="form-label">*Estado</label>
                                <input type="text" class="form-control" name="vendedor_estado" aria-describedby="emailHelp" placeholder="Estado" value="<?php echo set_value('vendedor_estado') ?>">
                                <?php echo form_error('vendedor_estado','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="vendedor_cidade" class="form-label">*Cidade</label>
                                <input type="text" class="form-control" name="vendedor_cidade" aria-describedby="emailHelp" placeholder="Cidade" value="<?php echo set_value('vendedor_cidade') ?>">
                                <?php echo form_error('vendedor_cidade','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="vendedor_bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" name="vendedor_bairro" aria-describedby="emailHelp" placeholder="Bairro" value="<?php echo set_value('vendedor_bairro') ?>">
                                <?php echo form_error('vendedor_bairro','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="vendedor_numero_endereco" class="form-label">Número</label>
                                <input type="text" class="form-control" name="vendedor_numero_endereco" aria-describedby="emailHelp" placeholder="Número" value="<?php echo set_value('vendedor_numero_endereco') ?>">
                                <?php echo form_error('vendedor_numero_endereco','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-5">
                                <label for="vendedor_endereco" class="form-label">Endereço</label>
                                <input type="text" class="form-control" name="vendedor_endereco" aria-describedby="emailHelp" placeholder="Endereço" value="<?php echo set_value('vendedor_endereco') ?>">
                                <?php echo form_error('vendedor_endereco','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mb-4 border p-2">
                        <legend class="font-small">Configurações</legend>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="cliente_ativo" class="form-label">Vendedor ativo</label>
                                <select class="form-control" name="cliente_ativo" id="cliente_ativo">
                                  <option value="0">Não</option>
                                  <option value="1">Sim</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="vendedor_codigo" class="form-label">Matrícula</label>
                                <input type="text" class="form-control" name="vendedor_codigo" aria-describedby="emailHelp" value="<?php echo $vendedor_codigo ?>" readonly="">
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="vendedor_obs" class="form-label">Oservações</label>
                            <textarea class="form-control" name="vendedor_obs" aria-describedby="emailHelp" placeholder="Observações"><?php echo set_value('vendedor_obs') ?></textarea>
                            <?php echo form_error('vendedor_obs','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-md"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
                    <a title="Voltar" href="<?php echo base_url('vendedores') ?>" class="btn btn-primary btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Voltar</a>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->