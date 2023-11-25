<?php $this->load->view('layout/sidebar') ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar') ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('produtos') ?>">Produtos</a></li>
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
                        <legend class="font-small">Dados principais</legend>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="produto_codigo" class="form-label">Código interno</label>
                                <input type="text" class="form-control" name="produto_codigo" readonly="" value="<?php echo $produto_codigo ?>">
                            </div>
                            <div class="col-md-9">
                                <label for="produto_descricao" class="form-label">*Descrição</label>
                                <input type="text" class="form-control" name="produto_descricao" aria-describedby="emailHelp" value="<?php echo set_value('produto_descricao') ?>">
                                <?php echo form_error('produto_descricao','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="produto_marca_id" class="form-label">Marca</label>
                                <select class="form-control" name="produto_marca_id">
                                <?php foreach ($marcas as $marca): ?>
                                        <option value="<?php echo $marca->marca_id ?>">
                                            <?php echo $marca->marca_nome ?>
                                        </option>
                                <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="produto_categoria_id" class="form-label">Categoria</label>
                                <select class="form-control" name="produto_categoria_id">
                                <?php foreach ($categorias as $categoria): ?>
                                        <option value="<?php echo $categoria->categoria_id ?>">
                                        <?php echo $categoria->categoria_nome ?>
                                        </option>
                                <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="produto_fornecedor_id" class="form-label">Fornecedor</label>
                                <select class="form-control" name="produto_fornecedor_id">
                                <?php foreach ($fornecedores as $fornecedor): ?>
                                        <option value="<?php echo $fornecedor->fornecedor_id ?>">
                                            <?php echo $fornecedor->fornecedor_nome_fantasia?>
                                        </option>
                                <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="produto_unidade" class="form-label">Produto Unidade</label>
                                <input type="text" class="form-control" name="produto_unidade" aria-describedby="emailHelp" value="<?php echo set_value('produto_unidade') ?>">
                                <?php echo form_error('produto_unidade','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="produto_preco_custo" class="form-label">Preço custo</label>
                                <input type="text" class="form-control money" name="produto_preco_custo" aria-describedby="emailHelp" value="<?php echo set_value('produto_preco_custo') ?>">
                                <?php echo form_error('produto_preco_custo','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-3">
                                <label for="produto_preco_venda" class="form-label">Preço venda</label>
                                <input type="text" class="form-control money" name="produto_preco_venda" aria-describedby="emailHelp" value="<?php echo set_value('produto_preco_venda') ?>">
                                <?php echo form_error('produto_preco_venda','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-2">
                                <label for="produto_estoque_minimo" class="form-label">Estoque mínimo</label>
                                <input type="number" class="form-control" name="produto_estoque_minimo" aria-describedby="emailHelp" value="<?php echo set_value('produto_estoque_minimo') ?>">
                                <?php echo form_error('produto_estoque_minimo','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-2">
                                <label for="produto_qtde_estoque" class="form-label">QTD em estoque</label>
                                <input type="number" class="form-control" name="produto_qtde_estoque" aria-describedby="emailHelp" value="<?php echo set_value('produto_qtde_estoque') ?>">
                                <?php echo form_error('produto_qtde_estoque','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-2">
                                <label for="produto_ativo" class="form-label">Ativo</label>
                                <select name="produto_ativo" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="produto_obs" class="form-label">OBS</label>
                                <textarea class="form-control form-control-user" name="produto_obs"><?php echo set_value('produto_obs') ?></textarea> 
                            </div>
                        </div>

                       
                    </fieldset>


                    <button type="submit" class="btn btn-success btn-md"><i class="fas fa-floppy"></i>&nbsp;&nbsp;Salvar</button>
                    <a title="Voltar" href="<?php echo base_url('produtos') ?>" class="btn btn-primary btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Voltar</a>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->