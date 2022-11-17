var base_url = window.location.origin;
var host = window.location.host;
var pathArray = window.location.pathname.split( '/' );

crearMenuOk();
function crearMenuOk() {
    $.ajax({
        type: "get",
        url: base_url+'/auth/listamenu',
        data: {},
        beforeSend: function () {
        },
        success: function (data) {
            var c = JSON.parse(data);
            $.each(c.data, function (i, item) {
                $('#side-menu').append(
                        '<li id="li' + item.idcategory + '" class="nav-item has-treeview">' +
                        '<a href="#" class="nav-link" data-content="raiz">' +
                        '<i class="nav-icon fas fa-copy"></i>' +
                        '<p>' + item.nombre +
                        '<i class="fas fa-angle-left right"></i>' +
                        '<span class="badge badge-info right" id="tmp' + item.idcategory + '"></span></p>' +
                        '</a>');
                $.ajax({
                    url: base_url+'/auth/listaitem',
                    type: 'get',
                    data: {
                        codigo: item.idcategory,
                    },
                    beforeSend: function (e) {
                        $('#load').addClass('load');
                    },
                    success: function (data) {
                        var b = JSON.parse(data);
                        var cont = 0;
                        $('#li' + item.idcategory).append('<ul class="nav nav-treeview" id="ul' + item.idcategory + '">');
                        $.each(b.data, function (v, value) {
                            $('#ul' + item.idcategory).append('<li class="nav-item"><a class="nav-link " href="../auth/' + value.tag + '"><i class="far fa-circle nav-icon"></i> ' + value.nombre + '</a></li>');
                            cont++;
                        });
                        setTimeout(function () {
                            $('#li' + item.idcategory).append('</ul>');
                            $('#tmp' + item.idcategory).text(cont);
                            $('#side-menu').append('</li>');
                            $('#div_Menu').append('</ul>');
                            $('#load').removeClass('load');
                        }, 1500);
                    },
                    error: function () {
                        $('#load').removeClass('load');
                    }
                });
            });
        },
        error: function () {
        }
    });
}