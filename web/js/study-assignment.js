$('#employee-dropdown').on('change', function() {
    const empId = $(this).val();
    if (!empId) {
        $('#employee-details').hide();
        return;
    }

    $.ajax({
        url: yii.urls.employeeDetails,
        data: { id: empId },
        success: function(data) {
            if (data.error) {
                $('#employee-details').show().html('<div class="alert alert-danger">' + data.error + '</div>');
                return;
            }

            if (!data.current_education || data.current_education === 'N/A') {
                $('#employee-details').show().html('<div class="alert alert-info">No previous details found for this employee.</div>');
            } else {
                $('#employee-details').show().html(`
                    <div class="card mt-3">
                        <div class="card-body">
                            <h4>Employee Details</h4>
                            <p><strong>Name:</strong> ${data.name}</p>
                            <p><strong>Current Education:</strong> ${data.current_education}</p>
                            <p><strong>Skills:</strong> ${data.skills}</p>
                            <p><strong>Recommended Next Study:</strong> ${data.next_recommendation}</p>
                        </div>
                    </div>
                `);
            }
        },
        error: function() {
            $('#employee-details').show().html('<div class="alert alert-danger">Could not load employee details.</div>');
        }
    });
});
