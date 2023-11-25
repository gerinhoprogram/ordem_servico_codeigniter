<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('home') ?>">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3">Sistema ERP</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url('home') ?>">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Home</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-vendas" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-shopping-cart"></i>
    <span>Vendas</span>
  </a>
  <div id="collapse-vendas" class="collapse" aria-labelledby="heading4" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?php echo base_url('os') ?>">Ordens de serviços</a>
      <a class="collapse-item" href="<?php echo base_url('vendas') ?>">Vendas</a>
    </div>
  </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cog"></i>
    <span>Cadastros</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?php echo base_url('clientes') ?>">Clientes</a>
      <a class="collapse-item" href="<?php echo base_url('fornecedores') ?>">Fornecedores</a>
      <a class="collapse-item" href="<?php echo base_url('vendedores') ?>">Vendedores</a>
      <a class="collapse-item" href="<?php echo base_url('servicos') ?>">Serviços</a>
    </div>
  </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-box-open"></i>
    <span>Estoque</span>
  </a>
  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?php echo base_url('marcas') ?>">Marcas</a>
      <a class="collapse-item" href="<?php echo base_url('categorias') ?>">Categorias</a>
      <a class="collapse-item" href="<?php echo base_url('produtos') ?>">Produtos</a>
    </div>
  </div>
</li>

<?php if($this->ion_auth->is_admin()): ?>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cog"></i>
    <span>Financeiro</span>
  </a>
  <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?php echo base_url('pagar') ?>">Contas a pagar</a>
      <a class="collapse-item" href="<?php echo base_url('receber') ?>">Contas a receber</a>
      <a class="collapse-item" href="<?php echo base_url('modulo') ?>">Formas de pagamentos</a>
    </div>
  </div>
</li>
<?php endif ?>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cog"></i>
    <span>Relatórios</span>
  </a>
  <div id="collapse5" class="collapse" aria-labelledby="heading4" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?php echo base_url('relatorios/vendas') ?>">Vendas</a>
      <a class="collapse-item" href="<?php echo base_url('relatorios/os') ?>">Ordens de serviços</a>
      <a class="collapse-item" href="<?php echo base_url('relatorios/receber') ?>">Contas a receber</a>
      <a class="collapse-item" href="<?php echo base_url('relatorios/pagar') ?>">Contas a pagar</a>
    </div>
  </div>
</li>

<?php if($this->ion_auth->is_admin()): ?>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url('sistema') ?>" title="Gerenciar dados do sistema">
    <i class="fas fa-fw fa-cogs"></i>
    <span>Sistema</span></a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url('usuarios') ?>" title="Gerenciar usuário">
    <i class="fas fa-fw fa-users"></i>
    <span>Usuários</span></a>
</li>

<?php endif ?>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">