
let tablePedidos = "";
if(document.querySelector("#tablePedidos"))
{
    tablePedidos = $('#tablePedidos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/pedidos/getPedidos",
            "dataSrc":""
        },
        "columns":[
            {"data":"idpedido"},
            {"data":"nombres"},
            {"data":"apellidos"},
            {"data":"nombreservicio"},
            {"data":"fecha"},
            {"data":"options"}
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Esportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Esportar a PDF",
                "className": "btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Esportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });
}

//Eliminar orden
function fntDelInfo(idpedido){
    swal({
        title: "Eliminar Pedido",
        text: "¿Realmente quiere eliminar al pedido?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/pedidos/delPedido';
            let strData = "idpedido="+idpedido;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tablePedidos.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}

// Tabla insumos

$('#tableInsumosReq').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax":{
        "url": base_url+"/Insumos/getInsumosDetalle",
        "dataSrc":""
    },
    "columns":[
        {"data":"idinsumos"},
        {"data":"nombre"},
        {"data":"cantidad"},
        {"data":"options"}
    ],
    "resonsieve":"true",
    "bDestroy": true,
    "iDisplayLength": 5,
    "order":[[0,"desc"]],
});

//====================================================

async function fntGetPacientes(){
    try{
        let rowsHtml = "";
        let resp = await fetch(base_url+"/pacientes/getPacientesReq");
        if(resp.status == 200){
            json = await resp.json();
            if(json.status == 303 || json.status == 400 ){
                window.location.href= base_url+'/logout'; 
            }else{
                $('#tblPacientesReq').DataTable( {
                    "aProcessing":true,
                    "aServerSide":true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                    },
                    "data" : json,
                    "columns":[
                                {"data":"idpersona"},
                                {"data":"identificacion"},
                                {"data":"nombrecompleto"},
                                {"data":"options"}
                            ],
                    "resonsieve":"true",
                    "bDestroy": true,
                    "iDisplayLength": 5,
                    "order":[[0,"desc"]]  
                });
            }
        }
    }catch(err){
        console.log("Ocurrio un error: "+err);
    }
}

async function fntGetServicios(){
    try{
        let rowsHtml = "";
        let resp = await fetch(base_url+"/servicios/getServiciosReq");
        if(resp.status == 200){
            json = await resp.json();
            if(json.status == 303 || json.status == 400 ){
                window.location.href= base_url+'/logout'; 
            }else{
                $('#tblServiciosReq').DataTable( {
                    "aProcessing":true,
                    "aServerSide":true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                    },
                    "data" : json,
                    "columns":[
                                {"data":"idservicio"},
                                {"data":"nombreservicio"},
                                {"data":"options"}
                            ],
                    "resonsieve":"true",
                    "bDestroy": true,
                    "iDisplayLength": 5,
                    "order":[[0,"desc"]]  
                });
            }
        }
    }catch(err){
        console.log("Ocurrio un error: "+err);
    }
}

function fntAddDetalle(id)
{
	let cantidad = document.querySelector("#txtcant-"+id).value;
	if(isNaN(cantidad) || cantidad < 1){
		swal("", "Por favor ingrese cantidad mayor que 0." , "error");
        return false;
	}else{
		let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	    let ajaxUrl = base_url+'/pedidos/addDetalle'; 
	    let formData = new FormData();
	    formData.append('id',id);
	    formData.append('cant',cantidad);
	    request.open("POST",ajaxUrl,true);
	    request.send(formData);
	    request.onreadystatechange = function(){
	        if(request.readyState != 4) return;
	        if(request.status == 200){
	        	let objData = JSON.parse(request.responseText);
	        	if(objData.status){
		            document.querySelector("#tblDetalleInsumos").innerHTML = objData.htmlDetalle;
					swal("", objData.msg, "success");
	        	}else{
	        		swal("", objData.msg , "error");
	        	}
	        } 
	        return false;
	    }
	}
}

