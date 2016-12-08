var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
if(dd<10){dd='0'+dd} 
if(mm<10){mm='0'+mm}
today = yyyy+'-'+mm+'-'+dd;
var waitingmsg = "<br /><img src='"+host+"__assets/frontend/img/logo-homtel.png' /><br /><br /> Please Wait <br /><br />";

$(function() {
	if(typeof paa == "undefined"){
		loadUrl(host+'dashboardapp', 'dashboard');
	}
});


function loadUrl(urls, classnav){
	$.blockUI({ message: waitingmsg });
	setTimeout(function(){
		$("#navigation li").parent().find('li').removeClass("active");
		$("#konten").empty().addClass("loading");
		$.get(urls,function (html){
			var parsing = $.parseJSON(html);
			$("#konten").html(parsing.page).removeClass("loading");
			$("#"+classnav).addClass("active");
			$(".main-panel").perfectScrollbar('update');
		});
		$.unblockUI();
	}, 1000);
}

function getClientHeight(){
	var theHeight;
	if (window.innerHeight)
		theHeight=window.innerHeight;
	else if (document.documentElement && document.documentElement.clientHeight) 
		theHeight=document.documentElement.clientHeight;
	else if (document.body) 
		theHeight=document.body.clientHeight;
	
	return theHeight;
}

var divcontainer;
function windowFormPanel(html,judul,width,height){
	divcontainer = $('#jendela');
	$(divcontainer).unbind();
	$('#isiJendela').html(html);
    $(divcontainer).window({
		title:judul,
		width:width,
		height:height,
		autoOpen:false,
		top: Math.round(frmHeight/2)-(height/2),
		left: Math.round(frmWidth/2)-(width/2),
		modal:true,
		maximizable:false,
		minimizable: false,
		collapsible: false,
		closable: true,
		resizable: false,
	    onBeforeClose:function(){	   
			$(divcontainer).window("close",true);
			//$(divcontainer).window("destroy",true);
			//$(divcontainer).window('refresh');
			return true;
	    }		
    });
    $(divcontainer).window('open');       
}
function windowFormClosePanel(){
    $(divcontainer).window('close');
	//$(divcontainer).window('refresh');
}

var container;
function windowForm(html,judul,width,height){
    container = "win"+Math.floor(Math.random()*9999);
    $("<div id="+container+"></div>").appendTo("body");
    container = "#"+container;
    $(container).html(html);
    $(container).css('padding','5px');
    $(container).window({
       title:judul,
       width:width,
       height:height,
       autoOpen:false,
       maximizable:false,
       minimizable: false,
	   collapsible: false,
       resizable: false,
       closable:true,
       modal:true,
	   onBeforeClose:function(){	   
			$(container).window("close",true);
			$(container).window("destroy",true);
			return true;
	   }
    });
    $(container).window('open');        
}
function closeWindow(){
    $(container).window('close');
    $(container).html("");
}


function getClientWidth(){
	var theWidth;
	if (window.innerWidth) 
		theWidth=window.innerWidth;
	else if (document.documentElement && document.documentElement.clientWidth) 
		theWidth=document.documentElement.clientWidth;
	else if (document.body) 
		theWidth=document.body.clientWidth;

	return theWidth;
}


