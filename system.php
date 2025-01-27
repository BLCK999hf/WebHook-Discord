<?php

// Dados do webhook do Discord
$webhookURL = "https://discord.com/api/webhooks/SEU_WEBHOOK_URL";

// Dados do formulário
$autor = $_POST['autor'];
$titulo = $_POST['titulo'];
$rodape = $_POST['rodape'];
$corCategoria = $_POST['cor_categoria'];
$ativarCampos = isset($_POST['ativar_campos']);

// Dados dos campos adicionais
$campo1 = $_POST['campo1'] ?? '';
$campo2 = $_POST['campo2'] ?? '';

// Criação da mensagem de embed
$mensagem = [
  "embeds" => [
    [
      "author" => [
        "name" => $autor
      ],
      "title" => $titulo,
      "footer" => [
        "text" => $rodape
      ],
      "color" => intval($corCategoria)
    ]
  ]
];

// Adicionar campos adicionais, se ativados
if ($ativarCampos) {
  $camposAdicionais = [];

  if (!empty($campo1)) {
    $camposAdicionais[] = [
      "name" => "Campo 1",
      "value" => $campo1
    ];
  }

  if (!empty($campo2)) {
    $camposAdicionais[] = [
      "name" => "Campo 2",
      "value" => $campo2
    ];
  }

  if (!empty($camposAdicionais)) {
    $mensagem["embeds"][0]["fields"] = $camposAdicionais;
  }
}

// Enviar a mensagem para o webhook
$ch = curl_init($webhookURL);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($mensagem));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);
curl_close($ch);

// Verificar se a mensagem foi enviada com sucesso
if ($response === false) {
  echo "Erro ao enviar o anúncio.";
} else {
  echo "Anúncio enviado com sucesso.";
}

?>
 