$(document).ready(function () {
    $('#employee-dropdown').on('change', function () {
        const empId = $(this).val();
        const url = $(this).data('url');

        if (!empId) {
            $('#employee-details').hide();
            return;
        }

        $.ajax({
            url: url,
            data: { id: empId },
            success: function (data) {
                if (data.error) {
                    $('#employee-details').html('<div class="alert alert-danger">' + data.error + '</div>').show();
                    return;
                }

                const html = `
                    <div class="card mt-3">
                        <div class="card-body">
                            <h4>Employee Details</h4>
                            <p><strong>Name:</strong> ${data.name}</p>
                            <p><strong>Current Education:</strong> ${data.current_education}</p>
                            <p><strong>Skills:</strong> ${data.skills}</p>
                            <p><strong>Recommended Next Study:</strong> ${data.next_recommendation}</p>
                        </div>
                    </div>
                `;
                $('#employee-details').html(html).show();
            },
            error: function () {
                $('#employee-details').html('<div class="alert alert-danger">Could not load employee details.</div>').show();
            }
        });
    });
});