function genGrid(modnya, divnya, lebarnya, tingginya, par1){
	if(lebarnya == undefined){
		lebarnya = getClientWidth-250;
	}
	if(tingginya == undefined){
		tingginya = getClientHeight-300
	}

	var kolom ={};
	var frozen ={};
	var judulnya;
	var param={};
	var urlnya;
	var urlglobal="";
	var url_detil="";
	var post_detil={};
	var fitnya;
	var klik=false;
	var doble_klik=false;
	var pagesizeboy = 10;
	var singleSelek = true;
	var nowrap_nya = true;
	var footer=false;
	
	switch(modnya){
		case "wartakomisi":
			judulnya = "";
			urlnya = "warkom";
			fitnya = true;
			urlglobal = host+'backend/getdata/'+urlnya;
			frozen[modnya] = [	
				{field:'tp_warta',title:'Tipe Warta',width:200, halign:'center',align:'left'},
			]
			kolom[modnya] = [	
				{field:'nama_komisi',title:'Nama Komisi',width:200, halign:'center',align:'left'},
				{field:'tgl_warta',title:'Tanggal',width:150, halign:'center',align:'center'},
				{field:'judul_warta',title:'Judul',width:300, halign:'center',align:'left'},
			]
		break;
		case "list_pesanan_kasir":
			judulnya = "";
			tingginya = getClientHeight-450;
			urlglobal = host+'backend/getdata/'+modnya;
			fitnya = true;
			pagesizeboy = 50;
			param['id_meja'] = par1;
			kolom[modnya] = [	
				{field:'nama_produk',title:'Nama Produk',width:200, halign:'center',align:'left'},
				{field:'qty',title:'Qty',width:90, halign:'center',align:'right'},
				{field:'total_harga',title:'Total Harga',width:120, halign:'center',align:'right',
					formatter: function(value,row,index){
						if (row.total_harga){
							return NumberFormat(row.total_harga);
						} else {
							return '-';
						}
					}
				},
			];
		break;
		case "list_produk_kasir":
			judulnya = "";
			tingginya = getClientHeight-450;
			urlglobal = host+'backend/getdata/'+modnya;
			fitnya = true;
			pagesizeboy = 50;
			paging = true;
			doble_klik = true;
			kolom[modnya] = [	
				{field:'nama_kategori',title:'Kategori',width:130, halign:'center',align:'left'},
				{field:'nama_produk',title:'Nama Produk',width:240, halign:'center',align:'left'},
				{field:'harga_jual',title:'Harga Satuan',width:150, halign:'center',align:'right',
					formatter: function(value,row,index){
						if (row.harga_jual){
							return NumberFormat(row.harga_jual);
						} else {
							return '-';
						}
					}
				},
			];
		break;	
	}
	
	grid_nya=$("#"+divnya).datagrid({
		title:judulnya,
        height:tingginya,
        width:lebarnya,
		rownumbers:true,
		iconCls:'database',
        fit:fitnya,
        striped:true,
        pagination:true,
        remoteSort: false,
		showFooter:footer,
		singleSelect:singleSelek,
        url: urlglobal,		
		nowrap: nowrap_nya,
		pageSize:pagesizeboy,
		pageList:[10,20,30,40,50,75,100,200],
		queryParams:param,
		frozenColumns:[
            frozen[modnya]
        ],
		columns:[
            kolom[modnya]
        ],
		onLoadSuccess:function(d){
			
		},
		onClickRow:function(rowIndex,rowData){
		 
        },
		onDblClickRow:function(rowIndex,rowData){
			if(doble_klik==true){
				switch(modnya){
					case "list_produk_kasir":
						$.post(host+'trx-penjualan', {'editstatus':'add', 'cl_meja_id':par1, 'tbl_produk_id':rowData.id}, function(resp){
							if(resp == 1){
								$('#grid_list_pesanan_kasir').datagrid('reload');
								$.post(host+'total-pesanan', { 'id_meja':par1 }, function(resp){
									var parsing = $.parseJSON(resp);
									$('#total_qty').val(parsing.tot_qty);
									$('#total_hrg').val(NumberFormat(parsing.tot_harga));
								});
							}else{
								$.messager.alert('Error','Error System','error');
							}
						});
					break;
				}
			}
		},
		toolbar: '#tb_'+modnya,
		rowStyler: function(index,row){
			if(modnya == 'reservasi'){
				if (row.flag == 1){
					return 'background-color:#C5FFC2;'; // return inline style
				}else if(row.flag == 0){
					return 'background-color:#FFD1BB;'; // return inline style
				}
			}
			
		},
		onLoadSuccess: function(data){
			if(data.total == 0){
				var $panel = $(this).datagrid('getPanel');
				var $info = '<div class="info-empty" style="margin-top:20%;">Data Tidak Tersedia</div>';
				$($panel).find(".datagrid-view").append($info);
				//$('#edit').linkbutton({disabled:true});
				//$('#del').linkbutton({disabled:true});
			}else{
				$($panel).find(".datagrid-view").append('');
			}
		},
	});
}


