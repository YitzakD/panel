/**
 * Copyright: DEV-AFRIKA
 * Code by Yitzak DEKPEMOU
 */

$(document).ready(function() {

	/**
	 *  Dossier qui contient les fichiers ajax
	 */
	ajaxlink = "http://panel.devafrika.com/ressources/ajax/";


	/** 
	*	Loader
	*	Initialisation du loader
	*/
	pspinner = $("#p-spinner");
	pspinner.hide();


	/** 
	*	Scrolling
	*	Modification du style de la barre de défilement
	*/
	$("body").niceScroll({styler:"fb", cursorcolor:"#6c757d", cursorborder:"#6c757d", zindex:"700", cursorborderradius:"25px"});
	$('.p-bank-inner-transactions').niceScroll({cursorcolor:"#EBEDF2"});

	
	/** 
	*	Automatisation du système d'alertes
	*	Faire disparaitre l'alert automatiquement après 10s
	*/
	p_alert = $("#js-p-alert");
	p_alert.alert().delay(6500).fadeOut(500);


	/** 
	*	Date
	*	Faire apparaître automatiquement le widget pour choisir une date.
	*/
	var datepickers = $(".affdate").datepicker({
        
        dateFormat : 'yy-mm-dd',
        
        minDate : 0,

        onSelect : function(date) {

            var option = this.id == 'debut' ? 'minDate' : 'maxDate';

            datepickers.not('#'+this.id).datepicker('option',option,date);

        }
        
    });
	

	/** 
	*	Tooltip
	*	Faire apparaître automatiquement un message sur le titre.
	*/
  	$('[data-toggle="tooltip"]').tooltip();



	/** 
	*	Action sur les sidebars
	*	Menu principal
	*	Faire aggrandir ou diminuer le menu au clique
	*/
	pmenubutton = $(".p-menu-button");

	psidebarmenubutton = $("#p-show-sidebar-menu-toggle");
	
		phidemenusidebarbutton = $("#p-hide-menu-sidebar-toggle");

	psidebarsettingsbutton = $("#p-show-sidebar-settings-toggle");
		
		phidesettingsidebarbutton = $("#p-hide-settings-sidebar-toggle");

	psidebarnotebookbutton = $("#p-show-sidebar-notebook-toggle");

	psidebartasksbutton = $("#p-show-sidebar-tasks-toggle");

	poverlay = $(".p-orverlay");


	pmenubutton.click(function() {

		pmenu = $("#p-menu");
		
		pcontent = $("#p-content");

		if(pmenu.hasClass("p-menu-minimize")) {

  			pmenu.removeClass("p-menu-minimize").animate();

  			pcontent.removeClass("p-content-maximize").animate();

			$.post(ajaxlink + 'main/menubar/menu-toggle-max.ajax.php', function(datamenumaxnplus) {

				$('#p-switch-menu').attr("value", datamenumaxnplus);

				$('#p-switch-menu').removeAttr("checked");

			});

		} else {

	  		pmenu.addClass("p-menu-minimize").animate();

  			pcontent.addClass("p-content-maximize").animate();

			$.post(ajaxlink + 'main/menubar/menu-toggle-min.ajax.php', function(datamenuminplus) {

				$('#p-switch-menu').attr("value", datamenuminplus);

				$('#p-switch-menu').attr("checked", "");

			});

		}

	});


	/** 
	*	Session
	*	Memoriseou efface la session de l'utilisateur
	*/
	$('#p-switch-session').click(function() {

		$.post(ajaxlink + 'main/session/session-state.ajax.php', function(datasession) {

			d = new Date();

			d.setTime(d.getTime() + (((24*60)*60)*1000)*365);

			expires = "expires=" + d.toGMTString();

			if(datasession) {

				$('.setres').html(datasession).hide();

				document.cookie = "auth=" + datasession + "; " + expires + "; path=/";

			}

		});

	});


	/** 
	*	Menu principal
	*	Faire aggrandire ou diminuer le menu au clique
	*/
	$('#p-switch-menu').click(function() {

		pmenubutton.click();

	});


	/** 
	*	Style
	*	Basculer entre le mode claire et le mode nuit
	*/
	$('#p-switch-style').click(function() {

		$.post(ajaxlink + 'main/menubar/style-toggle.ajax.php', function(datastyle) {

			if(datastyle) {

				$("link#p-css-switch").attr("href", datastyle);

			}

		});

	});


	/** 
	*	Menu flottant
	*	Faire apparaître ou disparaître la sidebar au clique
	*/
	psidebarmenubutton.click(function(e) {

		e.preventDefault();

		pshowmenucontenor = $("#p-show-menu");

		poverlay.css("display", "block").animate();

		pshowmenucontenor.addClass("p-show-sidebar").animate();

	});

	psidebarsettingsbutton.click(function(e) {

		e.preventDefault();

		pshowsettingscontenor = $("#p-show-settings");

		poverlay.css("display", "block").animate();

		pshowsettingscontenor.addClass("p-show-sidebar").animate();

	});

	psidebarnotebookbutton.click(function(e) {

		e.preventDefault();

		pshownotebookcontenor = $("#p-show-notebook");

		pshownotebookcontenor.addClass("p-show-left-sidebar").animate();

	});

	psidebartasksbutton.click(function(e) {

		e.preventDefault();

		pshowtaskscontenor = $("#p-show-tasks");

		pshowtaskscontenor.addClass("p-show-left-sidebar").animate();

	});

	phidemenusidebarbutton.click(function(e) {

		e.preventDefault();

		pshowmenucontenor = $("#p-show-menu");

		pshowmenucontenor.removeClass("p-show-sidebar").animate();

		poverlay.css("display", "none").animate();

	});

	phidesettingsidebarbutton.click(function(e) {

		e.preventDefault();

		pshowsettingscontenor = $("#p-show-settings");

		pshowsettingscontenor.removeClass("p-show-sidebar").animate();

		poverlay.css("display", "none").animate();

	});

	poverlay.click(function() {

		pshowmenucontenor = $("#p-show-menu");

		pshowsettingscontenor = $("#p-show-settings");

		pshowmenucontenor.removeClass("p-show-sidebar").animate();

		pshowsettingscontenor.removeClass("p-show-sidebar").animate();

		poverlay.css("display", "none").animate();

	});
	

	/** 
	*	Activities / Notifications
	*	Charge en continue les activités et des notifications.
	*/
	function loadfeeds() {

        pnotifbadge = $("#badge");

        	pnotifbadge.hide();


		pnavnotifbox = $(".p-notification-inner");
		
		pnavnotifbox.niceScroll({cursorcolor:"#EBEDF2"});


        feedbox = $("#p-side-timeline");
    	
    	feedbox.niceScroll({cursorcolor:"#EBEDF2"});


        $.get(ajaxlink + 'main/navbar/nav-badge.ajax.php', function(notifcounter) {

        	if(notifcounter > 0) { pnotifbadge.html(notifcounter).show(); }

        });

        $.get(ajaxlink + 'main/navbar/nav-notifications.ajax.php', function(notifies) {

            pnavnotifbox.html(notifies);

        });

        $.get(ajaxlink + 'main/navbar/side-activities.ajax.php', function(activities) {

            feedbox.html(activities);

        });

    }

    setInterval(loadfeeds,30000);

    loadfeeds();


    /** 
	*	Chargement
	*	Execute unefonction donnée après le delais
	*/
    function simuload(loadcontenor, loadtimer, loadfunc) { 

		loading = '<div class="d-flex align-items-center h-100 w-100 text-center" style="z-index:3000">'+
					  '<div class="d-flex flex-column w-100 p-4">'+
						  '<h2 class="text-center pt-4">'+
						  		'<i class="fas fa-spinner fa-pulse"></i>'+
						  '</h2>'+
						  '<div class="d-block text-muted text-center pb-4">'+
						  		'chargement en cours'+
						  '</div>'+
					  '</div>'+
				  '</div>';

		loadcontenor.html(loading);
		
		setTimeout(loadfunc, loadtimer);
	
	}


    /** 
	*	Chat
	*	Faire apparaître ou disparaître la messagerie au clique
	*/
	unreaderbadge = $("#p-global-chatcounter");

	$(".p-chatbox-icon").click(function(e) {

		e.preventDefault();

		if($(this).hasClass("p-cb")) {

    		pchatbox.addClass("p-show-chatbox").animate().remove();

			$(this).removeClass("p-cb");

    		$(this).html('<i class="far fa-comment-alt"></i>');

			loadunreadchat();

		} else {

			pchatbox = $('<div/>').attr('class', 'p-chatbox').attr('id', 'p-chatbox');

			$(this).addClass("p-cb");

    		$(this).html('<i class="far fa-window-close"></i>');

			pchatbox.appendTo($(this).parent()).insertBefore($(this)).animate();

			setInterval(loadchatuser,180000);

			loadchatuser();

			stopgetunreadmsg();

		}

	});

	t = setInterval(loadunreadchat,400);

	function loadunreadchat() {

		$.post(ajaxlink + 'main/chat/chat-unread.ajax.php', function(getallunreadmsg) {
			
			unreaderbadge.text(getallunreadmsg);

		});

	}

	loadunreadchat();

	function stopgetunreadmsg() {

		unreaderbadge.text("");

		clearInterval(t);

	}
	
	function loadchatuser() {

		$.post(ajaxlink + 'main/chat/users-list.ajax.php', function(getallusers) {

			pchatbox.html(getallusers);

			innerchatbox = $(pchatbox).find("div#cbic");

			innerchatbox.niceScroll({cursorcolor:"#EBEDF2", cursorborder:"none"});

			chatboxuser = $(innerchatbox).find("a#chatboxuser");

			chatboxuser.click(function(e) {

				e.preventDefault();

				reciever = $(this).attr("accesskey");

				$.post(ajaxlink + 'main/chat/user-chat.ajax.php', {reciever:reciever}, function(getUserChat) {	

					pchatbox.html(getUserChat);
	
					function getUserchatMsg() {

						chatloader = $(pchatbox).find("div.chat-loader");
	
						chatloader.niceScroll({cursorcolor:"#EBEDF2", cursorborder:"none"});

						$.post(ajaxlink + 'main/chat/user-chat-msgs.ajax.php', {reciever:reciever}, function(getUserChatData) {

							chatloader.html(getUserChatData);

							chatloader.scrollTop = chatloader.scrollHeight;

							chatmsg = $(chatloader).find("div#chat-message");

							chatmsg.click(function() {

								msgtime = $(this).find("div#chatbox-mt");

								msgtime.show().delay(10000).fadeOut();

							});

						});
						
					}

					setInterval(getUserchatMsg,3000);

					getUserchatMsg();


					chatboxcloser = $(pchatbox).find("span#cbcloser");


					chatboxcloser.click(function(e) {

						e.preventDefault();

						loadchatuser();

					});


					elasticarea = $(pchatbox).find("textarea#elasticarea");

				  	elasticarea.elastic().css("height","5.3rem");

				  	jQuery(elasticarea).trigger('update');

					chathash = $(pchatbox).find('input#chathash').val();


					senderbox = $(pchatbox).find("textarea.chatbox-entry");

					function chatsender() {

						senderbox.keyup(function(e) {

							getUserchatMsg();

							msg = senderbox.val();
							
							msg = $.trim(msg);

							if(e.keyCode === 13 && e.shiftKey === false && msg !== "") {

								$.post(ajaxlink + 'main/chat/chat-sender.ajax.php',{msg:msg,chathash:chathash},function(chatsenderdata) {

									elasticarea.val("");

									loadunreadchat();

									getUserchatMsg();

								});

							}

						});

					}

					chatsender();

				});

			});
				
		});

	}


	/** 
	*	Carnet d'adresse
	*	Charge en continue les contacts du carnet d'adresse.
	*/
	pshowaddresscontenor = $("#p-show-address");

	pshownotebookcontenor = $("#p-show-notebook");

	function loadcontacts() {

        $.get(ajaxlink + 'main/contact/side-addressbook.ajax.php', function(notebook) {

            pshownotebookcontenor.html(notebook);

			addressbook = $(pshownotebookcontenor).find("#p-addressbook");

			addressbook.niceScroll({cursorcolor:"#EBEDF2", cursorborder:"none",});

            psidebaraddressbutton = $(addressbook).find("a#p-show-address-item-toggle");

            /**	Affiche le sidebar de contact */
			psidebaraddressbutton.click(function(e) {

				e.preventDefault();

				dataitem = $(this).attr("accesskey");

				if(dataitem !== "") {

					simuload(pshownotebookcontenor, 1000, loadcontact);

					function loadcontact() {
					
						$.post(ajaxlink + 'main/contact/side-address.ajax.php', {dataitem:dataitem}, function(dataddress) {

							pshownotebookcontenor.html(dataddress);

							newaddcontenor = $(pshownotebookcontenor).find("#new-add");

							tagsbox = $(pshownotebookcontenor).find(".address-tags-box");

							function loadtags() {

								$.post(ajaxlink + 'main/contact/side-address-tags.ajax.php', {dataitem:dataitem}, function(getTags) {

									tagsbox.html(getTags);

									tagself = $(tagsbox).find("span.address-tag-item");

									tagdel = $(tagself).find("a#tag-del");

									/**	Supprime une information	*/
									tagdel.click(function() {

										tagkey = $(this).attr("accesskey");

										$.post(ajaxlink + 'main/contact/side-delete-address.ajax.php', {dataitem:dataitem, tagkey:tagkey}, function(regetTags) {

											if(regetTags) {
												
												simuload(pshownotebookcontenor, 100, loadcontact);

											}

										});

									});

								});

							}

							setInterval(loadtags,10000);

							loadtags();

							
							addconsole = $(pshownotebookcontenor).find("div.tag-console");

							/**	Ajout d'un contact */
							newaddcontenor.keyup(function(e) {

								newadd = newaddcontenor.val();

								newadd = $.trim(newadd);

								if(((e.keyCode === 13) || (e.keyCode === 32)) && newadd !== "") {

									function createtag() {

										$.post(ajaxlink + 'main/contact/side-save-address.ajax.php', {dataitem:dataitem, newadd:newadd}, function(savecontact) {

											if(savecontact === "") {

												newaddcontenor.val("");

												loadtags();

											} else {

												newaddcontenor.val("");

												loadtags();

												addconsole.html(savecontact);

											}

										});

									}

									createtag();

								}

							});

							/**	Ferme la sidebar de contact */
							phideaddresssidebarbutton = $(pshownotebookcontenor).find("a#p-hide-address-item-toggle");

							phideaddresssidebarbutton.click(function(e) {

								e.preventDefault();

								simuload(pshownotebookcontenor, 400, loadcontacts);

							});

						});

					}

				}

			});

			/*	Ferme la sidebar de Caret d'adresse */
			phidenotebooksidebarbutton = $(pshownotebookcontenor).find("a#p-hide-notebook-sidebar-toggle");

			phidenotebooksidebarbutton.click(function(e) {

				e.preventDefault();

				pshownotebookcontenor.removeClass("p-show-left-sidebar").animate();

			});

        });

	}

    loadcontacts();


	/** 
	*	Tâches
	*	Charge en continue les taches de l'utilisateur.
	*/

	pshowtaskscontenor = $("#p-show-tasks");

	function loadtasks() {

		$.get(ajaxlink + 'main/tasks/side-tasks.ajax.php', function(datatasks) {

            pshowtaskscontenor.html(datatasks);

			tasksbox = $(pshowtaskscontenor).find("#p-addressbook");

			tasksbox.niceScroll({cursorcolor:"#EBEDF2", cursorborder:"none",});

            paddtask = $(pshowtaskscontenor).find("div#p-add-task");

            /**	Enregistrer une tâche */
            function addtask() {

            	$.post(ajaxlink + 'main/tasks/side-createtask.ajax.php', function(createtasks) {

            		pshowtaskscontenor.html(createtasks);

				  	
            		taskreciever = $(pshowtaskscontenor).find("select#task_reciever");

            		taskdeadline = $(pshowtaskscontenor).find("input#task_deadline");

            		elasticarea = $(pshowtaskscontenor).find("textarea#elasticarea");

				  	elasticarea.elastic().css("height","5.3rem");

				  	jQuery(elasticarea).trigger('update');

            		taskbtn = $(pshowtaskscontenor).find("button#p-add-task-btn");

            		taskerror = $(pshowtaskscontenor).find("div#task-error");

            		function savetask() {

            			taskr = taskreciever.val();

            			taskd = taskdeadline.val();

            			task = elasticarea.val();

            			task = $.trim(task)

            			taskr = $.trim(taskr);

            			taskd = $.trim(taskd);

            			if(taskr!=="" && taskd!=="" && task!=="") {


            				$.post(ajaxlink + 'main/tasks/side-savetask.ajax.php', {taskr:taskr, taskd:taskd, task:task}, function(savetask) {

            					if(savetask!=="true") {

            						taskerror.html(savetask).addClass("mb-4");

            					} else {

            						simuload(pshowtaskscontenor, 1000, loadtasks);

            					}

            				});

            			} else {

            				taskerror.html("Vueillez remplir tous les champs").addClass("mb-4");

            			}


            		}

            		taskbtn.click(function() {

            			savetask();

            		});


					/**	Ferme la sidebar d'enregistrement de tâches */
					phidetaskformidebarbutton = $(pshowtaskscontenor).find("a#p-hide-tasks-item-toggle");

					phidetaskformidebarbutton.click(function(e) {

						e.preventDefault();

						simuload(pshowtaskscontenor, 100, loadtasks);

					});

            	});

            }

            paddtask.click(function() {

            	simuload(pshowtaskscontenor, 1000, addtask);

            });

            /**	Voire une tâche */
            pseetask = $(pshowtaskscontenor).find("a#p-task-see-tool");

            pedittask = $(pshowtaskscontenor).find("a#p-task-edit-tool");

            pseetask.click(function(e) {

				e.preventDefault();

				taskid = $(this).attr("accesskey");

            	function seetask() {

	            	$.post(ajaxlink + 'main/tasks/side-seetask.ajax.php', {taskid:taskid}, function(seetaskdata) {

	            		pshowtaskscontenor.html(seetaskdata);

						/**	Ferme la sidebar de la tâche sélectionner */
						phidetaskboardidebarbutton = $(pshowtaskscontenor).find("a#p-hide-task-board-sidebar-toggle");

						phidetaskboardidebarbutton.click(function(e) {

							e.preventDefault();

							loadtasks();

						});

	        		});

            	}

            	simuload(pshowtaskscontenor, 1000, seetask);

            });


            /**	Modifier une tâche */
            pedittask.click(function(e) {

				e.preventDefault();

				taskid = $(this).attr("accesskey");

            	simuload(pshowtaskscontenor, 1000, edittask);
	            function edittask() {

	            	$.post(ajaxlink + 'main/tasks/side-upformtask.ajax.php', {taskid:taskid}, function(upformtasks) {

	            		pshowtaskscontenor.html(upformtasks);


	            		taskdeadline = $(pshowtaskscontenor).find("input#up_task_deadline");

	            		elasticarea = $(pshowtaskscontenor).find("textarea#elasticarea");

					  	elasticarea.elastic().css("height","5.3rem");

					  	jQuery(elasticarea).trigger('update');

	            		edittaskbtn = $(pshowtaskscontenor).find("button#p-edit-task-btn");

	            		taskerror = $(pshowtaskscontenor).find("div#task-error");

	            		function updatetask() {

	            			taskd = taskdeadline.val();

	            			task = elasticarea.val();

	            			task = $.trim(task)

	            			taskd = $.trim(taskd);

	            			if(taskd!=="" && task!=="") {


	            				$.post(ajaxlink + 'main/tasks/side-updatetask.ajax.php', {taskd:taskd, task:task, taskid:taskid}, function(updatetaskdata) {

	            					if(updatetaskdata!=="true") {

	            						taskerror.html(updatetask).addClass("mb-4");

	            					} else {

	            						simuload(pshowtaskscontenor, 1000, loadtasks);

	            					}

	            				});

	            			} else {

	            				taskerror.html("Vueillez remplir tous les champs").addClass("mb-4");

	            			}


	            		}

	            		edittaskbtn.click(function() {

	            			updatetask();

	            			simuload(pshowtaskscontenor, 1000, loadtasks);

	            		});


						/**	Ferme la sidebar d'enregistrement de tâches */
						phidetaskformidebarbutton = $(pshowtaskscontenor).find("a#p-hide-tasks-item-toggle");

						phidetaskformidebarbutton.click(function(e) {

							e.preventDefault();

							simuload(pshowtaskscontenor, 100, loadtasks);

						});

	            	});

	            }

            });


			/**	Changement de statut */
            pstatetask = $(pshowtaskscontenor).find("a#p-task-state-change");

            pstatetask.click(function(e) {

				e.preventDefault();

				taskid = $(this).attr("accesskey");

            	function changetaskstate() {

	            	$.post(ajaxlink + 'main/tasks/side-changetask.ajax.php', {taskid:taskid}, function() {});

            	}

            	changetaskstate();

            	simuload(pshowtaskscontenor, 1000, loadtasks);

            });

			/*	Ferme la sidebar de Tâches */
			phidetaskksidebarbutton = $(pshowtaskscontenor).find("a#p-hide-tasks-sidebar-toggle");

			phidetaskksidebarbutton.click(function(e) {

				e.preventDefault();

				pshowtaskscontenor.removeClass("p-show-left-sidebar").animate();

			});

        });

	}

	loadtasks();


	/** 
	*	Image
	*	Faire apparaître automatiquement le nom du fichier charger dans le type file.
	*/
  	pscreenbox = $("#p-get-file-name");
  		
  		pfilebox = $("#p-sb-file-box");

  	pfilebox.change(function(e) {

  		fileName = e. target. files[0]. name;

  		pscreenbox.removeClass("text-muted").animate();

  		pscreenbox.html('<i class="fas fa-angle-double-right"></i>' + ' ' + fileName).addClass("text-primary").animate();

  	});


	/** 
	*	Recherche
	*	Faire la recherche automatiquement sur les tables.
	*/
	psearchinput = $("#sb-search-input");
	
	psearchinputplus = $("#sb-search-input-plus");
	
	phiddenbox = $("#sb-hidden-search-box");
	
	psearchbox = $("#sb-search-box");

	psearchtable = $("#sb-search-table tr");

	psearchinput.keyup(function() {

		pspinner.show();

		searchindex = $(this).val();

		regexp = '\\b(.*)';

		for(var i in searchindex) {

			regexp += '('+searchindex[i]+')(.*)';

		}

		regexp += '\\b';

		if(searchindex !== "") {

			$.post(ajaxlink + 'regie/panneaux/search.ajax.php',{searchindex:searchindex},function(searchdata) {

				phiddenbox.hide();

				psearchbox.html(searchdata).show();

				psearchbox.find('tr>td').each(function() {

					td = $(this);

					resultats = td.text().match(new RegExp(regexp,'i'));

					if(resultats) {
						
						string = '';
						
						for(var i in resultats) {

							if(i > 0) {

								if(i%2 == 0) {

									string += '<span class="highlighted">'+ resultats[i]+'</span>';

								} else {

									string += resultats[i];

								}	
							}
						}

						td.empty().append(string);

					}

				});

				pspinner.hide();

			});

		} else {

			phiddenbox.show();

			pspinner.hide();

			psearchbox.hide();

		}

	});

	psearchinputplus.keyup(function() {

		/*pspinner.show();*/

		searchindexplus = $(this).val();

		if(searchindexplus !== "") {

			pspinner.hide();

			psearchtable.filter(function() {
				
				$(this).toggle($(this).text().toLowerCase().indexOf(searchindexplus) > -1)
			
			});

		} else { pspinner.hide(); }

	});


	/** 
	*	Disponibilité
	*	Faire la recherche dess disponibilités de panneaux.
	*/
	psearchdispobtn = $("#p-show-dispo-btn");

	psearchdispobox = $("#p-show-dispo-box");

	spinnerbox = $("#p-dispo-spinner");
	
	spinnerbox.hide();

	psearchdispobtn.click(function() {
		
		debut = $("#debut").val();

		fin = $("#fin").val();

		size = $("#size").val();

		zone = $("#area").val();


		debut = $.trim(debut);

		fin = $.trim(fin);

		size = $.trim(size);

		zone = $.trim(zone);

		if(debut!=="" && fin!=="" && size!=="" && zone!=="") {
			
			spinnerbox.show();

			$.post(ajaxlink + 'regie/disponibilites/dispo.ajax.php',{debut:debut,fin:fin,size:size,zone:zone},function(data) {
				
				psearchdispobox.html(data);
				
				spinnerbox.hide();

			});

		} else {
			
			spinnerbox.show();

			psearchdispobox.html('<div class="display-4 p-2 text-center text-danger">Veuiller remplir tous les champs SVP.</div>');
				
			spinnerbox.hide();
		
		}

		return false;
	});
	


	/** 
	*	Image picker
	*	Pour simuler un select multiple des images.
	*	Choix de panneaux
	*/
	$(".image-checkbox").each(function() {

		if ($(this).find('input[type="checkbox"]').first().attr("checked")) {

			$(this).addClass('image-checkbox-checked');
		
		} else { $(this).removeClass('image-checkbox-checked'); }

	});

	//	#	synchronisation de l'etat
	$(".image-checkbox").on("click", function(e) {

		$(this).toggleClass('image-checkbox-checked');
		
		var $checkbox = $(this).find('input[type="checkbox"]');
		
		$checkbox.prop("checked",!$checkbox.prop("checked"))

		e.preventDefault();

	});


});