<?php

class Sessao
{

    public static function duracao()
    {
        // Defina o tempo limite de inatividade em segundos (15 minutos = 900 segundos)
        $tempo_limite = 900;

        // Verifique se o usuário está logado e se a última atividade está registrada
        if (isset($_SESSION['id_usuario']) && isset($_SESSION['ultima_atividade'])) {
            // Verifique quanto tempo se passou desde a última atividade
            $tempo_atual = time(); // time() retorna o horario do servidor em segundos que se passaram desde 1/1/1970 00:00
            $tempo_da_ultima_atividade = $_SESSION['ultima_atividade'];
            $tempo_inativo = $tempo_atual - $tempo_da_ultima_atividade;

            // Se o tempo de inatividade exceder o limite, deslogue o usuário
            if ($tempo_inativo > $tempo_limite) {
                header('Location: /defi/controllers/logout.php');
            }
        }

        // Atualize o tempo da última atividade
        $_SESSION['ultima_atividade'] = time();
    }
}