function genform(type, modulnya, submodulnya, stswindow, tabel){
	var urlpost = host+'backend/get_form/'+submodulnya+'/form';
	var urldelete = host+'backend/cruddata/'+submodulnya;
	var id_tambahan = "";
	
	switch(submodulnya){
		case "wartakomisi":
			table = "warkom";
			urlpost = host+'backend/getdisplay/get-form/'+submodulnya;
		break;
		case "kebaktianminggu":
			table = "kebming";
			urlpost = host+'backend/getdisplay/get-form/'+submodulnya;
		break;
		case "renunganwarta":
			table = "renwar";
			urlpost = host+'backend/getdisplay/get-form/'+submodulnya;
		break;
		case "renunganharian":
			table = "rema";
			urlpost = host+'backend/getdisplay/get-form/'+submodulnya;
		break;
		case "artikelrohani":
			table = "artiro";
			urlpost = host+'backend/getdisplay/get-form/'+submodulnya;
		break;
		case "sliderberanda":
			table = "sliben";
			urlpost = host+'backend/getdisplay/get-form/'+submodulnya;
		break;
		case "komisikombas":
			table = "kokom";
			urlpost = host+'backend/getdisplay/get-form/'+submodulnya;
		break;
	}
	
	switch(type){
		case "add":
			if(stswindow == undefined){
				$('#grid_nya_'+submodulnya).hide();
				$('#detil_nya_'+submodulnya).empty().show().addClass("loading");
			}
			$.post(urlpost, {'editstatus':'add', 'ts':table, 'id_tambahan':id_tambahan }, function(resp){
				if(stswindow == 'windowform'){
					windowForm(resp, judulwindow, lebar, tinggi);
				}else if(stswindow == 'windowpanel'){
					windowFormPanel(resp, judulwindow, lebar, tinggi);
				}else{
					$('#detil_nya_'+submodulnya).show();
					$('#detil_nya_'+submodulnya).html(resp).removeClass("loading");
				}
			});
		break;
		case "edit":
		case "delete":
		
			var row = $("#grid_"+submodulnya).datagrid('getSelected');
			if(row){
				if(type=='edit'){
					if(stswindow == undefined){
						$('#grid_nya_'+submodulnya).hide();
						$('#detil_nya_'+submodulnya).show().addClass("loading");	
					}
					$.post(urlpost, { 'editstatus':'edit', id:row.id, 'ts':table, 'submodul':submodulnya, 'bulan':row.bulan, 'tahun':row.tahun, 'id_tambahan':id_tambahan }, function(resp){
						if(stswindow == 'windowform'){
							windowForm(resp, judulwindow, lebar, tinggi);
						}else if(stswindow == 'windowpanel'){
							windowFormPanel(resp, judulwindow, lebar, tinggi);
						}else{
							$('#detil_nya_'+submodulnya).show();
							$('#detil_nya_'+submodulnya).html(resp).removeClass("loading");
						}
					});
				}else if(type=='delete'){
					//if(confirm("Anda Yakin Menghapus Data Ini ?")){
					$.messager.confirm('JResto Soft','Anda Yakin Menghapus Data Ini ?',function(re){
						if(re){
							loadingna();
							$.post(urldelete, {id:row.id, 'sts_crud':'delete'}, function(r){
								if(r==1){
									winLoadingClose();
									$.messager.alert('JResto Soft',"Data Terhapus",'info');
									$('#grid_'+submodulnya).datagrid('reload');								
								}else{
									winLoadingClose();
									console.log(r)
									$.messager.alert('JResto Soft',"Gagal Menghapus Data",'error');
								}
							});	
						}
					});	
					//}
				}
				
			}
			else{
				$.messager.alert('Roger Salon',"Select Row In Grid",'error');
			}
		break;
		
	}
}