function fntDelDetalle(id){
	let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/pedidos/delDetalle'; 
    let formData = new FormData();
    formData.append('id',id);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState != 4) return;
        if(request.status == 200){
        	let objData = JSON.parse(request.responseText);
        	if(objData.status){
	            document.querySelector("#tblDetalleInsumos").innerHTML = objData.htmlDetalle;
				swal("", objData.msg, "success");
        	}else{
        		swal("", objData.msg , "error");
        	}
        } 
        return false;
    }
}

async function fntSeleccionarPaciente(idpaciente) {
    try{
        let resp = await fetch(base_url+"/Pacientes/getPaciente/"+idpaciente);
        if(resp.status == 200){
            json = await resp.json();
            if(json.status){
                objData = json.data;
                document.querySelector("#txtidPaciente").value = objData.idpersona;
                document.querySelector("#txtIdentPaciente").value = objData.identificacion;
                document.querySelector("#txtNombres").value = objData.nombres+' '+objData.apellidos;
                let msg ="Paciente seleccionado: "+ objData.nombres+' '+objData.apellidos ;
                $('#busquedaPaciente').modal('hide');
                swal("",msg,"success");
            }else{
                swal("",json.msg,"error");  
            }
        }else{
            swal("","Error en la solicitud","error");
        }

    }catch(err){
        console.log("Ocurrio un error: "+err);
    }
}

async function fntSeleccionarServicio(idservicio)
{
    try{
        let resp = await fetch(base_url+"/Servicios/getServicio/"+idservicio);
        if(resp.status == 200){
            json = await resp.json();
            if(json.status){
                objData = json.data;
                document.querySelector("#txtidServicio").value = objData.idservicio;
                document.querySelector("#txtBuscarServicio").value = objData.nombreservicio;
                let msg ="Servicio seleccionado: "+ objData.nombreservicio;
                $('#busquedaServicio').modal('hide');
                swal("",msg,"success");
            }else{
                swal("",json.msg,"error");  
            }
        }else{
            swal("","Error en la solicitud","error");
        }

    }catch(err){
        console.log("Ocurrio un error: "+err);
    }   
}

//Registrar cuenta
if(document.querySelector("#btnActionSave")){
    let frmRegistro = document.querySelector("#btnActionSave");
    frmRegistro.onclick = function(e){
        e.preventDefault();
        fntGuardar();
    }

    async function fntGuardar(){
        let intIdPaciente = document.querySelector("#txtidPaciente").value;
        let intIdServicio = document.querySelector("#txtidServicio").value;
        let intIdPedido = document.querySelector("#txtidPedido").value;
        //let cantInsumos = document.querySelector("#tblDetalleInsumos tr").length;
        let notas = document.querySelector("#txtNotas").value;

        let nrows = 0;
        $("#tblDetalleInsumos tr").each(function() {
             nrows++;
        });

        if(intIdPaciente == ""){
            swal("","El paciente es requerido.","warning");
            return;
        }
        if(intIdServicio == ""){
            swal("","El servicio es requerido.","warning");
            return;
        }

        if(nrows == 0 ){
            swal("","Ingrese insumos al detalle.","warning");
            return;
        }

        try{
            const data = new FormData();
            data.append('idpaciente',intIdPaciente);
            data.append('idservicio',intIdServicio);
            data.append('idpedido',intIdPedido);
            data.append('notas',notas);
            
            let resp = await fetch(base_url+"/pedidos/registrar",{
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                body: data
            });

            if(resp.status == 200){
                json = await resp.json();
                if(json.status){
                    let idorden = json.orden;
                    swal("",json.msg,"success");
                    window.location.href = base_url+"/pedidos/verorden/"+idorden;
                }else{
                    swal("",json.msg,"error");  
                }
            }else{
                alert("Error en la solicitud");
            }
        }catch(err){
            console.log("Ocurrio un error: "+err);
        }       
    }
}

window.addEventListener('load', function() {
    
}, false);