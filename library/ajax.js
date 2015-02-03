///////////////////////////////
/*
Programer : Agus Sumarna
Describe  : File Ajax untuk halaman USER
*/
//////////////////////////////

var xmlhttp = false;

try {
	xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
	try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (E) {
		xmlhttp = false;
	}
}

if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
	xmlhttp = new XMLHttpRequest();
}

//untuk pencarian NIk KTP
function ktp(searching){
	var obj=document.getElementById("pencarian");
	var url='library/proses_ajax.php?searching='+searching;
	
	xmlhttp.open("GET", url);
	
	xmlhttp.onreadystatechange = function() {
		if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
			obj.innerHTML = xmlhttp.responseText;
		} else {
			obj.innerHTML = "<div align ='center'><img src='img/loading.gif' alt='Loading' />Loading...!!!</div>";
		}
	}
	xmlhttp.send(null);
}
//untuk pencarian mahasiswa
function user(searching){
	var obj=document.getElementById("pencarian");
	var url='proses_ajax_user.php?searching='+searching;
	
	xmlhttp.open("GET", url);
	
	xmlhttp.onreadystatechange = function() {
		if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
			obj.innerHTML = xmlhttp.responseText;
		} else {
			obj.innerHTML = "<div align ='center'><img src='img/loading.gif' alt='Loading' />Loading...!!!</div>";
		}
	}
	xmlhttp.send(null);
}