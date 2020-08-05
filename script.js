function show(id){
    var passwd=document.getElementById(id);    
    if(passwd.type === "password"){
        passwd.type = "text";
    }else{
        passwd.type = "password";
    }
}

// var searchbar = document.getElementById("searchbar");
// var searchbutton = document.getElementById("searchbutton");
// var tableid = document.getElementById("tableid");
// // jadi itu gini xhr di bawah itu adalah untuk inisialisasi ajaxnya
// // onready itu buat tau ready atau ga berjalan atau ga kalau berjalan akan keluar apa yang di fungsi di bawah
// // ready state itu untuk cek state dari ajax kalau 4 berarti berhasil atau jalan umumnya ada 0-4 0 itu kayak inisialisasi
// // kalau 0 berhenti brrti ga jalan
// // status adalah status dari page kalau 200 brrti ok kalau 404 page not found kayak gitu
// // xhr open ini adalah sumber nya jadi ketika searchbar key up maka ambil data dari catatan.txt trus di up gituu
// // ke console log untuk responsetext itu ambil datanya dari catatan .txt 
// // inneh html itu befungsi , jadi tableid apapun isinya entah table atau apa semua yang ada di div itu dipanggil
// // trus di ganti apapaun yang di dapat dari respons
// searchbar.addEventListener('keyup',function(){
//     var xhr = new XMLHttpRequest(); // membuat object ajax
//     xhr.onreadystatechange = function(){ // cek ajaxnya ready apa ndak
//         if(xhr.readyState==4&&xhr.status==200){
//             tableid.innerHTML=xhr.responseText
//         }
//     }

//     xhr.open('GET','student.php?searchbar='+searchbar.value,true);// parameter1 adalah method(get/post) parameter2 itu adalah sumbernya parameter 3 (true asynchronous, false untuk synchronous)
//     xhr.send();
// })


// inii jquery tapi sebelum itu harus di panggil di main page nya script jquery dan file jquery harus download dulu
// ini bacanya gini $() itu jequery, jadi jquery tolong jalankan fungsi ini ketika document/page nya ready
$(document).ready(function(){
    // add eventnya

    $('#searchbar').on('keyup',function(){
        
        // ini untuk jquery ajax load
        // $('#tableid').load('student.php?searchbar='+$('#searchbar').val());
        
            // jadi itu artinya gini jquery->$() tolong carikan id searchbar dia akan aktif / addEventListener ketika di keyup dan jalankan ini 
            //  jquery tolong carikan id tableid load-> ubah dengan isi yang di berikan di student.php?searchabar ditambah dengan segala yang di isi di
            // searchbar atau searchbar . value
        $('.gif').show();
        // jquery dengan $.get()
        $.get('student.php?searchbar='+$('#searchbar').val(),function(data){
            $('#tableid').html(data);
            $('.gif').hide();
        });    
        // artinya lakukan get ke url tsb ambil data lalu kalau sudah terambil lakukan fungsi tsb
        // isi fungsi tersebut adalah jquery ambil id table id lalu ubah isinya dengan data tsb
        // data di parameter adalah data yang diambil dari url tadi
    });        

});


