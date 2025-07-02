var dataTable;
$(document).ready(function () {
  dataTable = $("#table-teacher").DataTable({
    ordering: false,
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: " _START_ al _END_ de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending: ": Activar para ordenar la columna de manera ascendente",
        sSortDescending: ": Activar para ordenar la columna de manera descendente",
      },
      buttons: {
        copy: "Copiar",
        colvis: "Visibilidad",
      },
    }
  });

  getTable(dataTable);

});

function getTable(dataTable) {

  $.ajax({
    url: 'config/general/get-general.php',
    method: 'POST',
    data: {
      action: 'get_all_teacher'
    },
    dataType: 'json',
    success: function (data) {

      // Clear DataTable before adding new rows
      dataTable.clear();

      // Iterate over the data and add rows to the table
      $.each(data, function (index, result) {


     
        var estadoBtn = '';
        if (result.state === 'activo') {
          estadoBtn = '<button type="button" style="cursor: auto;" class="btn btn-sm btn-success">Activo</button>';
        } else if (result.state === 'inactivo') {
          estadoBtn = '<button type="button" style="cursor: auto;" class="btn btn-sm btn-danger">Inactivo</button>';
        }


        var newRow = '<tr>' +
          '<td class="align-middle text-center">' + result.id + '</td>' +
          '<td class="align-middle text-center">' + result.full_name + '</td>' +
          '<td class="align-middle text-center">' + result.code + '</td>' +
          '<td class="align-middle text-center">' + result.gender + '</td>' +
          '<td class="align-middle text-center">' + result.civil_status + '</td>' +
          '<td class="align-middle text-center">' + result.institutional_mail + '</td>' +
          '<td class="align-middle text-center">' + result.personal_mail + '</td>' +
          '<td class="align-middle text-center">' + result.nombreCampus  + '</td>' +
          '<td class="align-middle text-center">' + result.phone  + '</td>' +
          '<td class="align-middle text-center">' + estadoBtn + '</td>' +
          '<td class="align-middle">' +
          '<div class="d-flex justify-content-center align-items-center gap-1">' +
          '<button type="button" class="btn btn-sm btn-warning edit" data-bs-toggle="modal" data-bs-target="#editarModal" data-id="' + result.id + '"><i class="bx bxs-edit" ></i></button>' +
          '</div>' +
          '</td>' +
          '</tr>';
        dataTable.row.add($(newRow)).draw(false);
      });
    }
  });
}
