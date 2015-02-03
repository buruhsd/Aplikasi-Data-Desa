<!---Ajak SO ambil data Master Grup-->

 var htmlobjek;
$(document).ready(function(){
//apabila terjadi event onchange terhadap object <select id=propinsi>
    $("#provinsi").change(function(){
    var provinsi = $("#provinsi").val();
    $.ajax({
    url: "ambilkota.php",
    data: "provinsi="+provinsi,
    cache: false,
    success: function(msg){
    //jika data sukses diambil dari server kita tampilkan
    //di <select id=kota>
    $("#kota").html(msg);
    }
    });
    });

    $("#kota").change(function(){
    var kota = $("#kota").val();
    $.ajax({
    url: "ambilkecamatan.php",
    data: "kota="+kota,
    cache: false,
    success: function(msg){
    $("#kec").html(msg);
    }
    });
    });

    $("#kec").change(function(){
    var kec = $("#kec").val();
    $.ajax({
    url: "ambilkelurahan.php",
    data: "kec="+kec,
    cache: false,
    success: function(msg){
    $("#kel").html(msg);
    }
    });
    });
	
	$("#kel").change(function(){
    var kel = $("#kel").val();
    $.ajax({
    url: "ambildusun.php",
    data: "kel="+kel,
    cache: false,
    success: function(msg){
    $("#dusun").html(msg);
    }
    });
    });
});
$(document).ready(function(){
//datanikah
    $("#provinsi1").change(function(){
    var provinsi1 = $("#provinsi1").val();
    $.ajax({
    url: "ambilkota1.php",
    data: "provinsi1="+provinsi1,
    cache: false,
    success: function(msg){
    //jika data sukses diambil dari server kita tampilkan
    //di <select id=kota>
    $("#kota1").html(msg);
    }
    });
    });

    $("#kota1").change(function(){
    var kota1 = $("#kota1").val();
    $.ajax({
    url: "ambilkecamatan1.php",
    data: "kota1="+kota1,
    cache: false,
    success: function(msg){
    $("#kec1").html(msg);
    }
    });
    });

    $("#kec1").change(function(){
    var kec1 = $("#kec1").val();
    $.ajax({
    url: "ambilkelurahan1.php",
    data: "kec1="+kec1,
    cache: false,
    success: function(msg){
    $("#kel1").html(msg);
    }
    });
    });
	
	$("#kel1").change(function(){
    var kel1 = $("#kel1").val();
    $.ajax({
    url: "ambildusun1.php",
    data: "kel1="+kel1,
    cache: false,
    success: function(msg){
    $("#dusun1").html(msg);
    }
    });
    });
});