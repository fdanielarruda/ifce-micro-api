<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Access</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <div class="card esperando-card active">
            <h1>Aguardando...</h1>
            <p>Estamos esperando suas credenciais para verificar o acesso.</p>
        </div>

        <div class="card acesso-liberado">
            <h1>Acesso Liberado</h1>
            <p>Você tem permissão para acessar esta área.</p>
        </div>

        <div class="card acesso-negado">
            <h1>Acesso Negado</h1>
            <p>Você não tem permissão para acessar esta área.</p>
        </div>
    </div>

    @vite('resources/js/app.js')
</body>

<script>
    function switchCard(showSelector) {
        document.querySelectorAll('.card').forEach(card => {
            card.classList.remove('active');
        });
        document.querySelector(showSelector).classList.add('active');
    }

    setTimeout(() => {
        window.Echo.channel('AccessChannel')
            .listen('AccessEvent', (e) => {
                const isAllowed = e.is_allowed;

                if (isAllowed) {
                    switchCard('.acesso-liberado');
                } else {
                    switchCard('.acesso-negado');
                }

                setTimeout(() => {
                    switchCard('.esperando-card');
                }, 5000);
            });
    }, 200);
</script>

</html>