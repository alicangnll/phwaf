
function hesapla(){
var v1,v2,v3,v4,v5,v6,v7,a,aa,p1,p2,ek,tyt,ea,say,obp,yks1,yks2;
var tar=$('.table');
var formul={'ek':100,'tyt':{'trk':3.333,'sos':3.333,'mat':3.333,'fen':3.333},'ayt':{'say':{'tyt':{'trk':1.851,'mat':1.851,'sos':0.997,'fen':0.997},'ayt':{'mat':3.421,'fiz':1.88,'kim':1.88,'bio':1.88}},'ea':{'tyt':{'trk':1.851,'mat':1.851,'sos':0.997,'fen':0.997},'ayt':{'mat':3.275,'trk':2.849,'tar':0.885,'cog':0.635}}}};
var sonc=$('.table').eq(2);
obp=(parseFloat($('.diploma').val())*0.12)*5;
if($.isNumeric(obp)==false){obp=0;}
ek=formul.ek;

yks1=0;yks2=0;
ea=0;say=0;

p1=0;
tar.eq(0).find('input').each(function(a,aa){
if($(aa).attr('data-kod')){
	v3=$(aa).val();
	v1=$(aa).attr('data-kod');
	v2=eval("formul.tyt."+v1);
	if($.isNumeric(v2) && $.isNumeric(v3)){
		p1=p1+(parseFloat(v2)*parseFloat(v3));
	}
}
});
tyt=(p1+ek).toFixed(3);

p1=0;
tar.eq(1).find('input').each(function(a,aa){
if($(aa).attr('data-kod')){
	v3=$(aa).val();
	v1=$(aa).attr('data-kod');
	v2=eval("formul.ayt.say.ayt."+v1);
	if($.isNumeric(v2) && $.isNumeric(v3)){
		p1=p1+(parseFloat(v2)*parseFloat(v3));
	}
}
});
say=(p1+ek).toFixed(3);

p1=0;
tar.eq(1).find('input').each(function(a,aa){
if($(aa).attr('data-kod')){
	v3=$(aa).val();
	v1=$(aa).attr('data-kod');
	v2=eval("formul.ayt.ea.ayt."+v1);
	if($.isNumeric(v2) && $.isNumeric(v3)){
		p1=p1+(parseFloat(v2)*parseFloat(v3));
	}
}
});
ea=(p1+ek).toFixed(3);

yks1=((tyt/100*40)+((ea/100)*60*1.121)+obp).toFixed(3);
yks2=((tyt/100*40)+((say/100)*60*1.121)+obp).toFixed(3);

sonc.find('tbody tr').eq(0).find('td:last-child').text(tyt);
sonc.find('tbody tr').eq(1).find('td:last-child').text(ea);
sonc.find('tbody tr').eq(2).find('td:last-child').text(say);
sonc.find('tbody tr').eq(3).find('td:last-child').text(obp);
sonc.find('tbody tr').eq(4).find('td:last-child').text(yks1);
sonc.find('tbody tr').eq(5).find('td:last-child').text(yks2);
}

