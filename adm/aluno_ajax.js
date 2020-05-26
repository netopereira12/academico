/** * Função para criar um objeto XMLHTTPRequest */
function CriaRequest() {
	try{
		request = new XMLHttpRequest();
	}catch (IEAtual){
		try{
			request = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(IEAntigo){
			try{ request = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(falha){
			request = false;
		}
	}
}
if (!request)
	alert("Seu Navegador não suporta Ajax!");
else
	return request;
}

/** * Função para enviar os dados */
function getDoc(){
	
	var nome   = document.getElementById("txtnome").value;
	var result = document.getElementById("resultado");
	var xmlreq = CriaRequest();
	
	// Exibi a imagem de progresso
	result.innerHTML = "<img src='img/carregando.gif'/>";
	
	// Iniciar uma requisição
	xmlreq.open("GET", "aluno_doc.php?id=" + nome, true);
	
	// Atribui uma função para ser executada sempre que houver uma mudança de ado
	xmlreq.onreadystatechange = function(){
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {
			// Verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				result.innerHTML = xmlreq.responseText;
			}else{ result.innerHTML = "Erro: " + xmlreq.statusText;
		}
	}
 };
     xmlreq.send(null);

}
/** * Função para enviar os dados */
function getDocDig(){
	
	var nome   = document.getElementById("dig").value;
	var result = document.getElementById("resultado");
	var xmlreq = CriaRequest();
	
	// Exibi a imagem de progresso
	result.innerHTML = "<img src='img/carregando.gif'/>";
	
	// Iniciar uma requisição
	xmlreq.open("GET", "aluno_doc_dig.php?id=" + nome, true);
	
	// Atribui uma função para ser executada sempre que houver uma mudança de ado
	xmlreq.onreadystatechange = function(){
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {
			// Verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				result.innerHTML = xmlreq.responseText;
			}else{ result.innerHTML = "Erro: " + xmlreq.statusText;
		}
	}
 };
     xmlreq.send(null);

}
function getDocEmitido(){
	
	var nome   = document.getElementById("emitido").value;
	var result = document.getElementById("resultado");
	var xmlreq = CriaRequest();
	
	// Exibi a imagem de progresso
	result.innerHTML = "<img src='img/carregando.gif'/>";
	
	// Iniciar uma requisição
	xmlreq.open("GET", "aluno_doc_emitido.php?id=" + nome, true);
	
	// Atribui uma função para ser executada sempre que houver uma mudança de ado
	xmlreq.onreadystatechange = function(){
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {
			// Verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				result.innerHTML = xmlreq.responseText;
			}else{ result.innerHTML = "Erro: " + xmlreq.statusText;
		}
	}
 };
     xmlreq.send(null);

}

function getMatricula(){
	
	var nome   = document.getElementById("matricula").value;
	var result = document.getElementById("resultado");
	var xmlreq = CriaRequest();
	
	// Exibi a imagem de progresso
	result.innerHTML = "<img src='img/carregando.gif'/>";
	
	// Iniciar uma requisição
	xmlreq.open("GET", "aluno_matricula.php?id=" + nome, true);
	
	// Atribui uma função para ser executada sempre que houver uma mudança de ado
	xmlreq.onreadystatechange = function(){
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {
			// Verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				result.innerHTML = xmlreq.responseText;
			}else{ result.innerHTML = "Erro: " + xmlreq.statusText;
		}
	}
 };
     xmlreq.send(null);

}
