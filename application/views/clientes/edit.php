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
                        <?php echo formata_data_banco_sem_hora($cliente->cliente_data_alteracao) ?>
                    </p>
                    <fieldset class="mb-4 border p-2">
                        <legend class="font-small">Dados pessoais</legend>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="cliente_nome" class="form-label">*Nome</label>
                                <input type="text" class="form-control" name="cliente_nome" aria-describedby="emailHelp" placeholder="Nome" value="<?php echo $cliente->cliente_nome ?>">
                                <?php echo form_error('cliente_nome','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="cliente_sobrenome" class="form-label">*Sobrenome</label>
                                <input type="text" class="form-control" name="cliente_sobrenome" aria-describedby="emailHelp" placeholder="Sobrenome" value="<?php echo $cliente->cliente_sobrenome ?>">
                                <?php echo form_error('cliente_sobrenome','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="cliente_email" class="form-label">*E-mail</label>
                                <input type="email" class="form-control" name="cliente_email" aria-describedby="emailHelp" placeholder="E-mail" value="<?php echo $cliente->cliente_email ?>">
                                <?php echo form_error('cliente_email','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <?php if($cliente->cliente_tipo == 1) : ?>
                                    <label for="cliente_cpf" class="form-label">*CPF</label>
                                    <input type="text" class="form-control cpf" name="cliente_cpf" aria-describedby="emailHelp" placeholder="CPF" value="<?php echo $cliente->cliente_cpf_cnpj ?>">
                                    <?php echo form_error('cliente_cpf','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                                <?php else:  ?>
                                    <label for="cliente_cnpj" class="form-label">*CNPJ</label>
                                    <input type="text" class="form-control cnpj" name="cliente_cnpj" aria-describedby="emailHelp" placeholder="CNPJ" value="<?php echo $cliente->cliente_cpf_cnpj ?>">
                                    <?php echo form_error('cliente_cnpj','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                                <?php endif  ?>
                           </div>

                            <div class="col-md-3">
                                <label for="cliente_telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control sp_celphones" name="cliente_telefone" aria-describedby="emailHelp" placeholder="Telefone" value="<?php echo $cliente->cliente_telefone ?>">
                                <?php echo form_error('cliente_telefone','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>

                            <div class="col-md-3">
                                <label for="cliente_celular" class="form-label">Celular</label>
                                <input type="text" class="form-control sp_celphones" name="cliente_celular" aria-describedby="emailHelp" placeholder="Celular" value="<?php echo $cliente->cliente_celular ?>">
                                <?php echo form_error('cliente_celular','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>

                            <div class="col-md-3">
                                <label for="cliente_data_nascimento" class="form-label">Data de nascimento</label>
                                <input type="date" class="form-control" name="cliente_data_nascimento" aria-describedby="emailHelp" value="<?php echo $cliente->cliente_data_nascimento ?>">
                                <?php echo form_error('cliente_data_nascimento','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-6">
                                <label for="cliente_rg_ie" class="form-label">*RG</label>
                                <input type="text" class="form-control" name="cliente_rg_ie" aria-describedby="emailHelp" placeholder="RG" value="<?php echo $cliente->cliente_rg_ie ?>">
                                <?php echo form_error('cliente_rg_ie','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mb-4 border p-2">
                        <legend class="font-small"> Dados de endereço</legend>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="cliente_cep" class="form-label">*CEP</label>
                                <input type="text" class="form-control cep" name="cliente_cep" aria-describedby="emailHelp" placeholder="CEP" value="<?php echo $cliente->cliente_cep ?>">
                                <?php echo form_error('cliente_cep','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-2">
                                <label for="cliente_estado" class="form-label">*Estado</label>
                                <input type="text" class="form-control" name="cliente_estado" aria-describedby="emailHelp" placeholder="Estado" value="<?php echo $cliente->cliente_estado ?>">
                                <?php echo form_error('cliente_estado','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="cliente_cidade" class="form-label">*Cidade</label>
                                <input type="text" class="form-control" name="cliente_cidade" aria-describedby="emailHelp" placeholder="Cidade" value="<?php echo $cliente->cliente_cidade ?>">
                                <?php echo form_error('cliente_cidade','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="cliente_bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" name="cliente_bairro" aria-describedby="emailHelp" placeholder="Bairro" value="<?php echo $cliente->cliente_bairro ?>">
                                <?php echo form_error('cliente_bairro','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="cliente_numero_endereco" class="form-label">Número</label>
                                <input type="text" class="form-control" name="cliente_numero_endereco" aria-describedby="emailHelp" placeholder="Número" value="<?php echo $cliente->cliente_numero_endereco ?>">
                                <?php echo form_error('cliente_numero_endereco','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-5">
                                <label for="cliente_endereco" class="form-label">*Endereço</label>
                                <input type="text" class="form-control" name="cliente_endereco" aria-describedby="emailHelp" placeholder="Endereço" value="<?php echo $cliente->cliente_endereco ?>">
                                <?php echo form_error('cliente_endereco','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-5">
                                <label for="cliente_complemento" class="form-label">Complemento</label>
                                <input type="text" class="form-control" name="cliente_complemento" aria-describedby="emailHelp" placeholder="Complemento" value="<?php echo $cliente->cliente_complemento ?>">
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
                                  <option value="0" <?php echo $cliente->cliente_ativo == 0 ? 'selected' : '' ?>>Não</option>
                                  <option value="1" <?php echo $cliente->cliente_ativo == 1 ? 'selected' : '' ?>>Sim</option>
                                </select>
                                <?php echo form_error('cliente_obs','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="cliente_obs" class="form-label">Oservações</label>
                            <textarea class="form-control" name="cliente_obs" aria-describedby="emailHelp" placeholder="Observações"><?php echo $cliente->cliente_obs ?></textarea>
                            <?php echo form_error('cliente_obs','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                    </div>

                    <input type="hidden" name="cliente_id" value="<?php echo $cliente->cliente_id ?>">
                    <input type="hidden" name="cliente_tipo" value="<?php echo $cliente->cliente_tipo ?>">

                    <button type="submit" class="btn btn-success btn-md"><i class="fas fa-floppy"></i>&nbsp;&nbsp;Salvar</button>
                    <a title="Voltar" href="<?php echo base_url('clientes') ?>" class="btn btn-primary btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Voltar</a>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->