function genTab(div, mod, sub_mod, tab_array, div_panel, judul_panel, mod_num, height_panel, height_tab, width_panel, width_tab){
	var id_sub_mod=sub_mod.split("_");
	if(typeof(div_panel)!= "undefined" || div_panel!=""){
		$(div_panel).panel({
			width:(typeof(width_panel) == "undefined" ? getClientWidth()-268 : width_panel),
			height:(typeof(height_panel) == "undefined" ? getClientHeight()-100 : height_panel),
			title:judul_panel,
			//fit:true,
			tools:[{
					iconCls:'icon-cancel',
					handler:function(){
						$('#grid_nya_'+id_sub_mod[1]).show();
						$('#detil_nya_'+id_sub_mod[1]).hide();
						$('#grid_'+id_sub_mod[1]).datagrid('reload');
					}
			}]
		}); 
	}
	
	$(div).tabs({
		title:'AA',
		height: (typeof(height_tab) == "undefined" ? getClientHeight()-190 : height_tab),
		width: (typeof(width_tab) == "undefined" ? getClientWidth()-280 : width_tab),
		plain: false,
		fit:true,
		onSelect: function(title){
				var isi_tab=title.replace(/ /g,"_");
				var par={};
				console.log(isi_tab);
				$('#'+isi_tab.toLowerCase()).html('').addClass('loading');
				urlnya = host+'index.php/content-tab/'+mod+'/'+isi_tab.toLowerCase();
				$(div_panel).panel({title:title});
				
				switch(mod){
					case "kasir":
						var lantainya = title.split(" ");
						var lantainya = lantainya.length-1;
						
						par['posisi_lantai'] = lantainya;
						urlnya = host+'kasir-lantai/';
					break;
					case "pengaturan":
						
					break;
				}
				$.post(urlnya,par,function(r){
					$('#'+isi_tab.toLowerCase()).removeClass('loading').html(r);
				});
		},
		selected:0
	});
	
	if(tab_array.length > 0){
		for(var x in tab_array){
			var isi_tab=tab_array[x].replace(/ /g,"_");
			$(div).tabs('add',{
				title:tab_array[x],
				content:'<div style="padding: 5px;"><div id="'+isi_tab.toLowerCase()+'" style="height: 200px;">'+isi_tab.toLowerCase()+'zzzz</div></div>'
			});
		}
		var tab = $(div).tabs('select',0);
	}
}

