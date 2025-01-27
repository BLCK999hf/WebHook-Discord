document.getElementById("announcementForm").addEventListener("submit", function(event) {
    event.preventDefault();
  
    var titulo = document.getElementById("titulo").value;
    var conteudo = document.getElementById("conteudo").value;
    var cor = document.getElementById("cor").value;
    var negrito = document.getElementById("negrito").checked;
    var italico = document.getElementById("italico").checked;
  
    var mensagem = {
      embeds: [{
        title: titulo,
        description: conteudo,
        color: parseInt(cor)
      }]
    };
  
    if (negrito) {
      mensagem.embeds[0].description = "**" + mensagem.embeds[0].description + "**";
    }
  
    if (italico) {
      mensagem.embeds[0].description = "*" + mensagem.embeds[0].description + "*";
    }
  
    enviarAnuncio(mensagem);
  });
  
  function enviarAnuncio(mensagem) {
    var webhookURL = "https://discord.com/api/webhooks/1111499496250150912/8wbqfESwSdegoYqUQ1n1abeIuQyTd9nUzkU7aT-_fVgs-h3mRYL1BqgXGEaqTCB5Kg9F";
  
    var request = new XMLHttpRequest();
    request.open("POST", webhookURL);
    request.setRequestHeader("Content-type", "application/json");
    request.send(JSON.stringify(mensagem));
  
    request.onload = function() {
      if (request.status === 204) {
        alert("Anúncio enviado com sucesso!");
      } else {
        alert("Erro ao enviar o anúncio. Por favor, tente novamente.");
      }
    };
  }
  