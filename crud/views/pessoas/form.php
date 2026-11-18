<?php
$editando = $pessoa !== null;
$acao = $editando ? 'atualizar&id=' . $pessoa->getId() : 'salvar';
?>
<h1><?= $editando ? 'Editar pessoa' : 'Nova pessoa' ?></h1>

<?php if (!empty($erros)): ?>
    <div class="erros">
        <ul>
            <?php foreach ($erros as $erro): ?>
                <li><?= htmlspecialchars($erro) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="index.php?acao=<?= $acao ?>">
    <label for="nome">Nome</label>
    <input type="text" id="nome" name="nome" maxlength="100"
           value="<?= htmlspecialchars((string) $antigo['nome']) ?>" required>

    <label for="idade">Idade</label>
    <input type="number" id="idade" name="idade" min="0" max="150"
           value="<?= htmlspecialchars((string) $antigo['idade']) ?>" required>

    <p>
        <button type="submit">Salvar</button>
        <a class="btn sec" href="index.php">Cancelar</a>
    </p>
</form>