function kumpulAction(type, p1, p2, p3, p4, p5){
	var param = {};
	switch(type){
		// FrontEnd Act 
		case "register-1":
			validasi = $('#regsbro').form('validate');
			if(validasi){
				$.blockUI({ message: '<h3>Processing Data...</h3>' });			
			}
			
			submit_form('regsbro',function(r){
				$('#modalencuk').html('');
				$.post(host+'message-submit', { 'stsn':r, 'tp':'registrasi-step1' }, function(pg){
					$('#modalencuk').html(pg);
				});
				
				$('#pesanModal').modal('show');
				$.unblockUI();
				
				if(r == 1){
					setTimeout(function () {
						window.location.href = host; 
					}, 4000);
					$('#regsbro')[0].reset();
				}
			});
			return false;
		break;
		case "register-mobile":
			validasi = $('#regsmobile').form('validate');
			if(validasi){
				$.blockUI({ message: '<h3>Processing Data...</h3>' });			
			}
			
			submit_form('regsmobile',function(r){
				$('#modalencuk').html('');
				$.post(host+'message-submit', { 'stsn':r, 'tp':'registrasi-step1' }, function(pg){
					$('#modalencuk').html(pg);
				});
				
				$('#pesanModal').modal('show');
				$.unblockUI();
				
				if(r == 1){
					setTimeout(function () {
						window.location.href = host; 
					}, 4000);
					$('#regsmobile')[0].reset();
				}
			});
			return false;
		break;		
		case "register-2":
			validasi = $('#regsbro2').form('validate');
			if(validasi){
				$.blockUI({ message: '<h3>Processing Data...</h3>' });			
			}
			submit_form('regsbro2',function(r){
				if(r == 0){
					$('#modalencuk').html('');
					$.post(host+'message-submit', { 'stsn':r, 'tp':'registrasi-step2' }, function(pg){
						$('#modalencuk').html(pg);
					});
					$('#pesanModal').modal('show');
				}else{
					window.location.href = host+"register-step3/"+p1;
				}
				$.unblockUI();
			});
			
			return false;
		break;
		case "register-3":
			validasi = $('#frmForgotPassCode').form('validate');
			if(validasi){
				$.blockUI({ message: '<h3>Processing Data...</h3>' });			
			}
			submit_form('frmForgotPassCode',function(r){
				$('#modalencuk').html('');
				$.post(host+'message-submit', { 'stsn':r, 'tp':'aktivasi' }, function(pg){
					$('#modalencuk').html(pg);
				});
				
				$('#pesanModal').modal('show');
				$.unblockUI();
				
				if(r == 1){
					setTimeout(function () {
						window.location.href = host;
					}, 4000);
				}
			});
			return false;
		break;
		// End FrontEnd Act 
		
		case "form-property":
			switch(p1){
				case "add":
					param['eds'] = 'add';
				break;
				case "edit":
					param['eds'] = 'edit';
					param['ixd'] = p2;
				break;
			}
			
			$.blockUI({ message: waitingmsg });
			setTimeout(function(){
				$("#konten").empty().addClass("loading");
				$.post(host+'propertymanager-form', param, function(rsp){
					var parsing = $.parseJSON(rsp);
					$("#konten").html(parsing.page).removeClass("loading");	
				});
				$.unblockUI();
			}, 1000);
		break;
		case "property-delete":
			//var r = confirm("Are You Sure to Delete This Data?");
			//if (r == true) {
				param['editstatus'] = 'delete';
				param['uui'] = p1;
				
				$.post(host+'delete-property', param, function(rsp){
					if(rsp == 1){
						bootbox.alert("Data Was Deleted");
						loadUrl(host+'propertymanager', 'listing');
					}else{
						alert(rsp);
					}
				});
			//}
		break;
		
		case "processalltotal":
			var uhuy = 0;
			$( ".amount" ).each(function( index ) {
				uhuy = eval(parseInt($(this).val()) + uhuy);
			});
			
			$('#grandtot').val(uhuy);
			$('#tot').html(NumberFormat(uhuy));
		break;
		
		case "trxdetail-package":
			param['ipma'] = p1;
			$.blockUI({ message: waitingmsg });
			setTimeout(function(){			
				$("#table-trx-package").hide();
				$("#breadcrumb").hide();
				$.post(host+'transaction-package-detail', param, function(rsp){
					var parsing = $.parseJSON(rsp);
					$("#detail-trx-package").show();	
					$("#detail-trx-package").html(parsing.page);
				});
				$.unblockUI();
			}, 1000);			
		break;
		
		case "reservationdetail":
			console.log(p1);
			if($('#body_'+p1).html() == ''){
				param['ipres'] = p1;
				$.post(host+'reservation-detail', param, function(rsp){
					var parsing = $.parseJSON(rsp);
					$("#body_"+p1).empty().html(parsing.page);
				});
			}
		break;
		case "reservationkalendar":
			param['ipmax'] = p2;
			param['idrsv'] = p3;
			$('#isi_tab_'+p1).html('');
			$.post(host+'getdetailkalendar', param ,function(rsp){
				var parsing = $.parseJSON(rsp);
				$('#isi_tab_'+p1).html(parsing.page);
			});
		break;
		case "scheduledetail":
			param['idws'] = p1;
			$('#modalencuk').html('');
			$.post(host+'schedule-detail', param ,function(rsp){
				var parsing = $.parseJSON(rsp);
				$('#modalencuk').html(parsing.page);
				$('#pesanModal').modal('show');
			});
		break;
		
		/*
		case "request-services":
			param['uuii'] = p1;
			param['nmii'] = p2;
			param['mii'] = p3;
			
			$.blockUI({ message: waitingmsg });
			setTimeout(function(){
				$("#konten").empty().addClass("loading");
				$.post(host+'request-services-form', param, function(rsp){
					var parsing = $.parseJSON(rsp);
					$("#konten").html(parsing.page).removeClass("loading");	
				});
				$.unblockUI();
			}, 1000);
		break;		
		case "detailservice":
			param['uuii'] = p1;
			param['uuiid'] = p2;
			
			$.blockUI({ message: waitingmsg });
			setTimeout(function(){
				$("#serv").hide();
				$.post(host+'request-detail-services', param, function(rsp){
					var parsing = $.parseJSON(rsp);
					$("#serv2").html(parsing.page).show();	
				});
				$.unblockUI();
			}, 1000);				
		break;
		case "backservices":
			$.blockUI({ message: waitingmsg });
			setTimeout(function(){
				$("#serv").show();
				$("#serv2").hide();
				$.unblockUI();
			}, 1000);				
		break;
		case "processperiod":
			if($('#srv_'+p1).val() == 'H'){
				$('#qty_'+p1).val('');
				$('#qty_'+p1).prop('readonly', false);
			}else if($('#srv_'+p1).val() == 'M'){
				$('#qty_'+p1).val(2);
				$('#qty_'+p1).prop('readonly', true);
			}else if($('#srv_'+p1).val() == 'B'){
				$('#qty_'+p1).val(8);
				$('#qty_'+p1).prop('readonly', true);
			}
			
			kumpulAction('processtotal', p1, p2, p3);
		break;
		case "processtotal":
			q = $('#qty_'+p1).val();
			if(p2 == '6' || p2 == '7' || p2 == '9'){
				mm = $('#mii').val();
				rms = (mm * p3 * q);
 			}else{
				rms = (p3 * q);
			}
			
			$('#amount_'+p1).val(rms);
			$('#am_'+p1).html(NumberFormat(rms));
			$('#qty_'+p1).removeClass('validatebox-invalid');
			
			kumpulAction('processalltotal');
		break;
		case "nextservicespackage":
			param['ipma'] = p1;
			param['ipman'] = $('input[name=pckg]:checked').val();;
			$.blockUI({ message: waitingmsg });
			setTimeout(function(){			
				$("#formdetserv").hide();
				$.post(host+'request-summary-package', param, function(rsp){
					var parsing = $.parseJSON(rsp);
					$("#summaryservices").show();	
					$("#summaryservices").html(parsing.page);
				});
				$.unblockUI();
			}, 1000);
		break;
		case "backservices2":
			$.blockUI({ message: waitingmsg });
			setTimeout(function(){
				$("#formdetserv").show();
				$("#summaryservices").html('');
				$.unblockUI();
			}, 1000);				
		break;
		case "trxdetail":
			param['ipma'] = p1;
			$.blockUI({ message: waitingmsg });
			setTimeout(function(){			
				$("#table-trx").hide();
				$("#breadcrumb").hide();
				$.post(host+'transaction-independent-detail', param, function(rsp){
					var parsing = $.parseJSON(rsp);
					$("#detail-trx").show();	
					$("#detail-trx").html(parsing.page);
				});
				$.unblockUI();
			}, 1000);			
		break;

		*/
		
		// ModServ
		case "servicerequest":
			$.blockUI({ message: waitingmsg });
			setTimeout(function(){
				$("#konten").empty().addClass("loading");
				$.post(host+'request-services-form', param, function(rsp){
					var parsing = $.parseJSON(rsp);
					$("#konten").html(parsing.page).removeClass("loading");	
				});
				$.unblockUI();
				$(".main-panel").perfectScrollbar('update');
			}, 1000);
		break;		
		case "detailrequestservice":
			param['uuii'] = p1;
			$.blockUI({ message: waitingmsg });
			setTimeout(function(){
				$("#serv").hide();
				$.post(host+'request-detail-services', param, function(rsp){
					var parsing = $.parseJSON(rsp);
					$("#serv2").html(parsing.page).show();	
					
					$('#service1').hide();
					if(p2 == 'prepaid'){
						$('#service2').show();
						$('#service2-pckg').hide();
					}else if(p2 == 'package'){
						$('#service2-pckg').show();
						$('#service2').hide();
					}
					$('#service3').hide();
				});
				$.unblockUI();
				$(".main-panel").perfectScrollbar('update');
			}, 1000);				
		break;		
		case "detaillayanan":
			param['ipma'] = p1;
			param['lstma'] = p2;
			param['flg'] = p3;
			
			$.blockUI({ message: waitingmsg });
			setTimeout(function(){
				$("#konten").empty().addClass("loading");
				$.post(host+'detaillayananaktif', param, function(rsp){
					var parsing = $.parseJSON(rsp);
					$("#konten").html(parsing.page).removeClass("loading");	
				});
				$.unblockUI();
				$(".main-panel").perfectScrollbar('update');
			}, 1000);
		break;
		case "nextservices":
			if($('#iplistunit').val() == ""){
				$('#modalencuk').html('');
				$('#modalencuk').html('Choose Your Unit For Request Service First!');				
				$('#pesanModal').modal('show');
				
				return false;
			}
			
			var array_serv = new Array();
			var array_listing = new Array();
			var sts_listing = false;
			
			$( ".pricing" ).each(function( index ) {
				if($(this).is(':checked')){
					array_serv.push($(this).attr('data'));
				}
			});
			
			$( ".listingmgm" ).each(function( index ) {
				if($(this).is(':checked')){
					sts_listing = true;
					array_listing.push($(this).attr('data'));
				}
			});
			
			param['arrsrv'] = array_serv;
			param['stslt'] = sts_listing;
			param['arrlist'] = array_listing;
			
			$.blockUI({ message: waitingmsg });
			setTimeout(function(){			
				$("#formdetserv").hide();
				$.post(host+'request-summary-services', param, function(rsp){
					var parsing = $.parseJSON(rsp);
					$("#summaryservices").show();	
					$("#summaryservices").html(parsing.page);
					
					$('#service1').hide();
					$('#service2').hide();
					$('#service2-pckg').hide();
					$('#service3').show();
					
					$('#iplistunit').prop('disabled', true);
				});
				$.unblockUI();
				$(".main-panel").perfectScrollbar('update');
			}, 1000);				
		break;		
		case "backservices":
			$.blockUI({ message: waitingmsg });
			setTimeout(function(){
				$("#serv").show();
				$("#serv2").hide();
				
				$('#service1').show();
				$('#service2').hide();
				$('#service3').hide();
				$.unblockUI();
				
				$(".main-panel").perfectScrollbar('update');
			}, 1000);				
		break;	
		case "nextservicespackage":
			if($('#iplistunit').val() == ""){
				$('#modalencuk').html('');
				$('#modalencuk').html('Choose Your Unit For Request Service First!');				
				$('#pesanModal').modal('show');
				
				return false;
			}		
		
			param['ipma'] = p1;
			param['ipman'] = $('input[name=pckg]:checked').val();;
			$.blockUI({ message: waitingmsg });
			setTimeout(function(){			
				$("#formdetserv").hide();
				$.post(host+'request-summary-package', param, function(rsp){
					var parsing = $.parseJSON(rsp);
					$("#summaryservices").show();	
					$("#summaryservices").html(parsing.page);
					
					$('#service1').hide();
					$('#service2').hide();
					$('#service2-pckg').hide();
					$('#service3').show();
					
					$('#iplistunit').prop('disabled', true);
				});
				$.unblockUI();
				$(".main-panel").perfectScrollbar('update');
			}, 1000);
		break;
		
		case "submitservices":
			validasi = $('#regsrv').form('validate');
			if(validasi){
				$.blockUI({ message: '<h3>Processing Data...</h3>' });			
			}
			
			submit_form('regserv', function(r){
				$("#konten").html('').html(r);
				$.unblockUI();
				$(".main-panel").perfectScrollbar('update');
			});
			return false;
		break;
		
		case "processperiod":
			if($('#srv_'+p1).val() == 'H'){
				$('#qty_'+p1).val('');
				$('#qty_'+p1).prop('readonly', false);
			}else if($('#srv_'+p1).val() == 'M'){
				$('#qty_'+p1).val(2);
				$('#qty_'+p1).prop('readonly', true);
			}else if($('#srv_'+p1).val() == 'B'){
				$('#qty_'+p1).val(8);
				$('#qty_'+p1).prop('readonly', true);
			}
			
			kumpulAction('processtotal', p1, p2, p3);
		break;
		case "processtotal":
			q = $('#qty_'+p1).val();
			if(p2 == '6' || p2 == '7' || p2 == '9'){
				mm = $('#mii').val();
				rms = (mm * p3 * q);
 			}else{
				rms = (p3 * q);
			}
			
			$('#amount_'+p1).val(rms);
			$('#am_'+p1).html(NumberFormat(rms));
			$('#qty_'+p1).removeClass('validatebox-invalid');
			
			kumpulAction('processalltotal');
		break;
		// End ModServ
		
		//Mod Billing 
		case "trxdetail":
			param['ipma'] = p1;
			$.blockUI({ message: waitingmsg });
			setTimeout(function(){			
				$("#table-trx").html('');
				$.post(host+'billing-detail', param, function(rsp){
					var parsing = $.parseJSON(rsp);
					$("#table-trx").html(parsing.page);
				});
				$.unblockUI();
				$(".main-panel").perfectScrollbar('update');
			}, 1000);			
		break;
		//EndMod Billing 
	}
}	

