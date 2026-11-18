<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD de Pessoa</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f5f7; margin: 0; color: #222; }
        main { max-width: 640px; margin: 40px auto; background: #fff; padding: 24px 28px; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,.1); }
        h1 { margin-top: 0; font-size: 1.4rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { text-align: left; padding: 8px; border-bottom: 1px solid #e3e5e8; }
        a.btn, button { display: inline-block; padding: 6px 12px; border: 0; border-radius: 4px; background: #2563eb; color: #fff; text-decoration: none; cursor: pointer; font-size: .9rem; }
        a.btn.sec { background: #6b7280; }
        button.perigo { background: #dc2626; }
        form.inline { display: inline; }
        label { display: block; margin-top: 12px; font-weight: 600; }
        input[type=text], input[type=number] { width: 100%; padding: 8px; margin-top: 4px; box-sizing: border-box; border: 1px solid #c4c7cc; border-radius: 4px; }
        .msg { background: #dcfce7; padding: 10px 12px; border-radius: 4px; margin-bottom: 12px; }
        .erros { background: #fee2e2; padding: 10px 12px; border-radius: 4px; margin-bottom: 12px; }
        .erros ul { margin: 0; padding-left: 18px; }
        .vazio { color: #6b7280; margin-top: 16px; }
    </style>
</head>
<body>
<main>
    <?php require $arquivoView; ?>
</main>
</body>
</html>
