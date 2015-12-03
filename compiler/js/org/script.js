/*
* Compile WP 1.0
* Script-Core File 
* version: 1.0
*/
window.ajaxURL = '/wp-admin/admin-ajax.php';
(function($){
	$(document).ready(function(){ 
		var _tab = {
			/*
			**FTP TESTING CONNECT AJAX QUERY
			*/
			testFtp: function(){
				$(".test_ftp a").on("click", function(e){	
					e.preventDefault();

					var step_field={};
					step_field={							
							'ftp_hostname' 		: $(".ftp_row #ftp_hostname").val(),
							'ftp_username' 		: $(".ftp_row #ftp_username").val(),
							'ftp_password' 		: $(".ftp_row #ftp_password").val(),
							'mysql_host' 		: $(".sql_row #mysql_host").val(),
							'mysql_database' 	: $(".sql_row #mysql_database").val(),
							'mysql_username' 	: $(".sql_row #mysql_username").val(),
							'mysql_password' 	: $(".sql_row #mysql_password").val()
						}
					var err=[];
					$.each(step_field, function(key, value){
						if(!value){
							$("#"+key).css("background", "rgba(255,0,0,0.2)");
							err.push(key);							
						}else{
							if(key=="type")
									$("#"+key).css("background", "#FFF");
								else
									$("#"+key).css("background", "#F2F2F2");
						}
					});
					
					if(err.length==0){
						$("body").waiting({ fixed: true });
						$.ajax({
							type:"POST",
			  				url: ajaxURL,
						  	data: {
							    action: "validate_servers",
							    testing_connect: "test",
							    server_data: step_field
							},
							success:function(json){
							  	var response=$.parseJSON(json);
							  	if(response.ftp==true){
							  		$("#connectionResult").html("<span class='connected'>"+response.ftp_message+"</span>");
							  	}else{
							  		$("#connectionResult").html("<span class='fail_connect'>"+response.ftp_message+"</span>");
							  	}
							  	if(response.db==true){
							  		$("#connectionResult").append("<span class='connected db_status'>"+response.db_message+"</span>");
							  	}else if(response.db=="wrong"){
							  		$("#connectionResult").append("<span class='fail_connect db_status'>"+response.db_message+"</span>");
							  	}
							  	else{
							  		$("#connectionResult").append("<span class='warning_connect db_status'>"+response.db_message+"</span>");
							  	}
								$(".waiting-container.overlay.fixed").remove();
								$("body").removeClass("waiting");
							},
							error: function(){
								$(".waiting-container.overlay.fixed").remove();
								$("body").removeClass("waiting");
							}							
						});
					}
										
				});
			},
			/*
			**NEXT STEP CLICK FUNCTION
			*/
			nextStep: function(iden){
						
					var step_field={};
					/*FIRST STEP*/					
					if($("#tabsTemp div:nth-child(2)").hasClass("active")){
						step_field={
							'type' 				: $(".type_app:checked").val(),
							'site_url'			: $(".ftp_row #site_url").val(),
							'ftp_hostname' 		: $(".ftp_row #ftp_hostname").val(),
							'ftp_username' 		: $(".ftp_row #ftp_username").val(),
							'ftp_password' 		: $(".ftp_row #ftp_password").val(),
							'mysql_host' 		: $(".sql_row #mysql_host").val(),
							'mysql_database' 	: $(".sql_row #mysql_database").val(),
							'mysql_username' 	: $(".sql_row #mysql_username").val(),
							'mysql_password' 	: $(".sql_row #mysql_password").val(),
							"step"				: "1"
						}						
					}
					/*SECOND STEP*/
					if($("#tabsTemp div:nth-child(3)").hasClass("active")){
						step_field={
							"site_name" 		: $("#site_name").val(),
							"site_tagline"		: $("#site_tagline").val(),
							"site_email"		: $("#site_email").val(),
							"site_meta_desc"	: $("#site_meta_desc").val(),
							"admin_name"		: $("#admin_name").val(),
							"admin_password"	: $("#admin_password").val(),
							"admin_nickname"	: $("#admin_nickname").val(),
							"step"				: "2"
						}
					}
					/*THIRD STEP*/
					if($("#tabsTemp div:nth-child(4)").hasClass("active")){
						step_field={
							"facebook" 			: $("#facebook").val(),
							"twitter"			: $("#twitter").val(),
							"linkedin"			: $("#linkedin").val(),
							"google"			: $("#google").val(),
							"youtube"			: $("#youtube").val(),							
							"step"				: "3"
						}

					}
					/*FOUR STEP*/
					if($("#tabsTemp div:nth-child(5)").hasClass("active")){
						step_field={
							"company_name" 		: $("#company_name").val(),
							"street"			: $("#street").val(),
							"city"				: $("#city").val(),
							"state"				: $("#state").val(),
							"zip"				: $("#zip").val(),
							"phone"				: $("#phone").val(),				
							"step"				: "4"
						}
					}
					

					/*ERROR VALIDATOR FRONT-END PATERN*/					
					var err=[];
					if(step_field.step!=3 && step_field.step!=4){
						$.each(step_field, function(key, value){
							if(!value){
								if(key!=='site_meta_desc'){
									$("#"+key).css("background", "rgba(255,0,0,0.2)");
									err.push(key);
								}							
							}else{
								if(key=="type")
									$("#"+key).css("background", "#FFF");
								else
									$("#"+key).css("background", "#F2F2F2");
							}
						});
					}
					/*SENDIND DATA TO BACK-END ERROR VALIDATOR PATERN*/						
					if(err.length==0){
						$("body").waiting({ fixed: true });
						$("#connectionResult").html('');
						$.ajax({
							type:"POST",
			  				url: ajaxURL,
						  	data: {
							    action: "validate_servers",							   
							    server_data: step_field
							},
							success:function(json){
							  	var response=$.parseJSON(json);
							  	var err=[];
							  	var ftperr=[];
							  	$.each(response, function(index, val){
							  		if(index=="ftp" && val!="ok" || index=="db_connect" && val!="ok"){							  			
							  			ftperr.push(index);
							  			$("#connectionResult").append("<span class='warning_connect db_status'>"+val+"</span><br>");
							  			
							  		}
							  		if(val==false || val=="false"){
							  			$("#"+index).css("background", "rgba(255,0,0,0.2)");
							  			err.push(index);
							  		}else{
							  			if(index=="type")
											$("#"+index).css("background", "#FFF");
										else
											$("#"+index).css("background", "#F2F2F2");
							  		}
							  		$(".waiting-container.overlay.fixed").remove();
									$("body").removeClass("waiting");
							  	});
							  	if(err.length==0 && ftperr.length==0){							  		
							  		$(".w-tabs-list").find(".w-tabs-item.active").next().click();
							  		$('html, body').animate({
								        scrollTop: $("#tabsTemp").offset().top
								    }, 1000);
							  	}else if(err.length==0){
							  		$(".i_confirm").css("display", "inline-block");
							  		$(".i_confirm").prev().find('a').html("<span>Try Again</span>");
							  	}
							  	$(".w-tabs .w-tabs-section.active input").on("click", function(){
							  		$(".i_confirm").hide();
							  	})
							  	$(".i_confirm").on("click", function(e){
							  		e.preventDefault();
							  		$(this).hide();	
							  		$(this).prev().find('a').html("<span>Next</span>");
							  		$(".w-tabs-list").find(".w-tabs-item.active").next().click();
							  		$('html, body').animate({
								        scrollTop: $("#tabsTemp").offset().top
								    }, 1000);
							  								  	
							  	});
							},
							error: function(){
								$(".waiting-container.overlay.fixed").remove();
								$("body").removeClass("waiting");
								$("#connectionResult").append("<span class='warning_connect db_status'>We couldn't connect to your server! Please confirm entered data or enter another!</span><br>");
								$(".i_confirm").show();
							  	$(".i_confirm").prev().find('a').html("<span>Try Again</span>");
							  	$(".i_confirm").on("click", function(e){
							  		e.preventDefault();
							  		$(this).hide();
							  		$(this).prev().find('a').html("<span>Next</span>");
							  		$(".w-tabs-list").find(".w-tabs-item.active").next().click();							  		
							  	});
							}								
						});
						
					}
				
			},
			/*
			**BACKSTEP
			*/
			prevStep: function(){
				$(".prev_step a").on("click", function(e){
					e.preventDefault();
					$('html, body').animate({
								        scrollTop: $("#tabsTemp").offset().top
								    }, 1000);
					$(".w-tabs-list").find(".w-tabs-item.active").prev().click();
				});
			},
			/*
			**CREATING COMPILE QUERY (FIVE STEP)
			*/
			final_tab_conf:function(){
				$(".download_button a").click(function(e){
					e.preventDefault();
					if($("#confirm").prop("checked")){
					$("body").waiting({ fixed: true });
						$.ajax({
							type:"POST",
			  				url: ajaxURL,
						  	data: {
							    action: "getMyCompile",							   
							    confirm: $("#confirm").prop("checked")
							},
							success:function(link){
								$(".waiting-container.overlay.fixed").remove();
								$("body").removeClass("waiting");
								window.location.href = link;
							}
						});
					}
				});
			},
			/*FTP PATH FIELD SHOW*/
			ftp_path:function(){
				$(".install_button a ").click(function(e){
					e.preventDefault();
					if($("#confirm").prop("checked")){
						$("#ftp_folder").show();
						$('.loadToFTP').show();
						$(this).hide();
					}else{
						$("#confirm").parent().css("border-bottom", "2px rgba(255,0,0,0.2) solid");
					}
				});
			},
			/*
			**FTP PATH FIELD VALIDATION / SEND AJAX QUERY
			*/
			loadToFTP:function(){
				$(".loadToFTP a").click(function(e){
					e.preventDefault();
					path=$("#ftp_folder").val();
					if(path==''){
						$("#ftp_folder").css("background", "rgba(255,0,0,0.2)");
						$("#ftp_folder").val('/');
					}else{
						$("body").waiting({ fixed: true });
						$.ajax({
							type:"POST",
			  				url: ajaxURL,
						  	data: {
							    action: "getMyCompile",							   
							    confirm: $("#confirm").prop("checked"),
							    ftpLoad: "load",
							    ftpFolder: path
							},
							success:function(json){
								var response=$.parseJSON(json);
								$.ajax({
									type: "POST",
									url: ajaxURL,
									data: {
										action: "unzipFTP",		
										unzip:	response.unzip,
										dump:   response.dump	
									},
									success:function(json){
			            			    $(".waiting-container.overlay.fixed").remove();
										$("body").removeClass("waiting");										
										$(".loadToFTP a").parent().parent().append("<span class='connected'>Wordpress successfully install to <a href='"+response.link+"'>Your server </a></span>");

									}
								});
		            		}
			            });				            	
							
					}
				});
				
			},
			/*
			**GENERATE PASSWORD
			*/
			generatePassword:function(){
				$(".generate_password a").click(function(e){
					e.preventDefault();
					var result       = '';
					var words        = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
					var max_position = words.length - 1;
						for( i = 0; i < 10; ++i ) {
							position = Math.floor ( Math.random() * max_position );
							result = result + words.substring(position, position + 1);
						}
					$("#admin_password").val(result);
					$("#admin_password").attr("type", "text");
				})
			},
			fiveStepFtp:function(){				
				$(".next_step a").click(function(e){					
					e.preventDefault();
					if($("#tabsTemp div:nth-child(5)").hasClass("active")){
													
							$.ajax({
								type:"POST",
				  				url: ajaxURL,
							  	data: {
								    action: "confirmFTP",							   
								    confirmFTP: "confirmFTP"
								},
								success:function(data){
										
									var response=$.parseJSON(data);
									console.log('response.ftp ' , response);
									if(response=="ok"){	
																
										$(".install_button").show();	
									}
									if(response=="fail"){	
																			
										$(".install_button").hide();
									}

								}
							})

						setTimeout(function(){_tab.nextStep()},500)
					}else{
						_tab.nextStep();						
					}
				})
				$(".w-tabs-list .w-tabs-item").click(function(){
					// if($("#tabsTemp div:nth-child(6)").hasClass("active")){
					// 	$.ajax({
					// 		type:"POST",
			  // 				url: ajaxURL,
					// 	  	data: {
					// 		    action: "confirmFTP",							   
					// 		    confirmFTP: "confirmFTP"
					// 		},
					// 		success:function(data){
					// 			var response=$.parseJSON(data);
					// 			if(response.ftp!="ok"){									
					// 				$(".install_button").hide();	
					// 			}else{
									
					// 				$(".install_button").show();
					// 			}
					// 		}
					// 	})
					// }
				});

			},
			/*
			**INIT FUNCTION
			*/
			init:function(){
				_tab.testFtp();
				// _tab.nextStep();
				_tab.prevStep();
				_tab.final_tab_conf();
				_tab.ftp_path();
				_tab.generatePassword();
				_tab.loadToFTP();
				_tab.fiveStepFtp();
			}
		}
	
	_tab.init();
	});

})(jQuery)
