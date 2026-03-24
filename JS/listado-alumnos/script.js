const datos=[
	['Miguel','ksizorCode','ksizorCode'],
	['Ricardo','richardODC','RichardODC'],
	['Moises','MoisesMG','MoisesMG99'],
	['Alejandro','alejandrogaralv',''],
	['Cristian','ch15','vikar04'],
	['Agustín','garfio45',''],
	['Teresa','tereBrave','TeresaBrave'],
	['Elma','lua83','luanaVans'],
	['Iker','iker-guerra-mielgo','ikerguerra'],
	['Rafa','rafaAlbarran','RafaAlbarran'],
	['Oleskii','olekprot','olekprot'],
	['Adrián','CuelebreRojo',''],
	['Luis','shrkng','']
];

/* De aquí para abajo no tocar */
const ruta='https://codepen.io/';
const ruta2='https://github.com/';
 
let miHTML="<ul>";

for(i=0; i<datos.length;i++){
	miHTML+='<li>';
	miHTML+='<h2>'+datos[i][0]+'</h2>';
	miHTML+='<i class="fa-brands fa-codepen"></i> <a href="'+ruta+datos[i][1]+'" target="_blank">'+datos[i][1]+'</a>';
	miHTML+='<br>';
		miHTML+='<i class="fa-brands fa-github"></i> <a href="'+ruta2+datos[i][2]+'" target="_blank">'+datos[i][2]+'</a>';
	miHTML+='<p>Alumno Nº'+i+'</p>';
	miHTML+='</li>';
	
}

miHTML+='</ul>'

document.write(miHTML);