function submit_form(frm,func){
	var url = jQuery('#'+frm).attr("url");
    jQuery('#'+frm).form('submit',{
        url:url,
        onSubmit: function(){
              return $(this).form('validate');
        },
        success:function(data){
			//$.unblockUI();
            if (func == undefined ){
                 if (data == "1"){
                    pesan('Data Sudah Disimpan ','Sukses');
                }else{
                     pesan(data,'Result');
                }
            }else{
                func(data);
            }
        },
        error:function(data){
			//$.unblockUI();
             if (func == undefined ){
                 pesan(data,'Error');
            }else{
                func(data);
            }
        }
    });
}

function fillCombo(url, SelID, value, value2, value3, value4){
	//if(Ext.get(SelID).innerHTML == "") return false;
	if (value == undefined) value = "";
	if (value2 == undefined) value2 = "";
	if (value3 == undefined) value3 = "";
	if (value4 == undefined) value4 = "";
	
	$('#'+SelID).empty();
	$.post(url, {"v": value, "v2": value2, "v3": value3, "v4": value4},function(data){
		$('#'+SelID).append(data);
	});

}

function formatDate(date) {
	var y = date.getFullYear();
    var m = date.getMonth()+1;
    var d = date.getDate();
    return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
}
function parserDate(s){
	if (!s) return new Date();
    var ss = s.split('-');
    var y = parseInt(ss[0],10);
    var m = parseInt(ss[1],10);
    var d = parseInt(ss[2],10);
    if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
        return new Date(y,m-1,d)
    } else {
        return new Date();
    }
}


