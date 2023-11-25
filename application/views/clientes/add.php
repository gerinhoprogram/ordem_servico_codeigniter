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
                <form method="POST" name="form_add" class="user">
                    <div class="custom-control custom-radio custom-control-inline mt-2 mb-5">
                        <input type="radio" id="pessoa_fisica" name="cliente_tipo" class="custom-control-input" value="1" <?php echo set_checkbox('cliente_tipo', '1') ?> checked="">
                        <label class="custom-control-label pt-1" for="pessoa_fisica">Pessoa física</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline mt-2 mb-5">
                        <input type="radio" id="pessoa_juridica" name="cliente_tipo" class="custom-control-input" value="0" <?php echo set_checkbox('cliente_tipo', '0') ?> >
                        <label class="custom-control-label pt-1" for="pessoa_juridica">Pessoa jurídica</label>
                    </div>

                    <fieldset class="mb-4 border p-2">
                        <legend class="font-small">Dados pessoais</legend>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="cliente_nome" class="form-label">*Nome</label>
                                <input type="text" class="form-control" name="cliente_nome" aria-describedby="emailHelp" placeholder="Nome" value="<?php echo set_value('cliente_nome') ?>">
                                <?php echo form_error('cliente_nome','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="cliente_sobrenome" class="form-label">*Sobrenome</label>
                                <input type="text" class="form-control" name="cliente_sobrenome" aria-describedby="emailHelp" placeholder="Sobrenome" value="<?php echo set_value('cliente_sobrenome') ?>">
                                <?php echo form_error('cliente_sobrenome','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="cliente_email" class="form-label">*E-mail</label>
                                <input type="email" class="form-control" name="cliente_email" aria-describedby="emailHelp" placeholder="E-mail" value="<?php echo set_value('cliente_email') ?>">
                                <?php echo form_error('cliente_email','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">

                                <div class="pessoa_fisica">
                                    <label for="cliente_cpf" class="form-label">*CPF</label>
                                    <input type="text" class="form-control cpf" name="cliente_cpf" aria-describedby="emailHelp" placeholder="CPF" value="<?php echo set_value('cliente_cpf') ?>">
                                    <?php echo form_error('cliente_cpf','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                                </div>
                                <div class="pessoa_juridica">
                                    <label for="cliente_cnpj" class="form-label">*CNPJ</label>
                                    <input type="text" class="form-control cnpj" name="cliente_cnpj" aria-describedby="emailHelp" placeholder="CNPJ" value="<?php echo set_value('cliente_cnpj') ?>">
                                    <?php echo form_error('cliente_cnpj','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                                </div>
                               
                           </div>

                            <div class="col-md-3">
                                <label for="cliente_telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control sp_celphones" name="cliente_telefone" aria-describedby="emailHelp" placeholder="Telefone" value="<?php echo set_value('cliente_telefone') ?>">
                                <?php echo form_error('cliente_telefone','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>

                            <div class="col-md-3">
                                <label for="cliente_celular" class="form-label">Celular</label>
                                <input type="text" class="form-control sp_celphones" name="cliente_celular" aria-describedby="emailHelp" placeholder="Celular" value="<?php echo set_value('cliente_celular') ?>">
                                <?php echo form_error('cliente_celular','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>

                            <div class="col-md-3">
                                <label for="cliente_data_nascimento" class="form-label">Data de nascimento</label>
                                <input type="date" class="form-control" name="cliente_data_nascimento" aria-describedby="emailHelp" value="<?php echo set_value('cliente_data_nascimento')  ?>">
                                <?php echo form_error('cliente_data_nascimento','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-6">
                                <label for="cliente_rg_ie" class="form-label pessoa_fisica">*RG</label>
                                <label for="cliente_rg_ie" class="form-label pessoa_juridica">*IE</label>
                                <input type="text" class="form-control" name="cliente_rg_ie" aria-describedby="emailHelp" placeholder="RG" value="<?php echo set_value('cliente_rg_ie')  ?>">
                                <?php echo form_error('cliente_rg_ie','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mb-4 border p-2">
                        <legend class="font-small"> Dados de endereço</legend>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="cliente_cep" class="form-label">*CEP</label>
                                <input type="text" class="form-control cep" name="cliente_cep" aria-describedby="emailHelp" placeholder="CEP" value="<?php echo set_value('cliente_cep') ?>">
                                <?php echo form_error('cliente_cep','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-2">
                                <label for="cliente_estado" class="form-label">*Estado</label>
                                <input type="text" class="form-control" name="cliente_estado" aria-describedby="emailHelp" placeholder="Estado" value="<?php echo set_value('cliente_estado') ?>">
                                <?php echo form_error('cliente_estado','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="cliente_cidade" class="form-label">*Cidade</label>
                                <input type="text" class="form-control" name="cliente_cidade" aria-describedby="emailHelp" placeholder="Cidade" value="<?php echo set_value('cliente_cidade') ?>">
                                <?php echo form_error('cliente_cidade','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="cliente_bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" name="cliente_bairro" aria-describedby="emailHelp" placeholder="Bairro" value="<?php echo set_value('cliente_bairro') ?>">
                                <?php echo form_error('cliente_bairro','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="cliente_numero_endereco" class="form-label">Número</label>
                                <input type="text" class="form-control" name="cliente_numero_endereco" aria-describedby="emailHelp" placeholder="Número" value="<?php echo set_value('cliente_numero_endereco') ?>">
                                <?php echo form_error('cliente_numero_endereco','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-5">
                                <label for="cliente_endereco" class="form-label">*Endereço</label>
                                <input type="text" class="form-control" name="cliente_endereco" aria-describedby="emailHelp" placeholder="Endereço" value="<?php echo set_value('cliente_endereco') ?>">
                                <?php echo form_error('cliente_endereco','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-5">
                                <label for="cliente_complemento" class="form-label">Complemento</label>
                                <input type="text" class="form-control" name="cliente_complemento" aria-describedby="emailHelp" placeholder="Complemento" value="<?php echo set_value('cliente_complemento') ?>">
                                <?php echo form_error('cliente_complemento','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mb-4 border p-2">
                        <legend class="font-small">Configurações</legend>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="cliente_ativo" class="form-label">Cliente ativo</label>
                                <select class="form-control" name="cliente_ativo" id="cliente_ativo">
                                  <option value="0">Não</option>
                                  <option value="1">Sim</option>
                                </select>
                                <?php echo form_error('cliente_obs','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="cliente_obs" class="form-label">Oservações</label>
                            <textarea class="form-control" name="cliente_obs" aria-describedby="emailHelp" placeholder="Observações"></textarea>
                            <?php echo form_error('cliente_obs','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-md"><i class="fas fa-floppy"></i>&nbsp;&nbsp;Salvar</button>
                    <a title="Voltar" href="<?php echo base_url('clientes') ?>" class="btn btn-primary btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Voltar</a>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->