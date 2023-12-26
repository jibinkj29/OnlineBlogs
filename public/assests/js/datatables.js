$(function(e) {
	//file export datatable
	var table = $('#exampleBlog').DataTable({
		processing: true,
		serverSide: true,
		ajax: "http://127.0.0.1:8000/blogs",
		columns: [
			{data: 'DT_RowIndex', orderable: false, searchable: false },
			{data: 'category'},
			{data: 'name'},
			{data: 'date'},
			{data: 'author'},
			{data: 'image'},
			{data: 'content'},
			{data: 'action', orderable: false, searchable: false},
		],
		lengthChange: true,
		aaSorting: [[ 0, "asc" ]],
		buttons: [ 'copy', 'pdf', 'csv' ],
		language: {
			searchPlaceholder: 'Search...',
			scrollX: "100%",
			sSearch: '',
			lengthMenu: '_MENU_',
		}
	});
	
	table.buttons().container()
	.appendTo('#example_wrapper .col-md-6:eq(0)');			
	
	$('#example1').DataTable({
	    aaSorting: [[ 0, "asc" ]],
		language: {
			searchPlaceholder: 'Search...',
			scrollX: "100%",
			sSearch: '',
			lengthMenu: '_MENU_',
		}
	});
	$('#example2').DataTable({
		language: {
			searchPlaceholder: 'Search...',
			scrollX: "100%",
			sSearch: '',
			lengthMenu: '_MENU_',
		}
	});
	$('#Invoicedatatable').DataTable({
		language: {
			searchPlaceholder: 'Search...',
			scrollX: "100%",
			sSearch: '',
			lengthMenu: '_MENU_',
		}
	});
	//______Delete Data Table
	var table = $('#delete-datatable').DataTable({
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		}
	}); 
    $('#delete-datatable tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
    $('#button').click( function () {
        table.row('.selected').remove().draw( false );
    } );
	
	//Details display datatable
	$('#example-1').DataTable( {
		language: {
			searchPlaceholder: 'Search...',
			scrollX: "100%",
			sSearch: '',
			lengthMenu: '_MENU_',
		},
	} );
});