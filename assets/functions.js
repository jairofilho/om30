// Validação do CPF
function validaCPF(cpf)
{
	
	cpf = cpf.replaceAll(".", "");
	cpf = cpf.replaceAll("-", "");

	var soma = 0;
	var resto = 0;
	var tamanho = cpf.length;

	if (tamanho < 11)
	{
		return false;
	}

	if (cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
	{
		return false;
	}
	
	for (i = 1; i <= 9; i++) soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
	resto = (soma * 10) % 11;
	if (resto == 10 || resto == 11)  resto = 0;
	if (resto != parseInt(cpf.substring(9, 10)))
	{
		return false;
	}

	soma = 0;
	for (i = 1; i <= 10; i++) soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
	resto = (soma * 10) % 11;
	if ((resto == 10) || (resto == 11))  resto = 0;
	if (resto != parseInt(cpf.substring(10, 11)))
	{
		return false;
	}

	return true;

}


// Validação do CNS
function validaCNS(cns)
{
	
	cns = cns.replaceAll(" ", "");

	var soma = 0;
	var resto = 0;
	var dv = 0;
	var pis = cns.substring(0, 11);
	var primeiro = cns.substring(0, 1);
	var resultado = "";
	var tamanho = cns.length;

	if (tamanho < 15)
	{
		return false;
	}

	if (primeiro == 1 || primeiro == 2)
	{
	
		for (i = 0; i <= 10; i++) soma += parseInt(pis.substring(i, i + 1) * (15 - i));

		resto = soma % 11;
		dv = 11 - resto;

		if (dv == 11) dv = 0;

		if (dv == 10)
		{
			soma += 2;
			resto = soma % 11;
			dv = 11 - resto;
			resultado = pis + "001" + String(dv);
		} else {
			resultado = pis + "000" + String(dv);
		}

		if (cns != resultado)
		{
			return false;
		} else {
			return true;
		}
	
	} else {

		if (primeiro == 7 || primeiro == 8 || primeiro == 9)
		{
			for (i = 0; i <= 14; i++) soma += parseInt(cns.substring(i, i + 1) * (15 - i));
			resto = soma % 11;
			if (resto != 0)
			{
				return false;
			} else {
				return true;
			}
		} else {
			return false;
		}

	}
}


// Consulta viacep
function viacep(url)
{
	var dados;
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		success: function(data) {
			dados = data;
		}
	});
	return dados;
}


// Valida data
function validaData(data)
{
	var ardt = new Array;
	var ExpReg = new RegExp("(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/[12][0-9]{3}");
	ardt = data.split("/");
	if (data.search(ExpReg) == -1) return false
	if (((ardt[1] == 4) || (ardt[1] == 6) || (ardt[1] == 9) || (ardt[1] == 11)) && (ardt[0] > 30)) return false
	if (ardt[1] == 2)
	{
		if ((ardt[0] > 28) && ((ardt[2] % 4) != 0)) return false
		if ((ardt[0] > 29) && ((ardt[2] % 4) == 0)) return false
	}return true;
}