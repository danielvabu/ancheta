function jf_fin(){$('input,textarea').placeholder();$("[data-toggle=tooltip]").tooltip();}
function ultimodia(ano,mes){return new Date(ano || new Date().getFullYear(),mes,0).getDate();}
function MM_preloadImages(){var d=document;if(d.images){if(!d.MM_p)d.MM_p=new Array();var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0;i<a.length;i++)if(a[i].indexOf("#")!=0){d.MM_p[j]=new Image;d.MM_p[j++].src=a[i];}}}
function notxt(e){key=(document.all) ? e.keyCode : e.which;return ((key>47 && key<58) || key==0 || key==8);}//onKeyPress="return notxt(event)"
function numfor(nStr){nStr+='';x=nStr.split('.');x1=x[0];x2=(x.length>1)?'.'+x[1]:'';var rgx=/(\d+)(\d{3})/;while(rgx.test(x1)){x1=x1.replace(rgx,'$1'+','+'$2');}return x1;}// + x2
function microtime(){var now = new Date().getTime()/1000;var s=parseInt(now);return s;}
function valmail(a){var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;return reg.test(a);}

function abrirpopoup(a){$('#popup1').html('');$('#popup1').html(a);$('#fondo').fadeIn(800);$('#popup1').fadeIn(800);centrar();}
function cerrarpopup(){$('#fondo').fadeOut(700);$('#popup1').fadeOut(700);$('#cerrarpopup').fadeOut(700);$('#'+focux).focus();}
function olvidoclc(pag){$.ajax({type:'GET',url:pag,success: function(a){abrirpopoup(a);}});}
function centrar(){
	var yplus=$(window).scrollTop();
	var x=parseInt($('#fondo').width()/2-$('#popup1').width()/2);var y=parseInt($('#fondo').height()/2-$('#popup1').height()/2);
	if(x<0)x=0;if(y<0)y=0;$('#popup1').css('left',x);$('#popup1').css('top',y + yplus);var cx = x + $('#popup1').width();var cy= y - 8 + yplus;
	$('#cerrarpopup').css('left',cx);$('#cerrarpopup').css('top',cy);$('input, textarea').placeholder();
}
function popup(pag){abrirpopoup('<div class="alert"><a id="cerrarpopup" class="close" data-dismiss="alert" href="#" onclick="cerrarpopup()" aria-hidden="true">&times;</a><table width="350" height="150" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFFFFF"><tr><td align="center" valign="middle"><div style="padding:5px;"><img src="'+PATU+'/img/loading.gif" border="0" /></div></td></tr></table></div>');$.ajax({type:'GET',url:pag,success: function(a){abrirpopoup('<div class="alert alert-success"><a id="cerrarpopup" class="close" data-dismiss="alert" href="#" onclick="cerrarpopup()" aria-hidden="true">&times;</a><table style="min-width:370px;" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFFFFF"><tr><td align="center" valign="middle"><div style="padding:5px;">'+a+'</div></td></tr></table></div>');}});}
function alerta1(ver){
	$(':focus').each(function(){focux=$(this).attr("id");});
	abrirpopoup('<div class="alert alert-info"><a id="cerrarpopup" class="close" data-dismiss="alert" href="#" onclick="cerrarpopup()" aria-hidden="true">&times;</a><table width="350" height="150" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFFFFF"><tr><td align="center" valign="middle"><div style="padding:5px;">'+ver+'</div></td></tr><tr><td align="center" valign="middle"><button type="button" onclick="cerrarpopup()" id="cojido1" class="btn btn-primary form-control"><i class="glyphicon glyphicon-info"></i> OK</button></td></tr></table></div>');$('#cojido1').focus();}
function confirma1(ver,ve1,va1,val){
	$(':focus').each(function(){focux=$(this).attr("id");});
	abrirpopoup('<div class="alert alert-warning"><a id="cerrarpopup" class="close" data-dismiss="alert" href="#" onclick="cerrarpopup()" aria-hidden="true">&times;</a><table width="370" height="170" cellpadding="4" cellspacing="1" border="0" bgcolor="#FFFFFF"><tr><td align="center" valign="middle" colspan="2"><div style="padding:5px;">'+ver+'</div></td></tr><tr><td align="center" valign="middle"><button type="button" onclick="'+va1+'(\''+val+'\')" id="cojido1" class="btn btn-success form-control"><i class="glyphicon glyphicon-ok"></i> '+ve1+'</button></td><td align="center" valign="middle"><button type="button" onclick="cerrarpopup()" id="cojido1" class="btn btn-danger form-control"><i class="glyphicon glyphicon-remove"></i> No</button></td></tr></table></div>');}
function jcpop(ver){
	$(':focus').each(function(){focux=$(this).attr("id");});
	abrirpopoup('<table width="700" height="150" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFFFFF"><tr><td align="center" valign="middle"><div style="padding:5px;">'+ver+'</div</td></tr></table>');
}
function verimagen(img,tit){
	if(!tit){tit='';}else{tit = tit+'</div</td></tr><tr><td align="center" valign="middle"><div style="padding:5px;">';}
	jcpop(tit+'<img src="'+img+'" border="0" alt="" title="" />');
}
function ultimodia(ano,mes){return new Date(ano || new Date().getFullYear(),mes,0).getDate();}
function textarea(a){
	var maximos = new Array ();
	$('#'+a).attr("maxlength", function(i){
		if(maximos[i] = this.getAttribute('maxlength')){
			$(this).keypress(function(event){
				$('#'+a+'_kar').html(this.value.length+'/'+maximos[i]);
				return ((event.which == 8) ||(event.which == 9) || (this.value.length < maximos[i]));
			});
		}
	});
}
function print_r(theObj){
   if(theObj.constructor == Array || theObj.constructor == Object){
      var sale = "-<br>";
      for(var p in theObj){
         if(theObj[p].constructor == Array || theObj[p].constructor == Object){
            sale += "---["+p+"] => "+typeof(theObj)+"<br>";
            sale += "-------<br>";
            sale += print_r(theObj[p]);
            sale += "---<br>";
         }else{
            sale += "---["+p+"] => "+theObj[p]+"<br>";
         }
      }
      sale += "-<br>";
   }
   jcpop(sale);
}
function print_r1(theObj){
   if(theObj.constructor == Array || theObj.constructor == Object){
      var sale = "-\n";
      for(var p in theObj){
         if(theObj[p].constructor == Array || theObj[p].constructor == Object){
            sale += "---["+p+"] => "+typeof(theObj)+"\n";
            sale += "-------\n";
            sale += print_r(theObj[p]);
            sale += "---\n";
         }else{
            sale += "---["+p+"] => "+theObj[p]+"\n";
         }
      }
      sale += "-\n";
   }
   alert(sale);
}
