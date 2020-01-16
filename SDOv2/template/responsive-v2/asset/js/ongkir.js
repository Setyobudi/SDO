$(document).ready(function() {
        
    $('#provinsi').change(function() {
        var provinsi_id= $(this).val();
        console.log(provinsi_id);
        //console.log($("#provinsi").val());

        $.ajax({
            type: 'POST',
            url: 'http://api.shipping.esoftplay.com/city/'+provinsi_id,
            success: function(response) {
                var result = response["result"];
                $("#kota").empty();
                $("#kecamatan").empty();
                $("#kecamatan").append('<option selected> --- Pilih Kabupaten / Kota Dahulu --- </option>');
                for(var i = 0; i < result.length; i++){
                    $("#kota").append('<option value="' + result[i]["city_id"] + '">' +result[i]["city_name"] + ' ( ' + result[i]["type"] + ' )</option>');
                }
            }
        });
        return false;
    })

    $('#kota').change(function() {
        var kota_id= $(this).val();
        console.log(kota_id);

        $.ajax({
            type: 'POST',
            url: 'http://api.shipping.esoftplay.com/subdistrict/'+kota_id,
            success: function(response) {
                var result = response["result"];
                $("#kecamatan").empty();
                for(var i = 0; i < result.length; i++){
                    $("#kecamatan").append('<option value="' + result[i]["subdistrict_id"] + '">' +result[i]["subdistrict_name"] + '</option>');
                }
            }
        });
        return false;
    })

    $('#kecamatan').change(function() {
        var kecamatan_id = $(this).val();
        var kota_id = $("#kota").val()
        console.log(kecamatan_id);

        $.ajax({
            type: 'POST',
            url: 'http://api.shipping.esoftplay.com/subdistrict/'+kota_id+'/'+kecamatan_id,
            success: function(response) {
                var result = response["result"];
                //console.log(result["subdistrict_id"]+';' + result["type"]);
            }
        });
        return false;
    })

    $('#selectkurir').change(function() {
        var asd = $(this).val();
        var ongkir = asd.split(";");
        //var kota_id = $("#kota").val()
        //var name = document.getElementById('nama_kurir').getAttribute('value');
        //var ser = document.getElementById('services_kurir').getAttribute('value');
        var totbayar = document.getElementById('totbayar').getAttribute('value');
        var totberat = Math.round(document.getElementById('totalberat').getAttribute('value'));
        var bayar=(parseFloat(totbayar)+parseFloat(ongkir));

        //var oo = document.getElementById('ongkir3');
        //oo.value = "ABCD";

        //document.getElementById('ongkir3').selectedIndex = 0;
        //document.getElementById('ongkir3').value = 'Default';

        

        console.log(ongkir[0]);
        console.log(ongkir[1]);
        console.log(ongkir[2]);
        console.log(totbayar);
        //console.log(name);
        //console.log(ser);

        
        if (ongkir[0] == 'none'){
            $("#ongkir2").html("0");
            $("#totalbayar").html("0");
    
            $("#namakurir").html("-");
            $("#services").html("-");

            $("#ongkiir").val("0");
            $("#servicees").val("0");
            $("#kurirr").val("0");
            
        }else{
            
            $("#ongkir2").html(toDuit(parseFloat(ongkir)));
            $("#totalbayar").html(toDuit(bayar));
    
            $("#namakurir").html(ongkir[1]);
            $("#services").html(ongkir[2]);

            $("#ongkiir").val(parseFloat(ongkir));
            $("#servicees").val(ongkir[3]);
            $("#kurirr").val(ongkir[1]);
        }
        

        /*$.ajax({
            type: 'POST',
            url: 'http://api.shipping.esoftplay.com/subdistrict/'+kota_id+'/'+kecamatan_id,
            success: function(response) {
                var result = response["result"];
                //console.log(result["subdistrict_id"]+';' + result["type"]);
            }
        }); */
        //return false;
    })
});