function clear_form(id){
	$('#'+id).find("input[type=text], textarea,select").val("");
	//$('.angka').numberbox('setValue',0);
}

var divcontainerz;
function windowLoading(html,judul,width,height){
    divcontainerz = "win"+Math.floor(Math.random()*9999);
    $("<div id="+divcontainerz+"></div>").appendTo("body");
    divcontainerz = "#"+divcontainerz;
    $(divcontainerz).html(html);
    $(divcontainerz).css('padding','5px');
    $(divcontainerz).window({
       title:judul,
       width:width,
       height:height,
       autoOpen:false,
       modal:true,
       maximizable:false,
       resizable:false,
       minimizable:false,
       closable:false,
       collapsible:false,  
    });
    $(divcontainerz).window('open');        
}
function winLoadingClose(){
    $(divcontainerz).window('close');
    //$(divcontainer).html('');
}
function loadingna(){
	windowLoading("<img src='"+host+"__assets/img/loading.gif' style='position: fixed;top: 50%;left: 50%;margin-top: -10px;margin-left: -25px;'/>","Please Wait",200,100);
}

function NumberFormat(value) {
	
    var jml= new String(value);
    if(jml=="null" || jml=="NaN") jml ="0";
    jml1 = jml.split("."); 
    jml2 = jml1[0];
    amount = jml2.split("").reverse();

    var output = "";
    for ( var i = 0; i <= amount.length-1; i++ ){
        output = amount[i] + output;
        if ((i+1) % 3 == 0 && (amount.length-1) !== i)output = '.' + output;
    }
    
	//if(jml1[1]===undefined) jml1[1] ="00";
    // if(isNaN(output))  output = "0";
    return output; // + "." + jml1[1];
}

