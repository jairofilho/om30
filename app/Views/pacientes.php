<?php
require_once 'top.php';
require_once 'menu.php';
?>
<div id="caixa" class="caixa"></div>

<script type="text/javascript" charset="utf-8">
	var mensagem = "<?php echo $mensagem; ?>";
    var url = "<?php echo "$base/pacientes/lista"; ?>";
	$.ajax({
		type: "POST",
		url: url,
		success: function(data)
		{
			var tabela = webix.ui({
				id: "tudo",
				container: "caixa",
				rows:
				[
    				{
						type: "header",
						template: "<div class='tituloLista'>Pacientes<a href='<?php echo $base; ?>/pacientes/inserir'><i class='fas fa-plus-square iconeTitulo webixtype_base' data-toggle='tooltip' title='Adicionar paciente'></i></a></div>"
					},{
                        scroll: "y",
						view: "datatable",
						id: "gradeid",
						columns:
						[
							{
								id: "pac_nome",
								header:
								[
									"Nome",
									{
										content: "textFilter",
										placeholder: "Filtrar",
										compare: oneForAll,
										colspan: 7
									}
								],
								sort: "string",
								fillspace: 2
							},{
								id: "pac_mae",
								header: "Nome da mãe",
								sort: "string",
								fillspace: 2
							},{
								id: "pac_cpf",
								header: "CPF",
								sort: "string",
								fillspace: 1
							},{
								id: "pac_cns",
								header: "CNS",
								sort: "string",
								fillspace: 1
							},{
								id: "exibir",
								header: "",
								template:  "<a href='<?php echo $base; ?>/pacientes/exibir/#pac_id#'><i class='fas fa-eye iconeLista webixtype_base' data-toggle='tooltip' title='Exibe registro'></i></a>",
								width: 40
							},{
								id: "editar",
								header: "",
								template:  "<a href='<?php echo $base; ?>/pacientes/editar/#pac_id#'><i class='fas fa-edit iconeLista webixtype_base' data-toggle='tooltip' title='Edita registro'></i></a>",
								width: 40
							},{
								id: "apagar",
								header: "",
                                template: "<a href='<?php echo $base; ?>/pacientes/excluir/#pac_id#' onClick='return confirm(\"O registro será permanentemente excluido. Tem certeza?\")'><i class='fas fa-trash-alt iconeLista webixtype_base' data-toggle='tooltip' title='Excluir registro'></i></a>",
								width: 40
							}
						],
						data: data,
						pager: "pagerid",
						autoConfig: true
					},{
						cols:
						[
							{
								view: "pager",
								id: "pagerid",
								template: "{common.first()} {common.prev()} {common.pages()} {common.next()} {common.last()}",
								size: 100,
								group: 5
							},{
                                template: "Resultados por página:",
                                width: 200,
                                css: "resultados"
                            },{
								view: "select",
								id: "selectid",
								options:[ "5", "10", "25", "50", "100", "250", "500" ],
								on:{
									onChange: function()
									{
										$$("gradeid").getPager().config.size = this.getValue()*1;
										$$("gradeid").refresh();
									}
								},
								width: 120
							}
						],
						height: 30
					}
				]
			});
			webix.event(window, "resize", function(){ tabela.adjust(); });
			
			$(document).ready(function(){
				var paginacao = $$("gradeid").getPager().config.size;
				$$("selectid").setValue(paginacao);
			});
			
			function equals(a, b)
			{
				if (a != null)
				{
					a = a.toString().toLowerCase();
					return a.indexOf(b) !== -1;
				}
			}

			function oneForAll(value, filter, obj)
			{
				if (equals(obj.pac_nome, filter)) return true;
				if (equals(obj.pac_mae, filter)) return true;
				if (equals(obj.pac_cpf, filter)) return true;
				return false;
			}
			
			if (mensagem != "") webix.alert(mensagem,"alert-warning");

		}
	});
</script>
<?php require_once 'bot.php'; ?>