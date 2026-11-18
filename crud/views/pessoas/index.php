<h1>Pessoas</h1>

<?php if (!empty($mensagem)): ?>
    <div class="msg"><?= htmlspecialchars($mensagem) ?></div>
<?php endif; ?>

<a class="btn" href="index.php?acao=criar">+ Nova pessoa</a>

<?php if (empty($pessoas)): ?>
    <p class="vazio">Nenhuma pessoa cadastrada.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Idade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($pessoas as $p): ?>
            <tr>
                <td><?= $p->getId() ?></td>
                <td><?= htmlspecialchars($p->getNome()) ?></td>
                <td><?= $p->getIdade() ?></td>
                <td>
                    <a class="btn sec" href="index.php?acao=editar&id=<?= $p->getId() ?>">Editar</a>
                    <form class="inline" method="post" action="index.php?acao=excluir&id=<?= $p->getId() ?>"
                          onsubmit="return confirm('Excluir esta pessoa?');">
                        <button class="perigo" type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