function showErrorAlert (reason, detail) {
		var msg='';
		if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
		else {
			console.log("error uploading file", reason, detail);
		}
		$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
		 '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
	}
function konversi_pwd_text(id){
	if($('input#'+id)[0].type=="password")$('input#'+id)[0].type = 'text';
	else $('input#'+id)[0].type = 'password';
}
function gen_editor(id){
	tinymce.init({
		  selector: id,
		  height: 200,
		  plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table contextmenu paste jbimages"
		    ],
			
		  // ===========================================
		  // PUT PLUGIN'S BUTTON on the toolbar
		  // ===========================================
		  menubar: true,
		  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ",
			
		  // ===========================================
		  // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
		  // ===========================================
			
		  relative_urls: false
		});
		
		tinyMCE.execCommand('mceRemoveControl', true, id);
		tinyMCE.execCommand('mceAddControl', true, id);
	
}


function gen_kalender(id_div,height,modulbro,data_kalender){
	$('#'+id_div).fullCalendar({
		height: height,
        header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month'
		},
		defaultDate: today,
		navLinks: true, // can click day/week names to navigate views
		selectable: true,
		selectHelper: true,
		editable: true,
		eventLimit: true, // allow "more" link when too many events
		events: data_kalender,
		eventClick: function(calEvent, jsEvent, view) {
			kumpulAction('scheduledetail', calEvent.idsw);
		},
		dayRender: function (date, cell) {
			if(modulbro == 'kalender_setting'){
				cell.append('<font color="#D2CFCF" style="font-size:12px !important;">Rp. 50.000</font>');
			}
		}
    });
}

