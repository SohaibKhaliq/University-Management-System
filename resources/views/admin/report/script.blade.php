<script type="text/javascript">
    'use strict';
    $(document).ready(function() {

        // [ HTML5-Export ] start
        $('#report-table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="fas fa-copy"></i>',
                    footer: true
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i>',
                    footer: true
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file"></i>',
                    footer: true
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i>',
                    footer: true
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i>',
                    autoPrint: true,
                    footer: true,
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' );
     
                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );

                        $(win.document.body).find( 'caption' )
                            .css( 'font-size', '10px' );

                        $(win.document.body).find('h1')
                            .css({"text-align": "center", "font-size": "16pt"});
                    }
                }
            ]
        });
    });
</script>