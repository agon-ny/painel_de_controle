<?php
    $usuariosOnline = Painel::listarUsuariosOnline();

	$pegarVisitasTotais = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas`");
	$pegarVisitasTotais->execute();

	$pegarVisitasTotais = $pegarVisitasTotais->rowCount();

	$pegarVisitasHoje = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia = ?");
	$pegarVisitasHoje->execute(array(date('Y-m-d')));

	$pegarVisitasHoje = $pegarVisitasHoje->rowCount();
?>
    <div class="info-home-boxes">
        <div class="single-info-box">
            <h1>Usuários online</h1>
            <h2><?php echo count($usuariosOnline); ?></h2>
        </div>

        <div class="single-info-box">
            <h1>Total de visitas</h1>
            <h2><?php echo $pegarVisitasTotais; ?></h2>
        </div>

        <div class="single-info-box">
            <h1>Visitas hoje</h1>
            <h2><?php echo $pegarVisitasHoje; ?></h2>
        </div>
    </div>

    <div class="option-name-box">
        <i class="fas fa-globe-americas"></i>
        <h1>Usuários online no site</h1>
    </div>

    <div class="responsive-table">
        <table>
            <tr>
                <th>IP</th>
                <th>Última ação</th>
            </tr>

            <?php
                foreach($usuariosOnline as $key => $value){
            ?>
            <tr>
                <td><?php echo $value['ip']; ?></td>
                <td><?php echo date('d/m/Y H:i',  strtotime($value['ultima_acao'])) ?></td>
            </tr>
            <?php
                };
            ?>
        </table>
    </div>

    <div class="option-name-box">
        <i class="fas fa-users-cog"></i>
        <h1>Administradores do painel</h1>
    </div>

    <div class="responsive-table">
        <table>
            <tr>
                <th>Nome</th>
                <th>Cargo</th>
            </tr>

            <?php
            $usuarios = Painel::selecionarTodosDados('tb_admin.usuarios');
            foreach($usuarios as $key => $value){
            ?>
            <tr>
                <td><?php echo $value['nome']; ?></td>
                <td><?php echo Painel::$cargo[$value['cargo']]; ?></td>
            </tr>
            <?php
                };
            ?>
        </table>
    </div>