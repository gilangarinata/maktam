    function showGudangNew() {
        $.ajax({
            type: "POST",
            data: ({
                tanggal: tanggal
            }),
            url: api_admin + "laporan_gudang.php",
            cache: false,
            success: function(data) {
                var stock = [];
                var string = "<table border='1'> <thead> <tr> <th>Material</th> <th style='padding-left: 10px; padding-right: 10px'>Input Barang</th><th style='padding-left: 10px; padding-right: 10px'>Stock Gudang</th> <th style='padding-left: 10px; padding-right: 10px'>Diambil Outlet</th><th style='padding-left: 10px; padding-right: 10px'>Sisa Barang</th> </tr> </thead> <tbody>";
                var dts = JSON.parse(data);
                material = JSON.parse(dts['material']);
                var value = JSON.parse(dts['data']);
                try {
                    var stock = JSON.parse(dts['stock']);
                } catch (err) {
                    stock = [];
                }

                if (stock.length === 0) {
                    iDate = 1;
                    getStock(tanggal);
                }


                var diambilOutlet = [];
                var sisaBarang = [];
                materialLength = material.length;


                for (var i = 0; i < material.length; i++) {
                    diambilOutlet[i] = 0;
                    if (typeof stock[i] == 'undefined') stock[i] = 0;
                    for (var j = 0; j < value.length; j++) {
                        //gilang;;;;
                        diambilOutlet[i] = diambilOutlet[i] + Number(value[j][7 + materialLength + i]);
                        // console.log(value[]);
                    }
                    sisaBarang[i] = Number(stock[i]) - Number(diambilOutlet[i]);

                    if (material[i] != '0') {
                        string += "<tr> <td><b>" + material[i] + "</b></td> <td><input value='' id='inputGudang" + i + "' style='text-align:center; border: 1px solid black; height:25px; width:50px;' type='text'></td> <td id='stockGudang" + i + "'>" + stock[i] + "</td> <td id='diambilOutlet" + i + "'>" + diambilOutlet[i] + "</td> <td id='sisaGudang" + i + "'>" + sisaBarang[i] + "</td>  </tr>";
                    }
                }

                setTimeout(function() {
                    for (var i = 0; i < material.length; i++) {
                        var sisa = Number($("#stockGudang" + i).html()) - Number($("#diambilOutlet" + i).html());
                        $("#sisaGudang" + i).html(sisa)
                    }

                }, 5000);

                $("#record-laporan-gudang-2").html(string);
            }
        });
    }